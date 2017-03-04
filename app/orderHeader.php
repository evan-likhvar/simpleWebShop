<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class orderHeader extends Model
{
    //
    protected $fillable = [
        'nomer','contact_name','phone','e_mail','payer','status','description'
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
