<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = ['name','promotion_type','intro','description','order','is_published','promo_articles','promo_categories'];

    public function PromotionType() {return $this->belongsTo('App\Promotion_type','promotion_type', 'id');}
    public function Articles() {return $this->belongsToMany('App\Article');}


    public function getIntroImg($size,$name='intro1'){
        $path = '/images/promotion/'.$this->id.'/'.$name.'/';
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
}
