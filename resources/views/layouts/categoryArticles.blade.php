@extends('layouts.app')
@section('json-ld')
    <script type="application/ld+json">
[    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name": "Купер&Хантер Украина",
      "alternateName": "Cooper&Hunter Украина",
      "description": "Магазин климатической техники производства Cooper&Hunter",
      "url": "http://www.куперхантер.укр"
    },
    {
    "@context": "http://schema.org",
    "@type":"WebPage",
    "headline": "{{$category->name}}",
    "description": "{{strlen($category->description)>4 ? strip_tags($category->description) : $category->name }}"
    }
]

    </script>
@endsection
@section('title')<title>Продукция Cooper&amp;Hunter в категории {{$category->name}}</title>
@endsection
@section('meta')
    <meta name="description" content="Продукция КуперХантер в категории {{$category->name}}"/>
    <meta name="keywords" content="{{$category->name}} Cooper&amp;Hunter КуперХантер"/>
@endsection
@section('content')
    <div class="container">
{{--

        <div>

            @if($checkedParameters)
                @foreach($checkedParameters as $key=>$value)
                    {{$key}} - {{$value}}<br>
                @endforeach
            @endif
        </div>
--}}
        <div class="row">

            <div class="row categoryList text-right"><h3>{{$category->name}}</h3></div>

            <div id="paramLeft" class="col-sm-3">

                {{--<button id="test" type="button" class="btn btn-default">test</button>--}}

                {!! Form::open(['method'=>'POST','action'=>['CategoryController@setParameters']]) !!}
                {!! Form::submit('Применить',['class'=>'btn btn-warning']) !!}


                <h4>Параметры</h4>
                @foreach($category->Parameter_groups as $parameter_group)
                    <div class="panel panel-warning">
                        <div class="panel-heading text-center">{{$parameter_group->name}}</div>
                        <div class="panel-body">
                            {{--<ul style="list-style: none">--}}
                            @foreach($parameter_group->Parameters as $parameter)
                                {{--<li>{{$parameter->name}}</li>--}}

                                <div class="form-group">
                                    {!! Form::label($parameter->id,$parameter->name, ['class'=>'control-label col-sm-10']) !!}
                                    <div class="col-sm-1">
                                        {{--{{dd($checkedParameters)}}--}}
                                        @if($unCheckAll)
                                            <?php
                                            if (!empty($checkedParameters) && array_key_exists($parameter->id, $checkedParameters) === false) $check = false; else $check = true;
                                            ?>
                                        @else
                                            {{$check = false}}
                                        @endif
                                        {!! Form::checkbox($parameter->id, $parameter->id, $check) !!}
                                    </div>

                                </div>

                            @endforeach
                            {{--</ul>--}}
                        </div>
                    </div>

                @endforeach

                {!! Form::hidden('category',$category->id) !!}
                {!! Form::close() !!}


            </div>
            <div class="col-sm-9">

                @if(count($category->Articles))


                    <div id="categoryArticles" class="row well">


                        <div id="filterAndSortet" class="row">
                            <div class="col-sm-7 text-right">
                                <div id="paging">
                                    {{ $articles->appends(Request::input())->links() }}
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="row" style="padding-top: 30px;padding-bottom: 25px;">
                                    <div class="col-sm-6 text-right" style="padding-top: 5px;">
                                        сортировать
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="dropdown">
                                            <button class="btn btn-warning btn-sm dropdown-toggle" type="button"
                                                    data-toggle="dropdown">{{$orderBy}}
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{route('setArticlesOrder', ['order' => 'asc'])}}">по
                                                        возрастанию цены</a></li>
                                                <li><a href="{{route('setArticlesOrder', ['order' => 'desc'])}}">по
                                                        убыванию цены</a></li>
                                                <li><a href="{{route('setArticlesOrder', ['order' => 'popular'])}}">по
                                                        популярности</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @foreach($articles as $article)
                            <div class="row">
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1"><h4><strong><a
                                                        href="{{route('showArticle', ['article' => $article->getArticleLink()])}}">{{$article->name}}</a></strong>
                                        </h4></div>
                                </div>

                                <div class="col-sm-3">
                                    <a href="{{route('showArticle', ['article' => $article->getArticleLink()])}}">
                                        <img class="img-responsive"
                                             src="{{$article->getIntroImg('S')}}"
                                             alt="">
                                    </a>
                                </div>
                                <div class="col-sm-7 text-justify" style="font-size: small">
                                    {!! $article->description !!}
                                </div>
                                <div class="col-sm-2 text-center">
                                    <b>{{$article->priceGRN}}</b> - грн<br><br>
                                    <div class="available"><span class="glyphicon glyphicon-ok"></span> в наличии</div>
                                    <br><br>

                                    <a class="btn btn-success btn-xs col-sm-6 col-sm-offset-3" role="button"
                                       href="{{route('addArticleToCart', ['article' => $article->getArticleLink()])}}">КУПИТЬ</a>

                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="row">
                        <div class="col-sm-7 text-right">
                            <div id="paging">
                                {{ $articles->appends(Request::input())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{--            <div class="col-sm-2 well">
                            @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
                        </div>--}}
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.helpers.footer')
@endsection