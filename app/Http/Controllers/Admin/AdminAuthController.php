<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Show the admin login form
     */
    public function showLoginForm()
    {
        return view('auth.admin.login'); // admin login view
    }

    /**
     * Handle admin login request
     */
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if the input is email or username
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $login_type => $request->login,
            'password' => $request->password,
        ];

        // Attempt login with admin guard
        if (Auth::guard('admin')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
        }

        // If login fails
        return back()->withErrors([
            'login' => 'Invalid credentials. Please try again.',
        ])->onlyInput('login');
    }

    /**
     * Log the admin out of the system
     */
public function logout(Request $request)
{
    Auth::guard('admin')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
}

/**
 * Show Admin Profile Settings
 */
public function showProfile()
{
    $admin = Auth::guard('admin')->user();
    return view('admin.profile', compact('admin'));
}

/**
 * Update Admin Profile
 */
public function updateProfile(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'fullname' => 'required|string|max:255',
        'username' => 'required|string|max:50|unique:admins,username,' . $admin->id,
        'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
        'country' => 'nullable|string|max:100',
        'country_code' => 'nullable|string|max:10',
        'phone' => 'nullable|string|max:20',
    ]);

    $admin->update($request->only(['fullname', 'username', 'email', 'country', 'country_code', 'phone']));

    return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
}

/**
 * Change Admin Password
 */
public function changePassword(Request $request)
{
    $admin = Auth::guard('admin')->user();

    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    if (!\Hash::check($request->current_password, $admin->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    $admin->password = \Hash::make($request->new_password);
    $admin->save();

    return redirect()->route('admin.profile')->with('success', 'Password changed successfully!');
}


}
