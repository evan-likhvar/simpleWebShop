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
        return count(Session::get('cartItems[]'));
    }

    protected function getCartItems()
    {

        $cartItems = array();
        if (count(Session::get('cartItems[]'))) {
            foreach (Session::get('cartItems[]') as $item) {
                $cartItems[] = Article::findOrFail($item);
            }
        }
        return $cartItems;
    }

}
