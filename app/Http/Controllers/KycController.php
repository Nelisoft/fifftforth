<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    public function show()
    {
        return view('user.kyc');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'Home_address' => 'required|string|max:255',
            'kyc_document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $user = Auth::user();

        // Store document
        if ($request->hasFile('kyc_document')) {
            $path = $request->file('kyc_document')->store('kyc_documents', 'public');
            $user->kyc_document = $path;
        }

        $user->Home_address = $request->Home_address;
        $user->kyc_status = 'pending';
        $user->kyc_submitted_at = now();
        $user->save();

        return back()->with('success', '✅ KYC submitted successfully.');
    }
}
