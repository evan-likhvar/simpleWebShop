<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderHeader extends Model
{
    //
    protected $fillable = [
        'nomer','contact_name','phone','e_mail','payer','status','description'
    ];
    public function orderRows()    {return $this->hasMany('App\orderRow');}
}
