@foreach(array_chunk($articles->all(),4) as $articlesRow)
    <div class="row article-row">
        @foreach($articlesRow as $article)
            <div class="col-sm-3 text-center article-plate">

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
                    <b>{{$article->priceGRN}}</b> - грн<br>
                    <div class="available"><span class="glyphicon glyphicon-ok"></span> в наличии</div>
                    <div style="min-height: 25px">
                    <a class="btn btn-success btn-xs col-sm-6 col-sm-offset-3" role="button"
                       href="{{route('addArticleToCart', ['article' => $article->getArticleLink()])}}">КУПИТЬ</a>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach