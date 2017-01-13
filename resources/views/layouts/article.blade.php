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
                <div class="well text-center" style="border: 1px solid #f09713;">
                    <h2 style="margin: 5px;">{{$article->name}}</h2>
                </div>
                <div id="gal" class="row">
                    @if(count($articleImages)>1)
                        <div class="col-sm-2">


                            @foreach($articleImages as $key=>$item)

                                <img id="{{$key}}" class="img-responsive" style="padding-bottom: 20px;"
                                     src="{{$item['XS']}}" alt="">

                            @endforeach

                        </div>
                    @else
                        <div></div>
                    @endif
                    <div id="prev" class="col-sm-5">

                        @foreach($articleImages as $key=>$item)


                            <a id="{{$key}}" class="fancybox-effects-1" href="{{$item['L']}}">
                                <img class="img-responsive img-thumbnail"
                                     src="{{$item['M']}}" alt=""/></a>

                        @endforeach


                    </div>

                    {{--<a class="fancybox-effects-1" href="{{$article->getIntroImg('L','intro2')}}"><img src="{{$article->getIntroImg('M','intro2')}}" alt="" /></a>--}}

                    <div class="col-sm-5">
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
                        <a class="btn btn-success btn-sm col-sm-4 -col-sm-offset-1" role="button"
                           href="{{route('addArticleToCart', ['article' => $article->id])}}">КУПИТЬ</a>
                    </div>
                </div>
                <div class="row">
                    {{--<h2>{{$article->name}}</h2>--}}
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
                            <li><a data-toggle="tab" href="#text4">Принадлежности</a></li>
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