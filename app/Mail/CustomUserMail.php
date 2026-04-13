<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $messageContent;

    /**
     * Create a new message instance.
     */
    public function __construct($subjectText, $messageContent)
    {
        $this->subjectText = $subjectText;
        $this->messageContent = $messageContent;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subjectText)
                    ->view('emails.custom')
                    ->with([
                        'subject' => $this->subjectText,
                        'messageContent' => $this->messageContent,
                    ]);
    }
}
