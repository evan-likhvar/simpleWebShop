<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable = [
        'category_id','vendor_id','name','priceYE','priceGRN','published','order','description','techDescription','additionInfo','extraInfo'
    ];


    public function Vendor() {return $this->belongsTo('App\Vendor');}
    public function Category() {return $this->belongsTo('App\Category');}

    public function getIntroImg($size){
        $path = '/images/articles/'.$this->id.'/intro1/';
        $name = md5("Image".$this->id);
        $img = $path.$name.'_'.$size.'.jpg';

        // return dd($img);
        return $img;
    }

}
