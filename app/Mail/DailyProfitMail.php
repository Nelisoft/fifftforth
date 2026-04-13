<?php

namespace App\Mail;

use App\Models\Investment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyProfitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $investment;

    public function __construct(Investment $investment)
    {
        $this->investment = $investment;
    }

    public function build()
    {
        return $this->subject('Daily Profit Update 💰')
                    ->view('emails.investments.daily_profit');
    }
}
