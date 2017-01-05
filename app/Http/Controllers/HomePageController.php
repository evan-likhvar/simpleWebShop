<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class HomePageController extends FrontController
{
    public function index()
    {

        $countCartItems = $this->getCountCartItems();

        $mainMenu = Category::whereNull('parent_id')->get();

        $announceCategory = Category::where('onHomePage','=','1')->get();

        $homeArticles = Article::limit(8)->get();

        $cartItemsDescription = $this->getCartItems();

        return view('layouts.homepage')->with(compact('mainMenu','announceCategory','homeArticles','countCartItems','cartItemsDescription'));
    }
}
