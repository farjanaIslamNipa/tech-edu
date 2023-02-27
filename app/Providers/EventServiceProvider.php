<?php

namespace App\Providers;

use App\Events\Contacts\ContactGenerated;
use App\Events\PackageSubscriptions\PackageSubscriptionReferenceGenerated;
use App\Events\PackageSubscriptions\SendPackageSubscriptionAcknowledgementEmail;
use App\Events\Users\UserPasswordGenerated;
use App\Listeners\Contacts\GenerateContactReference;
use App\Listeners\Contacts\SendContactAcknowledgementEmail;
use App\Listeners\PackageSubscriptions\PackageSubscriptionReferenceGeneratedListener;
use App\Listeners\PackageSubscriptions\SendPackageSubscriptionAcknowledgementEmailListener;
use App\Listeners\Users\SendUserPasswordNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserPasswordGenerated::class => [
            SendUserPasswordNotification::class,
        ],
        ContactGenerated::class => [
            GenerateContactReference::class,
            SendContactAcknowledgementEmail::class,
        ],
        PackageSubscriptionReferenceGenerated::class => [
            PackageSubscriptionReferenceGeneratedListener::class,
        ],
        SendPackageSubscriptionAcknowledgementEmail::class => [
            SendPackageSubscriptionAcknowledgementEmailListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


}
