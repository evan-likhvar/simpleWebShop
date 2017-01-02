<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name','published','order','description'
    ];

    public function Articles() {


        //return $this->hasMany('App\Article', 'vendor_id', 'id');
        return $this->hasMany('App\Article');

    }

}
