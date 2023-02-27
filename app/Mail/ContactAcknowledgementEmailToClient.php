<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAcknowledgementEmailToClient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public array $mailData) {}

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->from(address: config('mail.from.address'), name: "Certificate4U (do not reply)")
            ->subject(subject: 'Contact Request Acknowledgement')
            ->view('email.client-contact-mail')->with([
                'mailData' => $this->mailData,
            ]);
    }
}
