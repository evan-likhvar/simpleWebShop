<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    protected $fillable = [
        'name','published','order','description','parent_id','onHomePage'
    ];


    public function Articles()          {return $this->hasMany          ('App\Article');}
    public function parent()            {return $this->belongsTo        ('App\Category', 'parent_id', 'id');}
    public function children()          {return $this->hasMany          ('App\Category','parent_id','id');}
    public function Parameter_groups()  {return $this->belongsToMany    ('App\Parameter_group');}


    public function getIntroImg($size){
        $path = '/images/categories/'.$this->id.'/intro1/';
        $name = md5("Image".$this->id);
        $img = $path.$name.'_'.$size.'.jpg';

       // return dd($img);
        return $img;
    }

    public function getCategoryLink(): string
    {

        $name = str_replace([' ','/','.'],['-'],trim($this->name));

        return $this->id.'-'.$name;
    }

    public function getTopArticles($limit) {

        $articles = Article::where('category_id','=', $this->id)->limit($limit)->orderby('order','desc')->get();

        return $articles;
    }
}
