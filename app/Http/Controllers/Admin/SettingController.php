<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    /**
     * Display settings page
     */
    public function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'logo_dark' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico|max:1024',
            'app_url' => 'nullable|url',
            'default_language' => 'required|string|max:5',
            'timezone' => 'required|string|max:50',
            'referral_bonus' => 'required|numeric|min:0',
        ]);

        $setting = Setting::firstOrNew();

        // Handle file uploads for logo, dark logo, favicon
        foreach (['logo', 'logo_dark', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                // Delete old file if exists
                if (!empty($setting->$field) && file_exists(public_path('storage/' . $setting->$field))) {
                    unlink(public_path('storage/' . $setting->$field));
                }

                // Create directory if it doesn't exist
                $destinationPath = public_path('storage/settings');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Save file directly to public/storage/settings
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $filename);

                // Store relative path in DB
                $setting->$field = 'settings/' . $filename;
            }
        }

        // Update other fields
        $setting->app_name = $request->app_name;
        $setting->tagline = $request->tagline;
        $setting->app_url = $request->app_url;
        $setting->default_language = $request->default_language;
        $setting->timezone = $request->timezone;
        $setting->referral_bonus = $request->referral_bonus;

        $setting->save();

        return back()->with('success', '✅ Settings updated successfully!');
    }
}
