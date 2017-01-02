@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <img class="img-responsive img-thumbnail"
                 src="{{$article->getIntroImg('L')}}" alt="">
        </div>
        <div class="col-sm-8">
            <h2>{{$article->name}}</h2>
            <p>Производитель - <b>{{$article->Vendor->name}}</b></p>
            <p>Цена - <b>{{$article->priceGRN}}</b> грн.</p>
            <p>В наличии - <b>Да</b></p>
            <button type="button" class="btn btn-success">КУПИТЬ</button>
            <a class="btn btn-success col-sm-2 -col-sm-offset-1" role="button" href="{{route('showArticle', ['article' => $article->id])}}?tocart=1">КУПИТЬ</a>
        </div>
    </div>
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

    <div class="tab-content">
        @if($article->description)
        <div id="text1" class="tab-pane fade in active">
            {!!$article->description!!}
        </div>
        @endif
            @if($article->techDescription)
        <div id="text2" class="tab-pane fade">
            @endif
            {!!$article->techDescription!!}
        </div>
            @if($article->additionInfo)
        <div id="text3" class="tab-pane fade">
            {!!$article->additionInfo!!}
        </div>
            @endif
            @if($article->extraInfo)
        <div id="text4" class="tab-pane fade">
            {!!$article->extraInfo!!}
        </div>
            @endif
        {{--{{dd($article)}}--}}
    </div>
</div>
@endsection