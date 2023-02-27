<?php

namespace App\Listeners\PackageSubscriptions;

use App\Events\PackageSubscriptions\SendPackageSubscriptionAcknowledgementEmail;
use App\Mail\PackageSubscriptionAcknowledgementEmailToClient;
use App\Mail\PackageSubscriptionAcknowledgementEmailToInternalUser;
use App\Models\Admin;
use DateTime;
use Illuminate\Support\Facades\Mail;

class SendPackageSubscriptionAcknowledgementEmailListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct() {}

    /**
     * Handle the event.
     *
     */
    public function handle(SendPackageSubscriptionAcknowledgementEmail $event)
    {
        $packageSubscription = $event->packageSubscription;

        $customizedPackageName = $event->selectedPackage->name;
        $customizedPackageType = $event->selectedPackageType->type;
        $paymentLink = $event->selectedPackageType->payment_link;
        $customizedCourseModules = $event->selectedCourseModules;


        $clientFirstName = $packageSubscription?->client->user->first_name ?: 'There';

        $clientLastName = $packageSubscription?->client?->user?->last_name ?? '';
        $clientEmail = $packageSubscription?->client->user->email ?: null;
        $phoneNumber = $packageSubscription?->client->user->phone_number?? '';

       $packageSubscriptionReference  = $packageSubscription->reference;
        $totalPrice  = $packageSubscription->total_price;

        $dateTime = new DateTime($packageSubscription->created_at);
        $date = $dateTime->format(format: 'd F Y');
        $time = $dateTime->format(format: 'h:i A');
        $subscriptionStartDate = $date.' '. $time;

//           $packagePrice  = $packageSubscription->package_price;
//           $discountPrice  = $packageSubscription->discount_price;
//           $gstPrice  = $packageSubscription->gst_price;
//           $paymentStatus  = $packageSubscription->payment_status;
//           $subscriptionStatus  = $packageSubscription->subscription_status;
//           $subscriptionEndDate  = $packageSubscription->subscription_end_date;

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
            'email'        => $clientEmail,
            'phone_number' => $phoneNumber,

            'package_name' => $customizedPackageName,
            'type'          => $customizedPackageType,
            'customizedCourseModules' => $customizedCourseModules,

            'reference' => $packageSubscriptionReference,
            'total_price' => $totalPrice,
            'start_date' => $subscriptionStartDate,
            'payment_link' => $paymentLink,

        ];

        //send email to client
        if ($clientEmail) {
            Mail::to($clientEmail)->send(new PackageSubscriptionAcknowledgementEmailToClient($mailData));
        }

        // send email to internal
        Mail::to('info@geekslearning.au')->cc($adminEmails)->send(new PackageSubscriptionAcknowledgementEmailToInternalUser($mailData));

    }
}
