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

    protected $fillable = [
        'nomer','contact_name','phone','e_mail','payer','status','description','privat_description'
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
