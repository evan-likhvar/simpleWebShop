<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class orderHeader extends Model
{
    //
    //protected $Color;

    public function getColorAttribute()
    {
        $color = 'white';
        if ($this->status == 0) $color = 'orangered';
        if ($this->status == 1) $color = 'yellow';
        if ($this->status == 2) $color = 'greenyellow';
        if ($this->status == 3) $color = 'green';
        return $color;
    }
    public function getStatusNameAttribute()
    {
        $StatusName = 'новый';
        if ($this->status == 0) $StatusName = 'новый';
        if ($this->status == 1) $StatusName = 'подтвержденный';
        if ($this->status == 2) $StatusName = 'выполняемый';
        if ($this->status == 3) $StatusName = 'завершенный';
        if ($this->status == 4) $StatusName = 'отмененный';
        return $StatusName;
    }
    public function getPaymentNameAttribute()
    {
        $PaymentName = '----';
        if ($this->payment_type == 1) $PaymentName = 'наличными';
        if ($this->payment_type == 2) $PaymentName = 'безнал';
        return $PaymentName;
    }
    public function getShipmentNameAttribute()
    {
        $ShipmentName = '----';
        if ($this->shipment == 1) $ShipmentName = 'к подъезду';
        if ($this->shipment == 2) $ShipmentName = 'с установкой';
        if ($this->shipment == 3) $ShipmentName = 'самовывоз';
        return $ShipmentName;
    }

    protected $fillable = [
        'nomer','contact_name','phone','e_mail','payer','status','description','privat_description','payment_type','shipment','location'
    ];
    public function orderRows()    {return $this->hasMany('App\orderRow');}

    public function orderAmount() {

        $amount = DB::table('order_rows')
            ->select(DB::raw('sum(count*priceGRN) amount'))
            ->where('order_header_id', $this->id)
            ->first();

        return $amount->amount;
    }

    public function quantityAmount() {

        $quantity = DB::table('order_rows')
            ->select(DB::raw('sum(count) quantity'))
            ->where('order_header_id', $this->id)
            ->first();

        return $quantity->quantity;
    }
}
