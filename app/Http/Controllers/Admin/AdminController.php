<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Withdrawal;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositStatusMail;
use App\Mail\ReferralBonusMail;
use App\Mail\KycStatusMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Dashboard
    public function dashboard(Request $request)
    {
        $year = $request->input('year', date('Y'));

        $totalUsers = User::count();
        $totalDeposits = Deposit::sum('amount');
        $totalInvestments = Investment::sum('amount');
        $totalWithdrawals = Withdrawal::where('status', 'approved')->sum('amount');

        $today = Carbon::today();
        $todayDeposits = Deposit::whereDate('created_at', $today)->sum('amount');
        $todayInvestments = Investment::whereDate('created_at', $today)->sum('amount');
        $todayWithdrawals = Withdrawal::whereDate('created_at', $today)
                                      ->where('status', 'approved')
                                      ->sum('amount');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalDeposits',
            'totalInvestments',
            'totalWithdrawals',
            'todayDeposits',
            'todayInvestments',
            'todayWithdrawals',
            'year'
        ));
    }

    // Admin Profile
    public function profile()
    {
        $admin = auth()->guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = auth()->guard('admin')->user();

        $data = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    // Deposits
    public function deposits(Request $request)
    {
        $query = Deposit::with(['user', 'wallet'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', fn($q) =>
                $q->where('fullname', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
            );
        }

        $deposits = $query->paginate(15);
        return view('admin.deposits.index', compact('deposits'));
    }

    public function pendingDeposits(Request $request)
    {
        $query = Deposit::with(['user', 'wallet'])
                        ->where('status', 'pending')
                        ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', fn($q) =>
                $q->where('fullname', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
            );
        }

        $deposits = $query->paginate(15);
        return view('admin.deposits.pending', compact('deposits'));
    }

    public function approveDeposit(Deposit $deposit)
    {
        $user = $deposit->user;

        if ($deposit->status !== 'pending') {
            return back()->with('error', 'Deposit already reviewed.');
        }

        if ($user->kyc_status !== 'approved') {
            return back()->with('error', 'Cannot approve deposit: user KYC not approved.');
        }

        $referrer = $user->referrer;
        $bonusAmount = Setting::first()?->referral_bonus ?? 10;

        DB::transaction(function () use ($deposit, $user, $referrer, $bonusAmount) {
            $deposit->update(['status' => 'approved']);
            $user->increment('balance', $deposit->amount);

            if ($referrer && !$user->referral_bonus_received) {
                $referrer->increment('balance', $bonusAmount);
                $user->update(['referral_bonus_received' => true]);

                try {
                    Mail::to($referrer->email)->send(new ReferralBonusMail($referrer, $user, $bonusAmount));
                } catch (\Exception $e) {
                    \Log::error("Referral bonus email failed: {$e->getMessage()}");
                }
            }

            try {
                Mail::to($user->email)->send(new DepositStatusMail($deposit));
            } catch (\Exception $e) {
                \Log::error("Deposit approval email failed: {$e->getMessage()}");
            }
        });

        return back()->with('success', '✅ Deposit approved, balance updated, and referral bonus processed.');
    }

    public function rejectDeposit(Deposit $deposit)
    {
        if ($deposit->status !== 'pending') {
            return back()->with('error', 'Deposit already reviewed.');
        }

        $deposit->update(['status' => 'rejected']);

        try {
            Mail::to($deposit->user->email)->send(new DepositStatusMail($deposit));
        } catch (\Exception $e) {
            \Log::error("Deposit rejection email failed: {$e->getMessage()}");
        }

        return back()->with('success', '❌ Deposit rejected and user notified.');
    }

    // KYC Management
    public function kycIndex(Request $request)
    {
        $query = User::whereNotNull('kyc_submitted_at')->latest('kyc_submitted_at');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(fn($q) =>
                $q->where('fullname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
            );
        }

        $kycRequests = $query->paginate(15);
        return view('admin.kyc.index', compact('kycRequests'));
    }

    public function kycShow(User $user)
    {
        return view('admin.kyc.show', compact('user'));
    }

    public function approveKyc(User $user)
    {
        if ($user->kyc_status !== 'pending') {
            return redirect()->route('admin.kyc.index')->with('error', 'KYC already reviewed.');
        }

        $user->update([
            'kyc_status' => 'approved',
            'kyc_reviewed_at' => now(),
        ]);

        try {
            Mail::to($user->email)->send(new KycStatusMail($user, 'approved'));
        } catch (\Exception $e) {
            \Log::error("KYC approval email failed: {$e->getMessage()}");
        }

        return redirect()->route('admin.kyc.index')->with('success', '✅ KYC approved successfully.');
    }

    public function rejectKyc(User $user)
    {
        if ($user->kyc_status !== 'pending') {
            return redirect()->route('admin.kyc.index')->with('error', 'KYC already reviewed.');
        }

        $user->update([
            'kyc_status' => 'rejected',
            'kyc_reviewed_at' => now(),
        ]);

        try {
            Mail::to($user->email)->send(new KycStatusMail($user, 'rejected'));
        } catch (\Exception $e) {
            \Log::error("KYC rejection email failed: {$e->getMessage()}");
        }

        return redirect()->route('admin.kyc.index')->with('success', '❌ KYC rejected successfully.');
    }

    public function bulkKycAction(Request $request)
    {
        $request->validate([
            'kyc_ids' => 'required|array',
            'action' => 'required|string|in:approve,reject',
        ]);

        $status = $request->action === 'approve' ? 'approved' : 'rejected';

        $users = User::whereIn('id', $request->kyc_ids)->get();

        foreach ($users as $user) {
            if ($user->kyc_status !== 'pending') continue;

            $user->update([
                'kyc_status' => $status,
                'kyc_reviewed_at' => now(),
            ]);

            try {
                Mail::to($user->email)->send(new KycStatusMail($user, $status));
            } catch (\Exception $e) {
                \Log::error("KYC bulk {$status} email failed for user {$user->id}: {$e->getMessage()}");
            }
        }

        return redirect()->route('admin.kyc.index')
                         ->with('success', "✅ Selected KYC requests have been {$status} successfully.");
    }
}
