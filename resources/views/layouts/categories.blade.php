@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                @if(count($category->Children))
                    @include('layouts.helpers.categoriesList', ['categories' => $category->Children])
                @endif
{{--                @if(count($homeArticles))
                    --}}{{--<div class="container">--}}{{--
                    <div class="row well">
                        <div class="row"><h3>Популярные товары</h3></div>
                        @foreach(array_chunk($homeArticles->all(),4) as $articleRow)
                            <div class="row">
                                @foreach($articleRow as $article)
                                <a href="{{route('showArticle', ['article' => $article->id])}}">
                                    <div class="col-sm-3">
                                        <img class="img-responsive img-thumbnail" src="{{$article->getIntroImg('S')}}"
                                             alt="">
                                        {{$article->name}}
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                @endif--}}
                {{--</div>--}}
            </div>
            <div class="col-sm-2 well">
                <div class="row "><h3>Акции</h3></div>
                @foreach($homeArticles as $article)
                    <a href="{{route('showArticle', ['article' => $article->id])}}">
                        <div class="col-sm-12">
                            <img class="img-responsive img-thumbnail" src="{{$article->getIntroImg('XS')}}" alt="">
                            {{$article->name}}
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection