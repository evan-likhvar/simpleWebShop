@extends('layouts.app')
@section('content')
    <div class="container">
        {!! Form::open(['method'=>'POST', 'action'=>['OrderController@store'],'class'=>'form-horizontal']) !!}
        <div class="row">
            <div class="well text-center categoryList">
                <h2 style="margin: 5px;">Ваша корзина</h2>
            </div>
            <div class="well text-center orderBox">


                <?php $totalAmount = 0; ?>
                @foreach($cartItemsDescription as $article)

                    {{--{{dd($article[1])}}--}}

                    <div id="cartRow" class="row " style="padding: 20px 0 ; border-bottom: 1px solid #cccccc">
                        {{--{!! Form::hidden('redirects_to', URL::previous()) !!}--}}
                        {!! Form::hidden('art['.$article[1]->id.']', $article[0]) !!}
                        <div id="articleId" style="display: none">{{$article[1]->id}}</div>
                        <div class="col-sm-3">
                            <img class="img-responsive" src="{{$article[1]->getIntroImg('XS')}}" alt="">
                        </div>
                        <div class="col-sm-3 ">
                            {{$article[1]->name}}
                        </div>
                        <div id="ArticlePrice" class="col-sm-1">
                            {{$article[1]->priceGRN}}
                        </div>
                        <div id="ArticleCount" class="col-sm-2">
                            {{--<input class="form-control" min="1" step="1" name="count" type="number" value="{{$article[0]}}">--}}
                            {{$article[0]}}&nbsp&nbsp&nbspшт.
                        </div>
                        <div id="ArticleAmount" class="col-sm-2 text-right">
                            {{$article[0]*$article[1]->priceGRN}}&nbsp&nbsp&nbspгрн.
                        </div>
                        <?php $totalAmount += $article[0]*$article[1]->priceGRN; ?>
                    </div>
                @endforeach
                <div class="row" style="padding-top: 25px;">
                    <b>
                        <div class="col-sm-2 col-sm-offset-4">
                            Итого
                        </div>
                        <div class="col-sm-2 col-sm-offset-1">
                            {{$count}}&nbsp&nbsp&nbspшт.
                        </div>
                        <div class="col-sm-2 text-right">
                            {{$totalAmount}}&nbsp&nbsp&nbspгрн.
                        </div>

                    </b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class=" well orderBox">

                <div class="form-group">
                    {!! Form::label('contact_name','Ваше имя:', ['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('contact_name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('phone','Телефон:', ['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('phone',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('e_mail','E-mail:', ['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('e_mail',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('payer','Название плательщика:', ['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('payer',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2 col-sm-offset-5">
                {!! Form::submit('Заказать',['class'=>'btn btn-info']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <script src="/js/site.js">
    </script>
@endsection