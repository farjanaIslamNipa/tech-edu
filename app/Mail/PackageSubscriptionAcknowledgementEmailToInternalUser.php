<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PackageSubscriptionAcknowledgementEmailToInternalUser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public array $mailData) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->from(address: config('mail.from.address'), name: "Geeks Learning Internal")
            ->subject(subject: 'New Package Subscription')
            ->view('email.internal-package-subscription-mail')->with([
                'mailData' => $this->mailData,
            ]);
    }
}
