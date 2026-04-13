<?php

namespace App\Mail;

use App\Models\Deposit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DepositStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $deposit;

    /**
     * Create a new message instance.
     */
    public function __construct(Deposit $deposit)
    {
        $this->deposit = $deposit;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = "Deposit " . ucfirst($this->deposit->status) . " Notification";

        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject($subject)
                    ->view('emails.deposit.status')
                    ->with([
                        'deposit' => $this->deposit,
                        'user' => $this->deposit->user,
                    ]);
    }
}
