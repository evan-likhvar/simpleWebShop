<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Promotion;
use Illuminate\Http\Request;

class PromotionController extends FrontController
{
    public function show($id){
        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();
        $siteParameters = $this->getSiteParameters();
        $homeArticles = $this->getPromotions();

        $promotion = Promotion::findOrFail($id);
        $promotionArticles=$promotionCategories=array();
        if (strlen($promotion->promo_articles)>1){
            $promotionArticles= Article::whereIN('id',explode(",",$promotion->promo_articles))->get();
        }
        if (strlen($promotion->promo_categories)>1){
            $promotionCategories= Category::whereIN('id',explode(",",$promotion->promo_categories))->get();
        }
//return dd($promotionArticles,$promotionCategories);
        return view('layouts.promotion')->with(compact('promotion','homeArticles','siteMenu','cartInfo','siteParameters','promotionArticles','promotionCategories'));
    }
}
