<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_amount',
        'max_amount',
        'daily_roi',
        'duration_days',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
