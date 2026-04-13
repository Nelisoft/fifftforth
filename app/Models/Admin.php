<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
       'fullname',
        'username',
        'email',
        'country',
        'country_code',
        'phone',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
