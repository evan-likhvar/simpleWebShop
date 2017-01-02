<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends FrontController
{
    public function show($categoryId){

        $cartItems = $this->getCountCartItems();
        $mainMenu = Category::whereNull('parent_id')->get();
        $category = Category::findOrFail($categoryId);
        $homeArticles = Article::limit(8)->get();

        //return dd($category->Parameter_groups);

        if (count($category->Children)){
            return view('layouts.categories')->with(compact('category','mainMenu','cartItems','homeArticles'));
        } else {
            return view('layouts.categoryArticles')->with(compact('category','mainMenu','cartItems','homeArticles'));
        }
    }
}
