<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferralBonusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $referrer;
    public $user;
    public $bonusAmount;

    public function __construct($referrer, $user, $bonusAmount)
    {
        $this->referrer = $referrer;
        $this->user = $user;
        $this->bonusAmount = $bonusAmount;
    }

    public function build()
    {
        return $this->subject("You've Earned a Referral Bonus!")
                    ->view('emails.referral_bonus')
                    ->with([
                        'referrer' => $this->referrer,
                        'user' => $this->user,
                        'bonusAmount' => $this->bonusAmount,
                    ]);
    }
}
