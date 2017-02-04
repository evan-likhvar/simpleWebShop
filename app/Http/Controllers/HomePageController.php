<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\papercategory;
use Illuminate\Http\Request;

class HomePageController extends FrontController
{
    public function index()
    {
        $lastActive = $this->getLastActiveMenu();
        $activeSubId = $this->getSubActiveMenu();

        $topActive = $this->getTopActiveMenu();


        //return dd($topActive,$lastActive);

        $countCartItems = $this->getCountCartItems();

        $mainMenu = Category::whereNull('parent_id')->get();

        $announceCategory = Category::where('onHomePage','=','1')->get();

        $homeArticles = Article::orderby('order','desc')->limit(8)->get();

        $cartItemsDescription = $this->getCartItems();

        $paperMenu = papercategory::whereNull('parent_id')->get();

        return view('layouts.homepage')->with(compact('paperMenu','lastActive','activeSubId','topActive','mainMenu','announceCategory','homeArticles','countCartItems','cartItemsDescription'));
    }
}
