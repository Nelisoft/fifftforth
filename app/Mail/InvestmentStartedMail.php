<?php

namespace App\Mail;

use App\Models\Investment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvestmentStartedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $investment;

    public function __construct(Investment $investment)
    {
        $this->investment = $investment;
    }

    public function build()
    {
        return $this->subject('Your Investment Has Started 🚀')
                    ->view('emails.investments.investment_started');
    }
}
