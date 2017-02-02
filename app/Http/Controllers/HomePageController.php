<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class HomePageController extends FrontController
{
    public function index()
    {
        $activeSubId = $this->getSubActiveMenu();
        $topActive = $this->getTopActiveMenu();

        $countCartItems = $this->getCountCartItems();

        $mainMenu = Category::whereNull('parent_id')->get();

        $announceCategory = Category::where('onHomePage','=','1')->get();

        $homeArticles = Article::orderby('order','desc')->limit(8)->get();

        $cartItemsDescription = $this->getCartItems();

        return view('layouts.homepage')->with(compact('activeSubId','topActive','mainMenu','announceCategory','homeArticles','countCartItems','cartItemsDescription'));
    }
}
