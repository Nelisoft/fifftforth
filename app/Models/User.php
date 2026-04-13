<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'country',
        'country_code',
        'phone',
        'balance',
        'profit',
        'password',
        'is_blocked',
        'referrer_id',
        'referral_bonus_received',
        // KYC fields
        'Home_address',
        'kyc_document',
        'kyc_status',
        'kyc_submitted_at',
        'kyc_reviewed_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'balance' => 'float',
        'referral_bonus_received' => 'boolean',
        'kyc_submitted_at' => 'datetime',
        'kyc_reviewed_at' => 'datetime',
    ];

    // Relationships
    public function deposits() { return $this->hasMany(Deposit::class); }
    public function investments() { return $this->hasMany(Investment::class); }
    public function withdrawals() { return $this->hasMany(Withdrawal::class); }

    // Referrals
    public function referrer() { return $this->belongsTo(User::class, 'referrer_id'); }
    public function referrals() { return $this->hasMany(User::class, 'referrer_id'); }

    // Total referral earnings
    public function totalReferralEarnings(): float
    {
        $bonus = Setting::first()?->referral_bonus ?? 10;

        return $this->referrals()
                    ->where('referral_bonus_received', true)
                    ->count() * $bonus;
    }
}
