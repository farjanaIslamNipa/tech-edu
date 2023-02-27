<?php

namespace App\Listeners\Contacts;

use App\Events\Contacts\ContactGenerated;
use App\Mail\ContactAcknowledgementEmailToClient;
use App\Mail\ContactAcknowledgementEmailToInternal;
use App\Models\Admin;
use DateTime;
use Illuminate\Support\Facades\Mail;

class SendContactAcknowledgementEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ContactGenerated $event)
    {
        $contact = $event->contact;

        $clientFirstName = $contact?->client?->user?->first_name ?? 'There';
        $clientLastName = $contact?->client?->user?->last_name ?? '';
        $clientEmail = $contact?->client?->user?->email;
        $phoneNumber = $contact?->client?->user?->phone_number;

        $dateTime = new DateTime($contact?->client?->user?->created_at);
        $date = $dateTime->format(format: 'd F Y');
        $time = $dateTime->format(format: 'h:i A');
        $submittedTime = $date.' '. $time;

        $contactReference = $contact?->reference ?? "Auto Generated Ref";

        $adminEmails  = Admin::query()
            ->where('status', 1)
            ->with('user')
            ->get()
            ->map(function ($admin) {
                return $admin?->user?->email;
            })->toArray();

        $adminEmails = array_values(array_filter($adminEmails));

        $mailData = [
            'first_name'   => $clientFirstName,
            'last_name'   => $clientLastName,
            'reference'    => $contactReference,
            'email'        => $clientEmail,
            'phone_number' => $phoneNumber,
            'created_at'   => $submittedTime,
        ];

        //send email to client
        if ($clientEmail) {
            Mail::to($clientEmail)->send(new ContactAcknowledgementEmailToClient($mailData));
        }

        // send email to internal
        Mail::to('info@certificate4u.com.au')->cc($adminEmails)->send(new ContactAcknowledgementEmailToInternal($mailData));
    }
}
