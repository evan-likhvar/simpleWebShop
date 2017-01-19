<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderShipped;
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
        //
        //return dd($event->newOrder);
        Mail::to('evan.likhvar@gmail.com')->send(new OrderShipped($event->newOrder));


        //$newOrder=$event->orderHeader;
    }
}
