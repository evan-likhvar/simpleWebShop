@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="row">
            <div class="well text-center ">
                <h2 style="margin: 5px;">Ваш заказ успешно сохранен</h2>
            </div>
            <div class="well text-center" style="border-bottom: 1px solid yellow">
                <h4 style="margin: 5px;">Данные покупателя</h4>
            </div>
            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-6 text-right">
                    Имя покупателя
                </div>
                <div class="col-sm-6 text-left">
                    {{$order->contact_name}}
                </div>
            </div>
            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-6 text-right">
                    Телефон
                </div>
                <div class="col-sm-6 text-left">
                    {{$order->phone}}
                </div>
            </div>
            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-6 text-right">
                    Почта
                </div>
                <div class="col-sm-6 text-left">
                    {{$order->e_mail}}
                </div>
            </div>
{{--            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-6 text-right">
                    Плательщик
                </div>
                <div class="col-sm-6 text-left">
                    {{$order->payer}}
                </div>
            </div>--}}
            <div class="row" style="padding-bottom: 15px;">
                <div class="col-sm-6 text-right">
                    Комментарий
                </div>
                <div class="col-sm-6 text-left">
                    {{$order->description}}
                </div>
            </div>

            <div class="well text-center" style="border-top: 1px solid;border-bottom: 1px solid; padding-top: 40px;">
                <h4 style="margin: 5px;">Заказанные товары</h4>
            </div>
            <div class="well text-center">
                <?php $count = 0; $total = 0; ?>
                @foreach($order->orderRows as $row)
                    <div id="cartRow" class="row" style="padding-bottom: 15px;">
                        <div class="col-sm-6 text-left">
                            {{$row->article_name}}
                        </div>
                        <div id="ArticlePrice" class="col-sm-2">
                            {{$row->priceGRN}} грн
                        </div>
                        <div id="ArticleCount" class="col-sm-2">
                            {{$row->count}} шт
                        </div>
                        <div id="ArticleAmount" class="col-sm-2 text-right">
                            {{$row->count*$row->priceGRN}} грн
                        </div>
                    </div>
                    <?php $count += $row->count; $total+= $row->count*$row->priceGRN; ?>
                @endforeach
                <div class="row  text-center" style="border-top: 1px solid yellow">
                    <b>
                     <div class="col-sm-8 text-left">
                         Итого:
                     </div>
                    <div class="col-sm-2 col-sm-offset-8">
                        {{$count}} шт
                    </div>
                    <div class="col-sm-2 text-right">
                        {{$total}} грн
                    </div>
                    </b>
                </div>
            </div>
        </div>


    </div>
    <script src="/js/site.js">
    </script>
@endsection