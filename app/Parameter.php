<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    protected $fillable = [
        'name','value','parameter_group_id','published','order'
    ];

    public function Parameter_group() {return $this->belongsTo('App\Parameter_group');}
}
