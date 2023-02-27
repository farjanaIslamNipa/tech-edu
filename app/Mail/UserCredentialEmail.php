<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCredentialEmail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public array $mailData){}

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->from(address: config('mail.from.address'), name: "Certificate4U Internal")
            ->subject(subject: 'Password Generated')
            ->view('backEnd.pages.users.email')->with([
                'mailData' => $this->mailData,
            ]);
    }
}
