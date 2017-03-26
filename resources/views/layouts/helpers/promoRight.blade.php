<div class="row text-center "><h3>Акции</h3></div>
@foreach($Articles as $article)
    <a href="{{route('showPromotion', ['article' => $article->getArticleLink()])}}">
        <div class="col-sm-12 promoRight text-center">
            <img class="img-responsive " src="{{$article->getIntroImg('S','intro1')}}" alt="">
            {{$article->name}}
        </div>
    </a>
@endforeach