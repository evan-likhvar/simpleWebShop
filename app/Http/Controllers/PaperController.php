<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\paper;
use App\papercategory;

class PaperController extends FrontController
{
    //
    public function indexPaperCategory ($paperCategory) {

        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();
        $siteParameters = $this->getSiteParameters();
        $homeArticles = $this->getPromotions();

        $categoryPapers = paper::where('papercategory_id',$paperCategory)->get();

        return view('layouts.categoryPapers')->with(compact('siteMenu','homeArticles','cartInfo','categoryPapers','siteParameters'));
    }

    public function showPaper ($paperId) {

        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();
        $siteParameters = $this->getSiteParameters();
        $homeArticles = $this->getPromotions();

        $paper = paper::findorfail($paperId);

        return view('layouts.papers')->with(compact('paper','homeArticles','siteMenu','cartInfo','siteParameters'));

    }
}
