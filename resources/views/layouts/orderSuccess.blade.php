@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            <div class="well text-center" style="border: 1px solid #f09713;">
                <h2 style="margin: 5px;">Ваш заказ успешно сохранен</h2>

            @foreach($order->orderRows as $row)

                {{--{{dd($article[1])}}--}}

                <div id="cartRow" class="row">

                    <div class="col-sm-4">
                        {{$row->article_name}}
                    </div>
                    <div id="ArticlePrice" class="col-sm-1">
                        {{$row->priceGRN}}
                    </div>
                    <div id="ArticleCount" class="col-sm-2">
                        {{$row->count}}
                    </div>
                    <div id="ArticleAmount" class="col-sm-2 text-right">
                        {{$row->count*$row->priceGRN}}
                    </div>

                </div>
            @endforeach
            </div>
        </div>
        <div class=" well">
            <div class="row">
                <div class="col-sm-4">
                    {{$order->contact_name}}
                </div>
                <div id="ArticlePrice" class="col-sm-1">
                    {{$order->phone}}
                </div>
                <div id="ArticleCount" class="col-sm-2">
                    {{$order->e_mail}}
                </div>
                <div id="ArticleAmount" class="col-sm-2 text-right">
                    {{$order->payer}}
                </div>
            </div>
        </div>

    </div>
    <script src="/js/site.js">
    </script>
@endsection