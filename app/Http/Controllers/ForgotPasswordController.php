<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    /**
     * Show the form to request a password reset link.
     */
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Handle sending the password reset link email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // ✅ Generate token manually
        $token = Password::broker('users')->createToken($user);

        // ✅ Send custom notification with full APP_URL
        $user->notify(new class($token) extends ResetPasswordNotification {
            public $token;

            public function __construct($token)
            {
                $this->token = $token;
            }

            public function toMail($notifiable)
            {
                // Use APP_URL from .env
                $appUrl = config('app.url');

                $url = $appUrl . route('user.password.reset', [
                    'token' => $this->token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false);

                return (new \Illuminate\Notifications\Messages\MailMessage)
                    ->subject('Forgot Your Password?')
                    ->line('You are receiving this email because we received a password reset request for your account.')
                    ->action('Reset Password', $url)
                    ->line('Email Address: ' . $notifiable->getEmailForPasswordReset())
                    ->line('Back to Login');
            }
        });

        return back()->with('status', 'Password reset link sent to your email.');
    }
}
