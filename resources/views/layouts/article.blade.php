@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="well-sm text-left">
                <div class="row" style="padding-left: 50px;">
                    <a href="/"> Главная </a> <b>></b>
                    <a href="{{route('showCategory', ['category' => $article->Category->parent->id])}}">{{ $article->Category->parent->name }}</a>
                    <b>></b>
                    <a href="{{route('showCategory', ['category' => $article->Category->id])}}">{{ $article->Category->name }}</a>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="well" style="border: 1px solid #f09713;">
                    <h2 style="margin: 5px;">{{$article->name}}</h2>
                </div>
                <div id="gal" class="row">
                    <div class="col-sm-2">
                        <img id="intro1" class="img-responsive" style="padding-bottom: 20px;"
                             src="{{$article->getIntroImg('XS','intro1')}}" alt="">
                        <img id="intro2" class="img-responsive" style="padding-bottom: 20px;"
                             src="{{$article->getIntroImg('XS','intro2')}}" alt="">
                        <img id="intro3" class="img-responsive" style="padding-bottom: 20px;"
                             src="{{$article->getIntroImg('XS','intro3')}}" alt="">
                        <img id="intro4" class="img-responsive" style="padding-bottom: 20px;"
                             src="{{$article->getIntroImg('XS','intro4')}}" alt="">

                        {{--<div id="text">123</div>--}}

                    </div>
                    <div id="prev" class="col-sm-4">
                        <a id="intro1" class="fancybox-effects-1" href="{{$article->getIntroImg('L','intro1')}}">
                            <img class="img-responsive img-thumbnail"
                                    src="{{$article->getIntroImg('M','intro1')}}" alt=""/></a>
                        <a id="intro2" class="fancybox-effects-1 " href="{{$article->getIntroImg('L','intro2')}}">
                            <img class="img-responsive img-thumbnail"
                                    src="{{$article->getIntroImg('M','intro2')}}" alt=""/></a>
                        <a id="intro3" class="fancybox-effects-1" href="{{$article->getIntroImg('L','intro3')}}">
                            <img class="img-responsive img-thumbnail"
                                    src="{{$article->getIntroImg('M','intro3')}}" alt=""/></a>
                        <a id="intro4" class="fancybox-effects-1" href="{{$article->getIntroImg('L','intro4')}}">
                            <img class="img-responsive img-thumbnail"
                                    src="{{$article->getIntroImg('M','intro4')}}" alt=""/></a>


                        {{--                        <img id="intro1" class="img-responsive img-thumbnail"
                             src="{{$article->getIntroImg('L','intro1')}}" alt="">
                        <img id="intro2" class="img-responsive img-thumbnail"
                             src="{{$article->getIntroImg('L','intro2')}}" alt="">
                        <img id="intro3" class="img-responsive img-thumbnail"
                             src="{{$article->getIntroImg('L','intro3')}}" alt="">
                        <img id="intro4" class="img-responsive img-thumbnail"
                             src="{{$article->getIntroImg('L','intro4')}}" alt="">--}}
                    </div>

                    {{--<a class="fancybox-effects-1" href="{{$article->getIntroImg('L','intro2')}}"><img src="{{$article->getIntroImg('M','intro2')}}" alt="" /></a>--}}

                    <div class="col-sm-6">
                        <h6><b>код товара {{$article->nomer}}</b></h6>

                        <p>Производитель - <b>{{$article->Vendor->name}}</b></p>

                        <div class="available">
                            @if($article->avaliable)
                                <span class="glyphicon glyphicon-ok"></span> в наличии
                            @else
                                <small>наличие уточняйте</small>
                            @endif
                        </div>
                        <br>
                        <p>Цена - <b>{{$article->priceGRN}}</b> грн.</p>
                        <a class="btn btn-success btn-sm col-sm-2 -col-sm-offset-1" role="button"
                           href="{{route('addArticleToCart', ['article' => $article->id])}}">КУПИТЬ</a>
                    </div>
                </div>
                <div class="row">
                    <h2>{{$article->name}}</h2>
                    <ul class="nav nav-tabs">
                        @if($article->fullDescription)
                            <li class="active"><a data-toggle="tab" href="#text1">Описание</a></li>
                        @endif
                        @if($article->techDescription)
                            <li><a data-toggle="tab" href="#text2">Технические данные</a></li>
                        @endif
                        @if($article->additionInfo)
                            <li><a data-toggle="tab" href="#text3">Дополнительная информация</a></li>
                        @endif
                        @if($article->extraInfo)
                            <li><a data-toggle="tab" href="#text4">info</a></li>
                        @endif
                    </ul>

                    <div id="articleDesc" class="tab-content">
                        @if($article->fullDescription)
                            <div id="text1" class="tab-pane fade in active">
                                <div class="well">
                                    {!!$article->description!!}
                                </div>
                            </div>
                        @endif
                        @if($article->techDescription)
                            <div id="text2" class="tab-pane fade">
                                <div class="well">
                                    {!!$article->techDescription!!}
                                </div>
                            </div>
                        @endif
                        @if($article->additionInfo)
                            <div id="text3" class="tab-pane fade">
                                <div class="well">
                                    {!!$article->additionInfo!!}
                                </div>
                            </div>
                        @endif
                        @if($article->extraInfo)
                            <div id="text4" class="tab-pane fade">
                                <div class="well">
                                    {!!$article->extraInfo!!}
                                </div>
                            </div>
                        @endif
                        {{--{{dd($article)}}--}}
                    </div>
                </div>
            </div>


            <div class="col-sm-2  well">

                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])

            </div>
        </div>
    </div>
    <script src="/js/site.js">
    </script>
@endsection