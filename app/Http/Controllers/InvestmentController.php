<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvestmentStartedMail;
use App\Mail\InvestmentCompletedMail;
use App\Mail\DailyProfitMail;
use Carbon\Carbon;

class InvestmentController extends Controller
{
    /**
     * Show all user investments
     */
    public function index()
    {
        $investments = auth()->user()->investments()
            ->with('plan')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $investments->getCollection()->transform(function ($inv) {
            $inv = $this->appendDynamicFields($inv);
            $inv->profit = round($inv->profitSoFar(), 2);
            return $inv;
        });

        return view('user.plans.index', compact('investments'));
    }

    /**
     * Show only active investments
     */
    public function active()
    {
        $investments = auth()->user()->investments()
            ->with('plan')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $investments->getCollection()->transform(fn($inv) => $this->appendDynamicFields($inv));

        return view('user.plans.active', compact('investments'));
    }

    /**
     * Show single investment
     */
    public function show(Investment $investment)
    {
        if ($investment->user_id !== Auth::id()) abort(403);

        $investment = $this->appendDynamicFields($investment);
        return view('user.plans.show', compact('investment'));
    }

    /**
     * Show investment creation form
     */
    public function create()
    {
        $plans = Plan::all();
        return view('user.plans.create', compact('plans'));
    }

    /**
     * Store a new investment using total balance
     */
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $plan = Plan::findOrFail($request->plan_id);
        $user = Auth::user();

        $totalBalance = ($user->balance ?? 0) + ($user->profit ?? 0);

        if ($request->amount > $totalBalance) {
            return back()->with('error', 'Insufficient total balance.');
        }

        // Deduct proportionally from balance and profit
        $amountRemaining = $request->amount;

        if ($user->balance >= $amountRemaining) {
            $user->balance -= $amountRemaining;
        } else {
            $amountRemaining -= $user->balance;
            $user->balance = 0;
            $user->profit -= $amountRemaining;
        }

        $user->save();

        $startedAt = now();
        $endsAt = $startedAt->copy()->addDays($plan->duration_days);

        $investment = Investment::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'amount' => $request->amount,
            'profit' => 0,
            'status' => 'active',
            'started_at' => $startedAt,
            'ends_at' => $endsAt,
            'last_profit_time' => $startedAt,
        ]);

        try {
            Mail::to($user->email)->send(new InvestmentStartedMail($investment));
        } catch (\Exception $e) {
            \Log::error("Investment started email failed: " . $e->getMessage());
        }

        return redirect()->route('user.plans.index')->with('success', 'Investment started successfully!');
    }

    /**
     * Cancel an active investment
     */
    public function cancel(Investment $investment)
    {
        if (!$investment->isActive()) {
            return back()->with('error', 'This investment cannot be canceled.');
        }

        $investment->status = 'cancelled';
        $investment->save();

        return back()->with('success', 'Investment canceled successfully.');
    }

    /**
     * Live AJAX updates for progress
     */
    public function live()
    {
        $investments = auth()->user()->investments()->with('plan')->latest()->get();

        $data = $investments->map(fn($inv) => [
            'id' => $inv->id,
            'status' => $inv->status,
            'profit' => max(0, round($inv->profitSoFar(), 2)),
            'progress' => min(100, max(0, round($inv->progressPercent(), 2))),
            'remaining_time' => $inv->remainingTime(),
        ]);

        return response()->json($data);
    }

    /**
     * Run daily profit update for all active investments
     */
    public function updateDailyProfits()
    {
        $investments = Investment::where('status', 'active')->with('plan', 'user')->get();

        foreach ($investments as $inv) {
            if ($inv->last_profit_time === null) {
                $inv->last_profit_time = $inv->started_at;
            }

            while (Carbon::parse($inv->last_profit_time)->diffInHours(now()) >= 24) {
                $dailyProfit = max(0, ($inv->amount * $inv->plan->daily_roi / 100));

                $inv->profit += $dailyProfit;
                $inv->last_profit_time = Carbon::parse($inv->last_profit_time)->addDay();
                $inv->save();

                $user = $inv->user;
                $user->profit += $dailyProfit;
                $user->save();

                try {
                    Mail::to($user->email)->send(new DailyProfitMail($inv));
                } catch (\Exception $e) {
                    \Log::error("Daily profit email failed for user {$user->id}, investment {$inv->id}: " . $e->getMessage());
                }
            }

            if (now()->gte($inv->ends_at)) {
                $this->completeInvestment($inv);
            }
        }

        return response()->json(['message' => 'Daily profits updated successfully']);
    }

    /**
     * Complete an investment
     */
    public function completeInvestment(Investment $investment)
    {
        if (!$investment->isActive()) return;

        $user = $investment->user;

        $fullProfit = max(0, $investment->profitSoFar());
        if ($investment->profit < $fullProfit) {
            $difference = $fullProfit - $investment->profit;
            $investment->profit += $difference;
            $user->profit += $difference;
        }

        $investment->status = 'completed';
        $investment->save();

        $user->balance += $investment->amount;
        $user->save();

        try {
            Mail::to($user->email)->send(new InvestmentCompletedMail($investment));
        } catch (\Exception $e) {
            \Log::error("Investment completed email failed: " . $e->getMessage());
        }
    }

    /**
     * Append dynamic fields for Blade templates
     */
    private function appendDynamicFields(Investment $inv)
    {
        $profit = round($inv->profitSoFar(), 2);
        $progress = round($inv->progressPercent(), 2);

        $inv->profit = max(0, $profit);
        $inv->progress = min(100, max(0, $progress));
        $inv->remaining_time = $inv->remainingTime();

        return $inv;
    }
}
