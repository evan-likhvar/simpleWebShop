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
        $homeArticles = $this->getPromotions();

        $announceCategory = Category::where('onHomePage','=','1')->where('published','=','1')->get();

        return view('layouts.homepage')->with(compact('announceCategory','homeArticles','siteMenu','cartInfo','siteParameters'));
    }
}
