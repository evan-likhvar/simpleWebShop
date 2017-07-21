{{--{{dd($articleImages)}}--}}
@extends('layouts.app')
@section('json-ld')
    <script type="application/ld+json">
{
  "@context": "http://schema.org/",
  "@type": "Product",
  "name": "{{$article->name}}",
  "image": "{{url($articleImages['intro1']['L'])}}",
  "description": "{{strip_tags($article->description)}}",
  "brand": {
    "@type": "Thing",
    "name": "Cooper&Hunter"
  }
}

    </script>
@endsection
@section('title')<title>{{$article->name}}</title>
@endsection
@section('meta')
    <meta name="description"
          content="{{strlen($article->metadescription)>10 ? $article->metadescription : strip_tags($article->description)}}"/>
    <meta name="keywords"
          content="{{ strlen($article->metakey)>10 ? $article->metakey : $article->Category->name}} {{$article->name}}"/>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="well-sm text-left">
                <div class="row" style="min-height: 20px;"></div>
                <div class="row" style="padding-left: 20px;">
                    <a href="/"> Главная </a> <b>></b>
                    @if(count($article->Category->parent))
                        <a href="{{route('showCategory', ['category' => $article->Category->parent->getCategoryLink()])}}">{{ $article->Category->parent->name }}</a>
                        <b>></b>
                    @endif

                    <a href="{{route('showCategory', ['category' => $article->Category->getCategoryLink()])}}">{{ $article->Category->name }}</a>
                </div>
            </div>
            <div class="col-sm-{{isset($siteParameters['promotionEnable']) ? 10 : 12}}">
                @if (Session::has('ItemAdded'))
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {!! session('ItemAdded') !!}
                    </div>
                @endif
                <div class="well text-center article-h2">
                    <h2 style="margin: 5px;">{{$article->name}}</h2>
                </div>


                    {{--articles promotion--}}
                    <div class="row promo-for-article {{$article->getCountActivePromotions()>0 ? 'promo-wrap animated flipInX':'no-promo-wrap'}}">
                        @if($article->getCountActivePromotions()>0)

                            <div class="col-sm-2 hidden-xs animatedLong infinite rubberBand ">
                                <img class="img-responsive" src="/css/res/promo-sticker2.jpg">
                            </div>

                            <div class="col-sm-10 col-xs-12">
                                <?php $count=3;?>
                                @foreach($article->Promotions as $promotion)

                                    @if($promotion->is_published == 1)


                                    <?php $count == 4 ? $count=1 : $count++; ?>
                                    <div class="promo-text-container text-center animatedLong infinite jello{{$count}}">
                                        &nbsp; &nbsp; <a
                                                href="{{route('showPromotion', ['promotion' => $promotion->id])}}">
                                            {!! $promotion->intro!!}&nbsp; &nbsp; </a>
                                    </div>
@endif

                                    @endforeach
                            </div>
                        @endif

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

                        <div class="row">
                            <div class="col-sm-4">Модель</div>
                            <div class="col-sm-8">{{str_replace(['Кондиционер ','Модель: ','Мобильные осушители '],'',$article->name)}}</div>
                        </div>
                        <div class="row" style="min-height: 20px;"></div>
                        @if(!empty($article->nomer))
                            <div class="row">
                                <div class="col-sm-4">Код товара</div>
                                <div class="col-sm-8" style="font-size: 120%"><b>{{$article->nomer}}</b></div>
                            </div>

                        @endif
                        <hr>
                        <div class="row">
                            <div class="col-sm-8 col-sm-offset-4">
                                <div class="available">
                                    @if($article->avaliable)
                                        <span style="color: #5cb85c" class="glyphicon glyphicon-ok"></span> <span
                                                style="color: #5cb85c">в наличии</span>
                                    @else
                                        <span>наличие уточняйте</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row" style="min-height: 20px;"></div>

                        <div class="row">
                            <div class="col-sm-4" style="font-size: 150%">Цена</div>
                            <div class="col-sm-8" style="font-size: 150%">
                                <b>{{number_format($article->priceGRN, 0,'', ' ')}}</b> грн
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="min-height: 20px;"></div>

                        {{--
                                                <a class="btn btn-success btn-sm col-sm-4 -col-sm-offset-1" role="button"
                                                   href="{{route('addArticleToCart', ['article' => $article->id])}}">КУПИТЬ</a>


                                                <div class="row">
                                                    <input type="number" id="replyNumber" min="1" step="1" data-bind="value:replyNumber" />
                                                </div>
                        --}}
                        <div class="row">
                            {!! Form::open(['method'=>'POST','action'=>['ArticleController@addArticleToCart',$article->getArticleLink()],'class'=>'form-horizontal']) !!}

                            <div class="col-sm-3">
                                {!! Form::number('count',1,['class'=>'form-control','min'=>"1", 'step'=>"1"]) !!}
                            </div>
                            <div class="col-sm-8 col-sm-offset-1">
                                {!! Form::submit('КУПИТЬ',['class'=>'btn btn-success col-sm-7']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <hr>

                    </div>
                </div>
                <div class="row" style="min-height: 20px;"></div>


                <div id="infotab" class="row">
                    <ul class="nav nav-tabs left">
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
                                    {!!$article->fullDescription!!}
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

            @if(isset($siteParameters['promotionEnable']))
                <div class="col-sm-2  well">
                    @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
                </div>
            @endif
        </div>
    </div>
    <script src="/js/site.js">
    </script>
@endsection
@section('footer')
    @include('layouts.helpers.footer')
@endsection