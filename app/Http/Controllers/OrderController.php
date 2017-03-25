<?php

namespace App\Http\Controllers;


use App\Article;
use App\Category;
use App\Events\OrderCreated;
use App\Http\Requests\OrderControllerRequest;
use App\orderHeader;
use App\orderRow;
use App\papercategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;

class OrderController extends FrontController
{
    //
    public function show(){

        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();
        $siteParameters = $this->getSiteParameters();
        return view('layouts.order')->with(compact('siteMenu','cartInfo','siteParameters'));
    }



    public function store(OrderControllerRequest $request){

/*        $this->validate($request, [

            'contact_name'=>'required|alpha'
        ]);*/

        $input = $request->All();

        $inputRows = $input['art'];
        unset($input['art']);

        if ( strlen((trim($input['e_mail'])))==0 )
            $input['e_mail'] = 'elikhvarshops@gmail.com';


        //return dd($input);

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

        Event::fire(new OrderCreated($newHeader));

        return redirect()->route('showSuccessOrder', ['id' => $newHeader->id]);
    }


    public function showSuccess($id){

        $siteMenu = $this->getSiteMenu();
        $cartInfo = $this->getCartInfo();
        $siteParameters = $this->getSiteParameters();
        $order = orderHeader::findOrFail($id);

        return view('layouts.orderSuccess')->with(compact('order','siteMenu','cartInfo','siteParameters'));
    }

}
