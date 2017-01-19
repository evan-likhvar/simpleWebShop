<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\orderHeader;
use App\orderRow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrderController extends FrontController
{
    //
    public function show(){

        $mainMenu = Category::whereNull('parent_id')->get();
        $cartItemsDescription = $this->getCartItems();

        return view('layouts.order')->with(compact('cartItemsDescription','mainMenu'));
    }
    public function store(Request $request){


        $input = $request->All();

        $inputRows = $input['art'];
        unset($input['art']);

        //return dd($inpurRows);

        $newHeader = orderHeader::create($input);

        foreach ($inputRows as $articleId=>$count) {
            $article = Article::findOrFail($articleId);
            $newRow = new orderRow();
            $newRow->order_header_id = $newHeader->id;
            $newRow->article_id = $article->id;
            $newRow->article_name = $article->name;
            $newRow->count = $count;
            $newRow->priceGRN = $article->priceGRN;
            $newRow->save();
            unset($article);
            unset($newRow);
        }

        Session::forget('cartItems');

        return redirect()->route('showSuccessOrder', ['id' => $newHeader->id]);
    }


    public function showSuccess($id){

        $mainMenu = Category::whereNull('parent_id')->get();
        $order = orderHeader::findOrFail($id);

        return view('layouts.orderSuccess')->with(compact('order','mainMenu'));
    }

}
