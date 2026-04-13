<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Investment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyProfitMail;
use App\Mail\InvestmentCompletedMail;

class UpdateInvestmentProfits extends Command
{
    protected $signature = 'investments:update-profits';
    protected $description = 'Credit daily profits and send notifications';

    public function handle()
    {
        $now = Carbon::now();

        $investments = Investment::where('status', 'active')
            ->with('user', 'plan')
            ->get();

        foreach ($investments as $investment) {

            // Ensure last_profit_time is Carbon
            $lastProfitTime = $investment->last_profit_time ? Carbon::parse($investment->last_profit_time) : Carbon::parse($investment->started_at);

            while ($now->diffInHours($lastProfitTime) >= 24) {

                // Calculate daily profit
                $dailyProfit = ($investment->amount * $investment->plan->daily_roi) / 100;

                // Credit user profit
                $user = $investment->user;
                $user->profit += $dailyProfit;
                $user->save();

                // Update investment
                $investment->profit += $dailyProfit;
                $lastProfitTime->addDay();
                $investment->last_profit_time = $lastProfitTime;
                $investment->save();

                // Send daily profit email
                try {
                    Mail::to($user->email)->queue(new DailyProfitMail($investment));
                } catch (\Exception $e) {
                    \Log::error("Daily profit email failed for Investment ID {$investment->id}: " . $e->getMessage());
                }

                $this->info("Daily profit credited for Investment ID: {$investment->id}");
            }

            // Complete investment if ended
            if ($now->gte(Carbon::parse($investment->ends_at))) {
                $this->completeInvestment($investment);
            }
        }

        return Command::SUCCESS;
    }

    private function completeInvestment(Investment $investment)
    {
        if ($investment->status !== 'active') return;

        $investment->status = 'completed';
        $investment->save();

        $user = $investment->user;

        // Return capital (profit already credited)
        $user->balance += $investment->amount;
        $user->save();

        // Send completion email
        try {
            Mail::to($user->email)->queue(new InvestmentCompletedMail($investment));
        } catch (\Exception $e) {
            \Log::error("Investment completed email failed for Investment ID {$investment->id}: " . $e->getMessage());
        }

        $this->info("Investment ID {$investment->id} completed.");
    }
}
