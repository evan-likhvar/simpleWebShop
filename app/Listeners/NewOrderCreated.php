<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderShipped;
use App\SiteParameter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewOrderCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {
        $parameters = json_decode(SiteParameter::first()->parameters,true);

        Mail::to('evan.likhvar@gmail.com')->queue(new OrderShipped($event->newOrder));
        Mail::to($parameters['emailAdministrator'])->queue(new OrderShipped($event->newOrder));
        Mail::to($event->newOrder->e_mail)->queue(new OrderShipped($event->newOrder));

        //$newOrder=$event->orderHeader;
    }
}
