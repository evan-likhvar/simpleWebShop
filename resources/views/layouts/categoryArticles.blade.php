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
{{--
@section('meta')
    <meta name="description" content="Продукция КуперХантер в категории {{$category->name}}"/>
    <meta name="keywords" content="{{$category->name}} Cooper&amp;Hunter КуперХантер"/>
@endsection
--}}

@section('meta')<meta name="description" content="{{strlen($category->metadescription)>10 ? $category->metadescription : strip_tags($category->description)}}" />
<meta name="keywords" content="{{ strlen($category->metakey)>10 ? $category->metakey : $category->name}} {{$category->name}}" />
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

                <h4>Параметры</h4>
                <div class="row text-center">
                    <div class="col-md-6 col-sm-12">
                {!! Form::open(['method'=>'POST','action'=>['CategoryController@eraseParameters']]) !!}
                {{--{!! Form::submit('Очистить  фильтры',['class'=>'btn btn-xs btn-warning']) !!}--}}
                        <input class="btn btn-xs btn-warning" value="Очистить фильтры" type="submit" style=" white-space: normal; width: 100px;">
                {!! Form::hidden('category',$category->id) !!}
                {!! Form::close() !!}
                    </div>
                    <div class="col-md-6 col-sm-12">
                {!! Form::open(['method'=>'POST','action'=>['CategoryController@setParameters']]) !!}
                {{--{!! Form::submit('Применить фильтры',['class'=>'btn btn-xs btn-warning']) !!}--}}
                        <input class="btn btn-xs btn-warning" value="Применить фильтры" type="submit" style=" white-space: normal; width: 100px;">
                        </div>
                </div>


                <div style="min-height: 5px;"></div>

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

                        @if(count($articles)<9)
                            @include('layouts.helpers.articleList', ['articles' => $articles])
                        @else
                            @include('layouts.helpers.articlePlates', ['articles' => $articles])
                        @endif

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