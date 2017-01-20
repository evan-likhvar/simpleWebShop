<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

}
