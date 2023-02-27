<?php

namespace App\Events\PackageSubscriptions;

use App\Models\PackageSubscription;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendPackageSubscriptionAcknowledgementEmail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     */
    public function __construct(public PackageSubscription $packageSubscription, public $selectedPackage, public $selectedPackageType, public $selectedCourseModules) {}

}
