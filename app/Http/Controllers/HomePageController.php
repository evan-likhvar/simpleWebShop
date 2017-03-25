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

        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();
        $siteParameters = $this->getSiteParameters();
        $homeArticles = Article::orderby('order','desc')->limit(8)->get();

        $announceCategory = Category::where('onHomePage','=','1')->get();

        return view('layouts.homepage')->with(compact('announceCategory','homeArticles','siteMenu','cartInfo','siteParameters'));
    }
}
