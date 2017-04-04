<?php

namespace App\Mail;

use App\orderHeader;
use App\SiteParameter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class OrderShipped extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(orderHeader $newOrder)
    {
        //
        $this->order = $newOrder;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

//        return dd(Config::get('mail'));    return json_decode(SiteParameter::first()->parameters,true);

        $siteParameters = json_decode(SiteParameter::first()->parameters,true);

        return $this //->from('elikhvarshops@gmail.com')
            ->subject('заказ на сайте КУПЕРХАНТЕР.УКР')
            ->view('layouts.email.orderNotificator')
            ->with([
                'order' => $this->order,
                'siteParameters' => $siteParameters
            ]);
    }
}
