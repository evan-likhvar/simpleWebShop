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
            <b>{{number_format($article->priceGRN, 0,'', ' ')}}</b> грн<br><br>
            <div class="available">
                @if($article->avaliable)
                    <span style="color: #5cb85c" class="glyphicon glyphicon-ok"></span> <span style="color: #5cb85c">в наличии</span>
                @else
                    <span>наличие уточняйте</span>
                @endif
            </div>
            <br><br>

            <a class="btn btn-success btn-xs col-sm-6 col-sm-offset-3" role="button"
               href="{{route('addArticleToCart', ['article' => $article->getArticleLink()])}}">КУПИТЬ</a>

        </div>
    </div>
@endforeach