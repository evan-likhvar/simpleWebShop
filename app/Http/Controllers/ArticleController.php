<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticleController extends FrontController
{
    //
    public function show($article){

        $countCartItems = $this->getCountCartItems();
        $cartItemsDescription = $this->getCartItems();

        $mainMenu = Category::whereNull('parent_id')->get();
        $article = Article::findOrFail($article);
        $homeArticles = Article::limit(8)->get();
        return view('layouts.article')->with(compact('article','mainMenu','countCartItems','homeArticles','cartItemsDescription'));
    }

    public function addArticleToCart($article){
        Session::push('cartItems[]', $article);
        return redirect()->to('article/'.$article);
    }


}
