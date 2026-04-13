<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WithdrawalSetting;

class WithdrawalSettingController extends Controller
{
    public function index()
    {
        $settings = WithdrawalSetting::first();
        return view('admin.withdrawals.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'min_withdrawal' => 'required|numeric|min:0',
            'max_withdrawal' => 'required|numeric|gt:min_withdrawal',
        ]);

        $settings = WithdrawalSetting::firstOrNew(); // auto create if empty
        $settings->min_withdrawal = $request->min_withdrawal;
        $settings->max_withdrawal = $request->max_withdrawal;
        $settings->save();

        return back()->with('success', '✅ Withdrawal settings updated successfully!');
    }
}
