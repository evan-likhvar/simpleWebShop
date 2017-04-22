
@foreach(array_chunk($articles->all(),3) as $articlesRow)
    <div class="row article-row">
        @foreach($articlesRow as $article)
            <div class="col-sm-4 text-center article-plate">

                <div>
                    <a href="{{route('showArticle', ['article' => $article->getArticleLink()])}}">
                        <img class="img-responsive"
                             src="{{$article->getIntroImg('M')}}"
                             alt="">
                    </a>
                </div>
                <h4 style="font-size: 90%"><strong><a
                                href="{{route('showArticle', ['article' => $article->getArticleLink()])}}">{{str_replace(['Кондиционер ','Модель: ','Мобильные осушители '],'',$article->name)}}</a></strong>
                </h4>
                <div>
                    <b>{{number_format($article->priceGRN, 0,'', ' ')}}</b> грн<br>
                    {{--<div class="available"><span class="glyphicon glyphicon-ok"></span> в наличии</div>--}}
                    <div style="min-height: 25px">
                    <a style="font-size: 80%;" class="btn btn-success btn-xs col-sm-10 col-sm-offset-1" role="button"
                       href="{{route('addArticleToCart', ['article' => $article->getArticleLink()])}}">КУПИТЬ</a>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach