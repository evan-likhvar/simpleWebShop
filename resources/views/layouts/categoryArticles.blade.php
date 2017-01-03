@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="row categoryList text-right"> <h3>{{$category->name}}</h3></div>
            <div id="paramLeft" class="col-sm-3">
                <h4>Параметры</h4>
                @foreach($category->Parameter_groups as $parameter_group)
                    <div class="panel panel-warning">
                        <div class="panel-heading text-center">{{$parameter_group->name}}</div>
                        <div class="panel-body">
                            <ul style="list-style: none">
                                @foreach($parameter_group->Parameters as $parameter)
                                    <li>{{$parameter->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                        {{--<div class="panel-footer"></div>--}}
                    </div>

                @endforeach
            </div>
            <div class="col-sm-9">

                 @if(count($category->Articles))

                    <div id="categoryArticles" class="row well">



                        @foreach($category->Articles as $article)
                            <div class="row">
                                <div class="row"><div class="col-sm-10 col-sm-offset-1"><h4><strong><a href="{{route('showArticle', ['article' => $article->id])}}">{{$article->name}}</a></strong></h4></div></div>

                                <div class="col-sm-3">
                                    <a href="{{route('showArticle', ['article' => $article->id])}}">
                                    <img class="img-responsive"
                                         src="{{$article->getIntroImg('S')}}"
                                         alt="">
                                        </a>
                                </div>
                                <div class="col-sm-7 text-justify" style="font-size: small">
                                    {!! $article->techDescription !!}
                                </div>
                                <div class="col-sm-2 text-center">
                                    <b>{{$article->priceGRN}}</b> - грн<br><br>
                                    <div class="available"> <span class="glyphicon glyphicon-ok"></span> в наличии </div><br><br>

                                    <a class="btn btn-success btn-xs col-sm-6 col-sm-offset-3" role="button" href="{{route('showArticle', ['article' => $article->id])}}?tocart=1">КУПИТЬ</a>

                                </div>
                            </div>
                        @endforeach


                    </div>
                @endif
            </div>
{{--            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>--}}
        </div>
    </div>
@endsection