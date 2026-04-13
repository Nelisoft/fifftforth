<?php

namespace App\Http\Controllers;

use App\Mail\CustomUserMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Withdrawal;
use Carbon\Carbon;
use App\Mail\KycSubmittedMail;

class UserController extends Controller
{
    // ===============================
    // User Dashboard & Profile
    // ===============================

    public function dashboard()
    {
        $user = Auth::user();

        // --- Wallet balances ---
        $currentBalance = $user->balance ?? 0;
        $profitBalance = $user->profit ?? 0;

        // --- Fetch user's active investments ---
        $investments = Investment::where('user_id', $user->id)
            ->with('plan')
            ->where('status', 'active')
            ->get();

        $totalProfit = 0;
        $todayProfit = 0;

        foreach ($investments as $inv) {

            if ($inv->last_profit_time === null) {
                $inv->last_profit_time = $inv->started_at;
            }

            while (Carbon::parse($inv->last_profit_time)->diffInHours(now()) >= 24) {
                $dailyProfit = ($inv->amount * $inv->plan->daily_roi / 100);
                if ($dailyProfit < 0)
                    $dailyProfit = 0;

                $inv->profit += $dailyProfit;
                $inv->last_profit_time = Carbon::parse($inv->last_profit_time)->addDay();
                $inv->save();

                $user->profit += $dailyProfit;
                $totalProfit += $dailyProfit;
            }

            if (now()->between($inv->started_at, $inv->ends_at)) {
                $todayProfit += ($inv->amount * $inv->plan->daily_roi / 100);
            }
        }

        $user->save();

        $totalAvailable = $currentBalance + $user->profit;

        // Chart data
        $last30Days = collect();
        for ($i = 29; $i >= 0; $i--) {
            $last30Days->push(now()->subDays($i)->toDateString());
        }

        $chartLabels = $last30Days->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))->toArray();
        $chartData = [];

        foreach ($last30Days as $day) {
            $dayProfit = 0;
            foreach ($investments as $inv) {
                $start = $inv->started_at ? $inv->started_at->toDateString() : now()->toDateString();
                $end = $inv->ends_at ? $inv->ends_at->toDateString() : now()->toDateString();

                if ($day >= $start && $day <= $end) {
                    $dayProfit += ($inv->amount * $inv->plan->daily_roi) / 100;
                }
            }
            $chartData[] = round($dayProfit, 2);
        }

        $totalDeposits = Deposit::where('user_id', $user->id)
            ->where('status', 'approved')
            ->sum('amount');

        $totalInvested = $investments->sum('amount');

        return view('user.dashboard', compact(
            'currentBalance',
            'profitBalance',
            'totalAvailable',
            'totalDeposits',
            'totalInvested',
            'totalProfit',
            'todayProfit',
            'chartLabels',
            'chartData'
        ));
    }

    public function editProfile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username,' . auth()->id(),
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'country' => 'nullable|string|max:100',
            'country_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = auth()->user();
        $user->update($request->only([
            'fullname',
            'username',
            'email',
            'country',
            'country_code',
            'phone',
        ]));

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }


    // =======================================
    //               KYC SYSTEM
    // =======================================
// Show the KYC form
// =======================================
  // Show KYC form
    public function showKyc()
    {
        $user = Auth::user();
        return view('user.kyc.index', compact('user'));
    }

    // Submit KYC

public function submitKyc(Request $request)
{
    $request->validate([
        'Home_address' => 'required|string|max:255',
        'kyc_document' => 'required|mimes:jpeg,png,jpg,pdf|max:4096',
    ]);

    $user = Auth::user();

    // Save the uploaded file
    $file = $request->file('kyc_document');
    $filename = uniqid() . '.' . $file->getClientOriginalExtension();
    $destination = public_path('storage/kyc');
    if (!file_exists($destination)) {
        mkdir($destination, 0755, true);
    }
    $file->move($destination, $filename);

    // Update user record
    $user->update([
        'Home_address' => $request->input('Home_address'),
        'kyc_document' => 'kyc/' . $filename,
        'kyc_status' => 'pending',
        'kyc_submitted_at' => now(),
    ]);

    // Send KYC submission email
    try {
        Mail::to($user->email)->send(new KycSubmittedMail($user));
    } catch (\Exception $e) {
        \Log::error("KYC submission email failed for user {$user->id}: " . $e->getMessage());
    }

    return redirect()->route('user.kyc')->with('success', 'Your KYC has been submitted and is pending approval. You will receive an email confirmation shortly.');
}
    // ===============================
    // Admin: User Management
    // ===============================

    public function index(Request $request)
    {
        $this->authorizeAdmin();

        $query = User::query();

        if ($search = $request->input('search')) {
            $query->where(
                fn($q) =>
                $q->where('fullname', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
            );
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $this->authorizeAdmin();

        $mainBalance = $user->balance ?? 0;
        $profitBalance = $user->profit ?? 0;
        $totalAvailable = $mainBalance + $profitBalance;
        $totalDeposits = Deposit::where('user_id', $user->id)->where('status', 'approved')->sum('amount');
        $totalInvestments = Investment::where('user_id', $user->id)->sum('amount');
        $totalProfit = Investment::where('user_id', $user->id)->sum('profit');
        $totalWithdrawals = Withdrawal::where('user_id', $user->id)->where('status', 'approved')->sum('amount');

        return view('admin.users.show', compact(
            'user',
            'mainBalance',
            'profitBalance',
            'totalAvailable',
            'totalDeposits',
            'totalInvestments',
            'totalProfit',
            'totalWithdrawals'
        ));
    }

    public function update(Request $request, User $user)
    {
        $this->authorizeAdmin();

        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return back()->with('success', 'User profile updated successfully.');
    }

    public function adjustBalance(User $user, Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'main_balance' => 'nullable|numeric',
            'profit_balance' => 'nullable|numeric',
        ]);

        $user->balance += $request->input('main_balance', 0);
        $user->profit += $request->input('profit_balance', 0);
        $user->save();

        return back()->with('success', 'Balances updated successfully.');
    }

    public function loginAsUser(User $user)
    {
        $this->authorizeAdmin();
        Auth::guard('web')->login($user);
        Session::put('admin_logged_in', true);

        return redirect()->route('user.dashboard')->with('success', 'Logged in as ' . $user->fullname);
    }

    public function sendEmail(User $user, Request $request)
    {
        $this->authorizeAdmin();

        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            Mail::to($user->email)->send(new CustomUserMail(
                $validated['subject'],
                $validated['message']
            ));
            $msg = 'Email sent successfully to ' . $user->email;
        } catch (\Exception $e) {
            \Log::error("Email sending failed: " . $e->getMessage());
            $msg = '⚠️ Failed to send email. Check your SMTP configuration.';
        }

        return back()->with('success', $msg);
    }

    public function block(User $user)
    {
        $this->authorizeAdmin();
        $user->update(['is_blocked' => true]);
        return back()->with('success', 'User blocked successfully.');
    }

    public function unblock(User $user)
    {
        $this->authorizeAdmin();
        $user->update(['is_blocked' => false]);
        return back()->with('success', 'User unblocked successfully.');
    }

    public function destroy(User $user)
    {
        $this->authorizeAdmin();
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'new_password' => 'required|confirmed|min:8',
        ]);

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function bulkAction(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'action' => 'required|string|in:block,unblock,delete',
            'user_ids' => 'required|array',
            'user_ids.*' => 'integer|exists:users,id',
        ]);

        $users = User::whereIn('id', $request->user_ids)->get();

        $message = 'No action performed.';

        switch ($request->action) {
            case 'block':
                $users->each(fn($u) => $u->update(['is_blocked' => true]));
                $message = 'Selected users blocked successfully.';
                break;

            case 'unblock':
                $users->each(fn($u) => $u->update(['is_blocked' => false]));
                $message = 'Selected users unblocked successfully.';
                break;

            case 'delete':
                $users->each(fn($u) => $u->delete());
                $message = 'Selected users deleted successfully.';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    // ===============================
    // Helpers
    // ===============================

    private function authorizeAdmin(): void
    {
        if (!Auth::guard('admin')->check()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
