<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail; // Import the WelcomeMail mailable

class AuthController extends Controller
{
    // Show registration form
    public function showRegister(Request $request)
    {
        // Capture referral code from query string and store in session
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.user.register');
    }

// Handle user registration + auto login
public function register(Request $request)
{
    $validated = $request->validate([
        'fullname'      => 'required|string|max:255',
        'username'      => 'required|string|unique:users|max:255',
        'email'         => 'required|string|email|unique:users|max:255',
        'country'       => 'required|string|max:255',
        'country_code'  => 'required|string|max:10',
        'phone'         => 'required|string|max:15',
        'password'      => 'required|string|min:8|confirmed',
    ]);

    // Create the user
    $user = User::create([
        'fullname'      => $validated['fullname'],
        'username'      => $validated['username'],
        'email'         => $validated['email'],
        'country'       => $validated['country'],
        'country_code'  => $validated['country_code'],
        'phone'         => $validated['phone'],
        'password'      => Hash::make($validated['password']),
    ]);

    // ✅ Assign referrer if available
    if (session()->has('referrer')) {
        $refCode = session('referrer');
        $referrer = User::where('id', $refCode)
                        ->orWhere('username', $refCode)
                        ->first();

        if ($referrer) {
            $user->referrer_id = $referrer->id;
            $user->save();
        }

        session()->forget('referrer');
    }

    // Send Welcome Email
    try {
        Mail::to($user->email)->send(new WelcomeMail($user));
    } catch (\Exception $e) {
        \Log::error('Welcome email failed: '.$e->getMessage());
    }

    // 🔥 AUTO LOGIN the user after registration
    Auth::guard('web')->login($user);

    // Regenerate session to prevent session fixation
    $request->session()->regenerate();

    // Redirect to your dashboard (or wherever you want after login)
    return redirect()->route('user.dashboard')
                     ->with('success', '🎉 Registration successful! Welcome aboard.');
}
    // Show login form
    public function showLogin()
    {
        return view('auth.user.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($loginField, $request->input('login'))->first();

        // Check if user exists and is blocked
        if ($user && $user->is_blocked) {
            return view('auth.user.login')->with('access_denied', '🚫 Your account has been blocked. Please contact support.');
        }

        $credentials = [$loginField => $request->input('login'), 'password' => $request->input('password')];

        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Pass success message directly to the view for animation and countdown
            return view('auth.user.login')->with('login_success', "🎉 Login successful! Welcome back, {$user->fullname}!");
        }

        return back()->withErrors([
            'login' => '❌ Invalid credentials. Please check your email/username and password.',
        ])->onlyInput('login');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login')->with('success', 'You have been logged out successfully.');
    }
}
