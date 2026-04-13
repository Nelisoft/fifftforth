<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Wallet;
use App\Models\Setting;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositStatusMail;
use App\Mail\ReferralBonusMail;
use App\Mail\WithdrawalStatusMail;

class DepositController extends Controller
{
    /**
     * Show deposit form
     */
    public function create()
    {
        $wallets = Wallet::all();
        return view('user.deposit.create', compact('wallets'));
    }

    /**
     * Store new deposit
     */
   public function store(Request $request)
{
    $user = Auth::user();

    // Check if KYC is approved
    if ($user->kyc_status !== 'approved') {
        return redirect()->route('user.dashboard')
                         ->with('error', '⚠️ You must complete KYC verification before making a deposit.');
    }

    $request->validate([
        'coin_type' => 'required|string|exists:wallets,coin_type',
        'amount' => 'required|numeric|min:0.0001',
        'wallet_id' => 'required|exists:wallets,id',
        'payment_proof' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
    ]);

    $wallet = Wallet::findOrFail($request->wallet_id);

    // Handle file upload
    $paymentProofPath = null;
    if ($request->hasFile('payment_proof')) {
        $file = $request->file('payment_proof');
        $destinationPath = public_path('storage/deposits');
        if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);

        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        $paymentProofPath = 'deposits/' . $filename;
    }

    $deposit = Deposit::create([
        'user_id' => $user->id,
        'wallet_id' => $wallet->id,
        'coin_type' => $wallet->coin_type,
        'amount' => $request->amount,
        'status' => 'pending',
        'payment_proof' => $paymentProofPath,
    ]);

    // Send deposit pending email
    try {
        Mail::to($user->email)->send(new DepositStatusMail($deposit));
    } catch (\Throwable $e) {
        \Log::error('Deposit pending email failed: ' . $e->getMessage());
    }

    return redirect()->route('user.dashboard')
                     ->with('success', '✅ Deposit submitted successfully! Our team will review it shortly.');
}

    /**
     * Update deposit status and handle referral bonus
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $deposit = Deposit::with('user.referrer')->findOrFail($id);
        $user = $deposit->user;

        $deposit->update(['status' => $request->status]);

        try {
            Mail::to($user->email)->send(new DepositStatusMail($deposit));
        } catch (\Throwable $e) {
            \Log::error('Deposit status email failed: ' . $e->getMessage());
        }

        if ($request->status === 'approved') {
            $referrer = $user->referrer;

            $isFirstDeposit = Deposit::where('user_id', $user->id)
                ->where('status', 'approved')
                ->count() === 0;

            if ($referrer && $isFirstDeposit) {
                $settings = Setting::first();
                $bonusPercent = $settings->referral_bonus ?? 5;
                $bonusAmount = ($deposit->amount * $bonusPercent) / 100;

                DB::transaction(function () use ($referrer, $bonusAmount) {
                    $referrer->increment('balance', $bonusAmount);
                });

                try {
                    Mail::to($referrer->email)->send(
                        new ReferralBonusMail($referrer, $user, $bonusAmount)
                    );
                } catch (\Throwable $e) {
                    \Log::error('Referral bonus email failed: ' . $e->getMessage());
                }
            }
        }

        return back()->with(
            'success',
            $request->status === 'approved'
                ? '✅ Deposit approved and referral bonus processed!'
                : '❌ Deposit rejected and user notified.'
        );
    }

    /**
     * Update withdrawal status
     */
    public function updateWithdrawalStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $withdrawal = Withdrawal::with('user')->findOrFail($id);
        $withdrawal->update(['status' => $request->status]);

        try {
            Mail::to($withdrawal->user->email)->send(new WithdrawalStatusMail($withdrawal));
        } catch (\Throwable $e) {
            \Log::error('Withdrawal status email failed: ' . $e->getMessage());
        }

        return back()->with('success', $request->status === 'approved'
            ? '✅ Withdrawal approved and user notified!'
            : '❌ Withdrawal rejected and user notified.');
    }

    /**
     * Deposit History
     */
    public function depositHistory()
    {
        $deposits = auth()->user()->deposits()
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('user.history.deposits', compact('deposits'));
    }
}
