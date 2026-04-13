<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get referrals with investments
        $referrals = $user->referrals()->with('investments')->get();

        // Prepare referral tree data for JS
        $referralTree = $referrals->map(function ($r) {
            return [
                'id' => $r->id,
                'username' => $r->username,
                'parent_id' => $r->referrer_id,
                'fullname' => $r->fullname,
            ];
        });

        return view('user.referrals', [
            'user' => $user,
            'referrals' => $referrals,
            'referralLink' => route('user.register', ['ref' => $user->username]),
            'referralTree' => $referralTree,
        ]);
    }
}
