<?php

namespace App\Listeners;

use App\Events\OrderCreatedEvent;
use App\Mail\OrderCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class OrderCreatedListener implements ShouldQueue
{
    use InteractsWithQueue;

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
    public function handle(OrderCreatedEvent $event): void
    {
        Mail::to($event->getClient()->email)
            ->queue(new OrderCreatedMail($event->getOrder()));
    }
}
