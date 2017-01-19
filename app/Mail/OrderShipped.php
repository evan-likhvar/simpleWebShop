<?php

namespace App\Mail;

use App\orderHeader;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;

class OrderShipped extends Mailable
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

        //return dd(Config::get('mail'));
        return $this->from('elikhvarshops@gmail.com')
            ->to($this->order->e_mail)
            ->subject('заказ на сайте КУПЕРХАНТЕР.УКР')
            ->view('layouts.email.qwerty')
            ->with([
                'order' => $this->order
            ]);
    }
}
