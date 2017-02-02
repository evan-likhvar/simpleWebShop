<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class FrontController extends Controller
{

    public function __construct()
    {

            $this->middleware('auth');
    }


    protected function getCountCartItems()
    {
        if (Session::has('cartItems')) {
            return array_sum(Session::get('cartItems'));}
        return 0;
    }

    protected function getCartItems()
    {

        $cartItems = array();
        if (count(Session::get('cartItems'))) {
            foreach (Session::get('cartItems') as $article=>$count) {
                $cartItems[] = [$count,Article::findOrFail($article)];
            }
        }

        //return dd($cartItems);

        return $cartItems;
    }

    protected function getTopActiveMenu()
    {

        $activeTopId = 0;

        $url = rawurldecode(Request::capture()->path());
        list($type,$id) = explode('/',$url);
        if (strlen(trim($type))>0) {
            if (mb_strpos($id,'-'))
                $id = mb_substr($id,0,mb_strpos($id,'-'));

            if ($type == 'артикул') {
                $article = Article::findorfail($id);
                $id = $article->category_id;
            }

            $category = Category::findorfail($id);

            if ($category->parent_id > 0)
                $activeTopId = $category->parent_id;
            else
                $activeTopId = $category->id;

            //return dd($url,$type,$id,$category,$activeTopId);
        }
        return $activeTopId;
    }

    protected function getSubActiveMenu()
    {

        $activeSubId = 0;

        $url = rawurldecode(Request::capture()->path());
        list($type,$id) = explode('/',$url);
        if (strlen(trim($type))>0) {
            if (mb_strpos($id,'-'))
                $id = mb_substr($id,0,mb_strpos($id,'-'));

            if ($type == 'артикул') {
                $article = Article::findorfail($id);
                $activeSubId = $article->category_id;
            }
            if ($type == 'категория') {
                $activeSubId = $id;
            }

        }
        return $activeSubId;
    }
    protected function getLastActiveMenu()
    {

        $activeTopId = 0;

        $url = rawurldecode(URL::previous()).'//////';



        list($proto,$epmty,$site,$type,$id) = explode('/',$url);

        if (strlen(trim($type))>0) {
            if (mb_strpos($id,'-'))
                $id = mb_substr($id,0,mb_strpos($id,'-'));

            if ($type == 'артикул') {
                $article = Article::findorfail($id);
                $id = $article->category_id;
            }

            $category = Category::find($id);

            if ($category) {
                if ($category->parent_id > 0)
                    $activeTopId = $category->parent_id;
                else
                    $activeTopId = $category->id;
            }
            //return dd($url,$type,$id,$category,$activeTopId);
        }
        return $activeTopId;
    }
}
