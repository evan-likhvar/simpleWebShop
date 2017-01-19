@extends('layouts.app')
@section('content')
    <div class="container">
        {!! Form::open(['method'=>'POST', 'action'=>['OrderController@store'],'class'=>'form-horizontal']) !!}
        <div class="row">
            <div class="well text-center" style="border: 1px solid #f09713;">
                <h2 style="margin: 5px;">Ваша корзина</h2>

            @foreach($cartItemsDescription as $article)

                {{--{{dd($article[1])}}--}}

                <div id="cartRow" class="row">
                    {{--{!! Form::hidden('redirects_to', URL::previous()) !!}--}}
                    {!! Form::hidden('art['.$article[1]->id.']', $article[0]) !!}
                    <div id="articleId" style="display: none">{{$article[1]->id}}</div>
                    <div class="col-sm-2">
                        <img class="img-responsive" src="{{$article[1]->getIntroImg('XS')}}" alt="">
                    </div>
                    <div class="col-sm-4">
                        {{$article[1]->name}}
                    </div>
                    <div id="ArticlePrice" class="col-sm-1">
                        {{$article[1]->priceGRN}}
                    </div>
                    <div id="ArticleCount" class="col-sm-2">
                        {{--<input class="form-control" min="1" step="1" name="count" type="number" value="{{$article[0]}}">--}}
                        {{$article[0]}}
                    </div>
                    <div id="ArticleAmount" class="col-sm-2 text-right">
                        {{$article[0]*$article[1]->priceGRN}}
                    </div>
                    {{--<div id="Remove" class="col-sm-1"><span class="glyphicon glyphicon-remove"></span></div>--}}
                </div>
            @endforeach
            </div>
        </div>
        <div class=" well">
            <div class="row">
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
        {!! Form::submit('Сохранить',['class'=>'btn btn-info']) !!}
        {!! Form::close() !!}
    </div>
    <script src="/js/site.js">
    </script>
@endsection