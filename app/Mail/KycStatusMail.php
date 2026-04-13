<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KycStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    /**
     * Build the message.
     */


public function build()
{
    $subject = "KYC " . ucfirst($this->status);
   

    return $this->subject($subject)
                ->view('emails.kyc-status')
                ->with([
                    'user' => $this->user,
                    'status' => $this->status,
                    
                ]);
}

}
