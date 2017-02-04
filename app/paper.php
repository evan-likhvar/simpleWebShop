<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paper extends Model
{
    protected $fillable = [
        'papercategory_id','name','published','order','metakey','metadescription','fullDescription'
    ];


    public function papercategory() {return $this->belongsTo('App\papercategory');}
}
