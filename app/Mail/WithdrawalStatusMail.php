<?php

namespace App\Mail;

use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WithdrawalStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawal;

    /**
     * Create a new message instance.
     */
    public function __construct(Withdrawal $withdrawal)
    {
        $this->withdrawal = $withdrawal;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $subject = "Withdrawal " . ucfirst($this->withdrawal->status) . " Notification";

        return $this->subject($subject)
                    ->view('emails.withdrawal.status'); // Make sure this view exists
    }
}
