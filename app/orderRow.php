<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderRow extends Model
{
    //
    protected $fillable = [
        'orderHeader_id','article_id','article_name','count','priceGRN'
    ];
    public function orderHeader() {return $this->belongsTo('App\orderHeader');}
}
