<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'profit',
        'status',
        'started_at',
        'ends_at',
        'capital_returned',
        'last_profit_time',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
        'capital_returned' => 'boolean',
    ];

    // Relationships
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Check if investment is active
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    // Check if investment is cancelled
    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    // Check if investment is completed
    public function isComplete(): bool
    {
        return $this->status === 'completed' || ($this->ends_at && Carbon::now()->gte($this->ends_at));
    }

    // Total duration in days
    public function durationDays(): int
    {
        return $this->started_at && $this->ends_at
            ? max(1, $this->started_at->diffInDays($this->ends_at))
            : ($this->plan->duration_days ?? 0);
    }

    // Days elapsed since start
    public function elapsedDays(): int
    {
        if (!$this->started_at) return 0;

        $now = Carbon::now();
        if ($now->lt($this->started_at)) return 0;

        return min($now->diffInDays($this->started_at), $this->durationDays());
    }

    // Dynamic profit calculation
    public function profitSoFar(): float
    {
        if (!$this->plan || !$this->started_at || $this->isCancelled()) {
            return 0.00;
        }

        $days = $this->isComplete() ? $this->durationDays() : $this->elapsedDays();
        return round(($this->amount * $this->plan->daily_roi / 100) * $days, 2);
    }

    // Time remaining until completion
    public function remainingTime(): string
    {
        if (!$this->ends_at) return 'N/A';
        if ($this->isComplete()) return 'Ended';

        $diff = Carbon::now()->diff($this->ends_at);
        return sprintf('%dd %dh %dm', $diff->d, $diff->h, $diff->i);
    }

    // Progress percentage (0–100)
    public function progressPercent(): float
    {
        if (!$this->started_at || !$this->ends_at) return 0;

        $now = Carbon::now()->timestamp;
        $start = $this->started_at->timestamp;
        $end = $this->ends_at->timestamp;

        // Not started yet
        if ($now < $start) return 0;

        // Already ended
        if ($now >= $end) return 100;

        $totalSeconds = $end - $start;
        $elapsedSeconds = $now - $start;

        return round(($elapsedSeconds / $totalSeconds) * 100, 2);
    }

    // Return capital if not yet returned
    public function returnCapital(): void
    {
        if (!$this->capital_returned && !$this->isActive()) {
            $this->user->balance += $this->amount;
            $this->user->save();

            $this->capital_returned = true;
            $this->save();
        }
    }

    // Check if capital is returned
    public function hasReturnedCapital(): bool
    {
        return $this->capital_returned;
    }
}
