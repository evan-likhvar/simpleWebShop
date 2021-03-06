@if(!isset($perRow)) <?php $perRow = 4; ?> @endif
@foreach(array_chunk($articles->all(),$perRow) as $articlesRow)
    <div class="row article-row">
        @foreach($articlesRow as $article)
            <div class="col-sm-{{$perRow == 4 ? 3 : 4}} text-center article-plate">

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
                    <div class="available">
                        @if($article->avaliable)
                            <span style="color: #5cb85c" class="glyphicon glyphicon-ok"></span> <span style="color: #5cb85c">в наличии</span>
                        @else
                            <span>наличие уточняйте</span>
                        @endif
                    </div>
                    <div style="min-height: 25px">
                    <a class="btn btn-success btn-xs col-sm-6 col-sm-offset-3" role="button"
                       href="{{route('addArticleToCart', ['article' => $article->getArticleLink()])}}">КУПИТЬ</a>
                        </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach