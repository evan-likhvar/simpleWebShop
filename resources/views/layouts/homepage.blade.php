@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                @if(count($announceCategory))
                    @include('layouts.helpers.categoriesList', ['categories' => $announceCategory])
                @endif
                @if(count($homeArticles))
                    {{--<div class="container">--}}
                    <div class="row well">
                        <div class="row  text-center categoryList"><h3>Популярные товары</h3></div>
                        @foreach(array_chunk($homeArticles->all(),4) as $articleRow)
                            <div class="row">
                                @foreach($articleRow as $article)
                                <a href="{{route('showArticle', ['article' => $article->id])}}">
                                    <div class="col-sm-3">
                                        <img class="img-responsive img-thumbnail" src="{{$article->getIntroImg('S','intro1')}}"
                                             alt="">
                                        {{$article->name}}
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                @endif
                {{--</div>--}}
            </div>
            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
        </div>
    </div>
@endsection