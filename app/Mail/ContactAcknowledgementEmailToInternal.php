<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAcknowledgementEmailToInternal extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public array $mailData)
    {
        //
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->from(address: config('mail.from.address'), name: "Certificate4U Internal")
            ->subject(subject: 'New Contact Request Received')
            ->view('email.internal-contact-mail')->with([
                'mailData' => $this->mailData,
            ]);
    }
}
