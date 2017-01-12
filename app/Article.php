<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{

    protected $fillable = [
        'category_id','vendor_id','name','priceYE','priceGRN','published','order','description','techDescription','additionInfo','extraInfo','nomer','metakey','metadescription','avaliable','fullDescription'
    ];


    public function Vendor() {return $this->belongsTo('App\Vendor');}
    public function Category() {return $this->belongsTo('App\Category');}

    public static function recalculatePrices($course){

        DB::statement("UPDATE articles set priceGRN = priceYE*? where priceYE>0 ",[$course]) ;

        return;
    }


    public function getIntroImg($size,$name='intro1'){
        $path = '/images/articles/'.$this->id.'/'.$name.'/';
        $name = md5("Image".$this->id);
        $img = $path.$name.'_'.$size.'.jpg';

        // return dd($img);
        return $img;
    }



}
