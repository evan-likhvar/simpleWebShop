@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
<div class="well-sm text-left">

    <a href="{{route('showCategory', ['category' => $article->Category->parent->id])}}">{{ $article->Category->parent->name }}</a>
    /
    <a href="{{route('showCategory', ['category' => $article->Category->id])}}">{{ $article->Category->name }}</a>
</div>
            <div class="col-sm-10">
                <div class="well">
                <h2>{{$article->name}}</h2>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <img class="img-responsive" style="padding-bottom: 20px;"
                             src="{{$article->getIntroImg('XS','intro2')}}" alt="">
                        <img class="img-responsive " style="padding-bottom: 20px;"
                             src="{{$article->getIntroImg('XS','intro3')}}" alt="">
                        <img class="img-responsive " style="padding-bottom: 20px;"
                             src="{{$article->getIntroImg('XS','intro4')}}" alt="">
                    </div>
                    <div class="col-sm-4">
                        <img class="img-responsive img-thumbnail"
                             src="{{$article->getIntroImg('L','intro1')}}" alt="">
                    </div>
                    <div class="col-sm-6">
                        <h6>код товара {{$article->nomer}}</h6>

                        <p>Производитель - <b>{{$article->Vendor->name}}</b></p>

                        <div class="available">
                            @if($article->avaliable)
                                <span class="glyphicon glyphicon-ok"></span> в наличии
                            @else
                                наличие уточняйте
                            @endif
                        </div><br>
                        <p>Цена - <b>{{$article->priceGRN}}</b> грн.</p>
                        <a class="btn btn-success btn-sm col-sm-2 -col-sm-offset-1" role="button"
                           href="{{route('addArticleToCart', ['article' => $article->id])}}">КУПИТЬ</a>
                    </div>
                </div>
                <div class="row">
                    <h2>{{$article->name}}</h2>
                    <ul class="nav nav-tabs">
                        @if($article->description)
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
                        @if($article->description)
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
@endsection