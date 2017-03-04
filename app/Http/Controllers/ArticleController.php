<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\papercategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ArticleController extends FrontController
{
    //
    public function show($article){

        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();

        $homeArticles = Article::limit(4)->get();

        $article = Article::findOrFail($article);

        $articleImages = array();

        if ($article->getIntroImg('XS','intro1')!='noImage') {
            $articleImages['intro1']['XS'] = $article->getIntroImg('XS', 'intro1');
            $articleImages['intro1']['M'] = $article->getIntroImg('M', 'intro1');
            $articleImages['intro1']['L'] = $article->getIntroImg('L', 'intro1');
        }
        if ($article->getIntroImg('XS','intro2')!='noImage') {
            $articleImages['intro2']['XS'] = $article->getIntroImg('XS', 'intro2');
            $articleImages['intro2']['M'] = $article->getIntroImg('M', 'intro2');
            $articleImages['intro2']['L'] = $article->getIntroImg('L', 'intro2');
        }
        if ($article->getIntroImg('XS','intro3')!='noImage') {
            $articleImages['intro3']['XS'] = $article->getIntroImg('XS', 'intro3');
            $articleImages['intro3']['M'] = $article->getIntroImg('M', 'intro3');
            $articleImages['intro3']['L'] = $article->getIntroImg('L', 'intro3');
        }
        if ($article->getIntroImg('XS','intro4')!='noImage') {
            $articleImages['intro4']['XS'] = $article->getIntroImg('XS', 'intro4');
            $articleImages['intro4']['M'] = $article->getIntroImg('M', 'intro4');
            $articleImages['intro4']['L'] = $article->getIntroImg('L', 'intro4');
        }

       // return dd($articleImages);
        return view('layouts.article')->with(compact('article','articleImages','homeArticles','siteMenu','cartInfo'));
    }

    public function addArticleToCart($article){

        $request = Request::capture();

        $cartArticle = Article::find($article);
        if (!$cartArticle)
            return 'invalid article!!!';

        $itemCount = 1;
        if (isset($request['count']))
            $itemCount = $request['count'];

        $id = mb_substr($article,0,mb_strpos($article,'-'));
        $cartItem[$id] = $itemCount;

        if (Session::has('cartItems')) {
            $cartArticles = Session::get('cartItems');

            if (!isset($cartArticles[$id])) {
                $cartArticles[$id] = $cartItem[$id];
            }
            else {
                $cartArticles[$id]=$cartArticles[$id]+$itemCount;
            }
            Session::put('cartItems', $cartArticles);
        }
        else {
            Session::put('cartItems', $cartItem);
        }

        $message = 'В корзину добавлен товар '.$cartArticle->name.' - '.$itemCount.' шт.';

        Session::flash('ItemAdded',$message);

        return redirect()->to('артикул/'.$article);
    }

    public function SetArticleCountToCart(){

        if (!Session::has('cartItems'))
            die('{"success":"0", "error":"1", "notification":"корзина пуста"}');

        $request = Request::capture();

        if(!isset($request['id']) || !isset($request['count']))
            die(dd($request->all()));



        //    die('{"id":"0", "error":"1", "notification":"в обработчик не переданы необходимые данные"}');


        if (!is_numeric($request['count']))
            die('{"success":"0", "error":"1", "notification":"неправильное количество"}');
        if(!Article::find($request['id']))
            die('{"success":"0", "error":"1", "notification":"неизвестный артикул"}');

        $cartArticles = Session::get('cartItems');

        if (!isset($cartArticles[$request['id']]))
            die('{"success":"0", "error":"1", "notification":"в корзине нет такого артикула"}');

        if ($request['count']>0)
            $cartArticles[$request['id']]=$request['count'];
        else
            unset($cartArticles[$request['id']]);

        Session::put('cartItems', $cartArticles);

        //return dd($request->all());
    }



}
