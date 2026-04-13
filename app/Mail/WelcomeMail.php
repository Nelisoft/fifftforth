<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Setting; // For app name from DB

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $appName;

    /**
     * Create a new message instance.
     */
    public function __construct($user)
    {
        $this->user = $user;

        // Fetch app/company name from DB
        $setting = Setting::first();
        $this->appName = $setting->app_name ?? 'YourAppName';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Welcome {$this->user->fullname} to {$this->appName}!")
                    ->view('emails.welcome')
                    ->with([
                        'user' => $this->user,
                        'appName' => $this->appName,
                    ]);
    }
}
