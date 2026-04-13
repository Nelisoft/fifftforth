<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'app_name',
        'tagline',
        'logo',
        'logo_dark',
        'favicon',
        'app_url',
        'default_language',
        'timezone',
        'referral_bonus', // added for referral bonus
    ];
}
