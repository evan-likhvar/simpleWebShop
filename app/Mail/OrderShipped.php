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

        //return dd(Config::get('mail'),$this->order,$this,$this->to[0]['address']);    return json_decode(SiteParameter::first()->parameters,true);

        $siteParameters = json_decode(SiteParameter::first()->parameters,true);

        $mail =  $this
            ->subject($siteParameters['emailTitle'])
            ->from($siteParameters['emailSender'],$siteParameters['emailName'])
            ->view('layouts.email.orderNotificator')
            ->with([
                'order' => $this->order,
                'siteParameters' => $siteParameters
            ]);

        if (($this->to[0]['address'] === 'evan.likhvar@gmail.com') || ($this->to[0]['address'] === $siteParameters['emailAdministrator']))
            $mail = $this->view('layouts.email.orderNotificatorAdmin')->with([
                'order' => $this->order,
                'siteParameters' => $siteParameters
            ]);

        //return dd($siteParameters,$mail,$this->order);

        return $mail;
    }
}
