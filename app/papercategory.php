<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class papercategory extends Model
{
    //
    protected $fillable = [
        'name','published','order','description','parent_id','onHomePage','metakey','metadescription'
    ];


    public function papers()          {return $this->hasMany          ('App\paper');}
    public function parent()            {return $this->belongsTo        ('App\papercategory', 'parent_id', 'id');}
    public function children()          {return $this->hasMany          ('App\papercategory','parent_id','id');}
}
