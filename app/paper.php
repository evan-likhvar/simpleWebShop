<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class paper extends Model
{
    protected $fillable = [
        'papercategory_id','name','published','order','metakey','metadescription','description','fullDescription'
    ];


    public function papercategory() {return $this->belongsTo('App\papercategory');}


    public function shortText ($words_count) {
        $text = $this->fullDescription;
        if (str_word_count($this->fullDescription,0)>$words_count) {
            $words = str_word_count($this->fullDescription,2);
            $pos = array_keys($words);
            $text = substr($this->fullDescription,0,$pos[$words_count]).'....';
        }
        return $text;
    }

    public function getIntroImg($size,$name='intro1'){
        $path = '/images/papers/'.$this->id.'/'.$name.'/';
        $name = md5("Image".$this->id);
        $img = $path.$name.'_'.$size.'.jpg';

        $fullPath = public_path().$img;

        if (file_exists($fullPath)){
            return $img;
        }
        //return dd($fullPath);

        return 'noImage';
    }
}
