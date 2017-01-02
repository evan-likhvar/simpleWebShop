<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parameter_group extends Model
{
    protected $fillable = [
        'name','published','order','description'
    ];

    public function Parameters()    {return $this->hasMany          ('App\Parameter');}
    public function Categories()    {return $this->belongsToMany    ('App\Category');}
}
