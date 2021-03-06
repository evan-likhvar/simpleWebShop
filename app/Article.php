<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{

    protected $fillable = [
        'hotline','priceua','category_id','vendor_id','name','priceYE','priceGRN','published','order','description','techDescription','additionInfo','extraInfo','guarantee','nomer','metakey','metadescription','avaliable','fullDescription'
    ];


    public function Vendor() {return $this->belongsTo('App\Vendor');}
    public function Category() {return $this->belongsTo('App\Category');}
    public function Promotions() {return $this->belongsToMany('App\Promotion');}

    public static function recalculatePrices($course){

        DB::statement("UPDATE articles set priceGRN = priceYE*? where priceYE>0 ",[$course]) ;

        return;
    }


    public function getIntroImg($size,$name='intro1'){
        $path = '/images/articles/'.$this->id.'/'.$name.'/';
        $name = md5("Image".$this->id);
        $img = $path.$name.'_'.$size.'.jpg';

        $fullPath = public_path().$img;

        if (file_exists($fullPath)){
            return $img;
        }
        //return dd($fullPath);

        return 'noImage';
    }


    public function getArticleLink(): string
    {

        $name = str_replace(['---','--'],'-',str_replace([' ','/','.',':','&','(',')'],['-','-','-','-','-','-','-'],trim($this->name)));
//return dd($name);

        return $this->id.'-'.$name;
    }

    public function getCountActivePromotions() {

        $itemPromotionCount = count($this->Promotions->where('is_published',1));

        return $itemPromotionCount;

    }


}
