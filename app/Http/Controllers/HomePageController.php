<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class HomePageController extends FrontController
{
    public function index()
    {

        $cartItems = $this->getCountCartItems();

        $mainMenu = Category::whereNull('parent_id')->get();

        $announceCategory = Category::where('onHomePage','=','1')->get();

        $homeArticles = Article::limit(8)->get();

        //return dd($homeArticle);
        return view('layouts.homepage')->with(compact('mainMenu','announceCategory','homeArticles','cartItems'));
    }
}
