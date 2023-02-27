<?php

namespace App\Listeners\PackageSubscriptions;

use App\Events\PackageSubscriptions\PackageSubscriptionReferenceGenerated;
use Hashids\Hashids;

class PackageSubscriptionReferenceGeneratedListener
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
    public function handle(PackageSubscriptionReferenceGenerated $event)
    {
        $packageSubscription = $event->packageSubscription;

        $hashids = new Hashids(salt: '', minHashLength: 6);

        $hashedId = $hashids->encode($packageSubscription->id);

        $packageSubscription->update(['reference'=> $hashedId]);
    }
}
