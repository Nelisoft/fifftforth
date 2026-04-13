<?php

namespace App\Mail;

use App\Models\Investment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvestmentCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $investment;

    public function __construct(Investment $investment)
    {
        $this->investment = $investment;
    }

    public function build()
    {
        return $this->subject('Investment Completed 🎉')
                    ->view('emails.investments.investment_completed');
    }
}
