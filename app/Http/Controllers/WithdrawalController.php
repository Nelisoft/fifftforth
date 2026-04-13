<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\WithdrawalSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalStatusMail;

class WithdrawalController extends Controller
{
    /**
     * Display user's withdrawal page
     */
    public function index()
    {
        $user = Auth::user();
        $settings = WithdrawalSetting::first();
        $minWithdrawal = $settings->min_withdrawal ?? 0;
        $maxWithdrawal = $settings->max_withdrawal ?? 0;

        $withdrawals = Withdrawal::where('user_id', $user->id)->latest()->get();
        $totalBalance = ($user->balance ?? 0) + ($user->profit ?? 0);

        return view('user.withdraw.index', compact('user','withdrawals','totalBalance','minWithdrawal','maxWithdrawal'));
    }

    /**
     * Handle withdrawal request
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->kyc_status !== 'approved') {
            return back()->with('error', '⚠️ You must complete KYC before making a withdrawal.');
        }

        $request->validate([
            'coin_type' => 'required|string',
            'wallet_address' => 'required|string',
            'amount' => 'required|numeric|min:1',
        ]);

        $amount = (float) $request->amount;
        $settings = WithdrawalSetting::first();
        $minLimit = $settings->min_withdrawal ?? 0;
        $maxLimit = $settings->max_withdrawal ?? 0;

        if ($amount < $minLimit) {
            return back()->with('error', "⚠️ Minimum withdrawal is \${$minLimit}.");
        }
        if ($amount > $maxLimit) {
            return back()->with('error', "⚠️ Maximum withdrawal is \${$maxLimit}.");
        }

        try {
            $withdrawal = DB::transaction(function () use ($amount, $request, $user) {
                $user = User::where('id', $user->id)->lockForUpdate()->first();
                $totalBalance = $user->balance + $user->profit;

                if ($totalBalance < $amount) {
                    throw new \RuntimeException('insufficient');
                }

                $remaining = $amount;

                // Deduct from profit first
                if ($user->profit >= $remaining) {
                    $user->profit -= $remaining;
                    $remaining = 0;
                } else {
                    $remaining -= $user->profit;
                    $user->profit = 0;
                }

                // Deduct remainder from main balance
                if ($remaining > 0) {
                    $user->balance -= $remaining;
                }

                $user->save();

                return Withdrawal::create([
                    'user_id' => $user->id,
                    'coin_type' => $request->coin_type,
                    'wallet_address' => $request->wallet_address,
                    'amount' => $amount,
                    'status' => 'pending',
                ]);
            });

            try {
                Mail::to($user->email)->send(new WithdrawalStatusMail($withdrawal));
            } catch (\Exception $e) {
                Log::error("Email failed: {$e->getMessage()}");
            }

            return redirect()->route('user.dashboard')->with('success', '✅ Withdrawal request submitted and pending approval.');

        } catch (\RuntimeException $e) {
            return back()->with('error', '❌ Insufficient balance.');
        } catch (\Exception $e) {
            Log::error("Withdrawal Error: {$e->getMessage()}");
            return back()->with('error', '⚠️ Something went wrong.');
        }
    }

    /**
     * Withdrawal History
     */
    public function withdrawalHistory()
    {
        $withdrawals = auth()->user()->withdrawals()->orderBy('created_at', 'desc')->paginate(20);
        return view('user.history.withdrawals', compact('withdrawals'));
    }

    /**
     * ADMIN: All withdrawals
     */
    public function adminIndex()
    {
        $withdrawals = Withdrawal::with('user')->latest()->paginate(10);
        $settings = WithdrawalSetting::first();
        return view('admin.withdrawals.index', compact('withdrawals','settings'));
    }

    /**
     * ADMIN: Update withdrawal status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status'=>'required|in:approved,rejected','admin_note'=>'nullable|string']);
        $withdrawal = Withdrawal::with('user')->findOrFail($id);

        DB::transaction(function() use ($request,$withdrawal){
            $withdrawal->update(['status'=>$request->status,'admin_note'=>$request->admin_note]);

            if ($request->status==='rejected') {
                $user = $withdrawal->user()->lockForUpdate()->first();
                // Refund to total balance (profit first)
                $user->profit += min($withdrawal->amount, $user->profit); // optional if you want to refund profit portion
                $user->balance += $withdrawal->amount - min($withdrawal->amount, $user->profit);
                $user->save();
            }
        });

        try { Mail::to($withdrawal->user->email)->send(new WithdrawalStatusMail($withdrawal)); } 
        catch (\Exception $e){ Log::error($e->getMessage()); }

        return back()->with('success',$request->status==='approved'?'✅ Withdrawal approved!':'❌ Withdrawal rejected and refunded.');
    }

    /**
     * ADMIN: Update Withdrawal Limits
     */
    public function updateSettings(Request $request)
    {
        $request->validate([
            'min_withdrawal'=>'required|numeric|min:0',
            'max_withdrawal'=>'required|numeric|gt:min_withdrawal'
        ]);

        WithdrawalSetting::updateOrCreate(['id'=>1],[
            'min_withdrawal'=>$request->min_withdrawal,
            'max_withdrawal'=>$request->max_withdrawal
        ]);

        return back()->with('success','✅ Withdrawal settings updated successfully!');
    }
}
