<?php

namespace App\Listeners\Users;

use App\Events\Users\UserPasswordGenerated;
use App\Mail\UserCredentialEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserPasswordNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Handle the event.
     *
     * @param UserPasswordGenerated $event
     * @return void
     */
    public function handle(UserPasswordGenerated $event)
    {
        $user = $event->user;
        $plainPassword = $event->plainPassword;

        $emailTo = $user->email;

        if ($user->email) {
            $mailData = [
                'first_name' => $user->first_name,
                'email' => $user->email,
                'password'=> $plainPassword,
            ];
        }

        if (!$user->email && $user->phone_number) {
            // TODO: Send SMS with credentials
        }

        Mail::to($emailTo)->send(new UserCredentialEmail($mailData));

    }
}
