<?php

namespace App\Listeners\Contacts;

use App\Events\Contacts\ContactGenerated;
use Hashids\Hashids;

class GenerateContactReference
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
     * @param ContactGenerated $event
     * @return void
     */
    public function handle(ContactGenerated $event)
    {
        $contact = $event->contact;

        $hashids = new Hashids(salt: '', minHashLength: 6);

        $hashedId = $hashids->encode($contact->id);

        $contact->update(['reference'=> $hashedId]);
    }
}
