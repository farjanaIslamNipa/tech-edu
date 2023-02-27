<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PackageSubscriptionAcknowledgementEmailToClient extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public array $mailData) {}

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->from(address: config('mail.from.address'), name: "Geeks Learning (do not reply)")
            ->subject(subject: 'Package Subscription Acknowledgement')
            ->view('email.client-package-subscription-mail')->with([
                'mailData' => $this->mailData,
            ]);
    }
}
