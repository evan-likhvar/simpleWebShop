@if(count($categories))
    {{--<div class="container">--}}
    @foreach($categories as $index=>$category)
        <div class="row well">
            @if ( $index & 1 )
                <div class="row text-right categoryList"><h3><a href="{{route('showCategory', ['categoryId' => $category->id])}}">{{$category->name}}</a></h3></div>
                <div class="col-sm-8">
                    <div class="row text-justify">
                        {!!$category->description!!}
                    </div>
                    <div class="text-right promo"><h4>Популярное в категории</h4></div>
                    <div class="row">
                        @foreach($category->Articles as $aindex=>$article)
                            @if($aindex>2) @break @endif
                        <div class="col-sm-4">
                            <a href="{{route('showArticle', ['article' => $article->id])}}">
                                <div class="col-sm-12">
                                    <img class="img-responsive"
                                         src="{{$article->getIntroImg('S','intro1')}}" alt="">
                                    {{$article->name}}<br><br>
                                    Цена - <b>{{$article->priceGRN}}</b>
                                </div>
                            </a>
                         </div>
                        @endforeach
                    </div>
                    <div class="row paddingTop">
                        @foreach($category->Articles as $aindex=>$article)
                            @if($aindex>2) @break @endif
                            <div class="col-sm-4">
                                <a class="btn btn-success btn-xs col-sm-6 col-sm-offset-3" role="button" href="{{route('addArticleToCart', ['article' => $article->id])}}">КУПИТЬ</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-2 paddingTop">
                            <h5><a href="{{route('showCategory', ['categoryId' => $category->id])}}">Перейти в категорию <strong>{{$category->name}}</strong></a></h5>
                        </div>
                    </div>                </div>
                <div class="col-sm-4">
                    <img class="img-responsive" src="{{$category->getIntroImg('M')}}"
                         alt="">
                </div>


            @else
                <div class="row text-left categoryList"><h3><a href="{{route('showCategory', ['categoryId' => $category->id])}}">{{$category->name}}</a></h3></div>
                <div class="col-sm-4">
                    <img class="img-responsive" src="{{$category->getIntroImg('M')}}"
                         alt="">
                </div>
                <div class="col-sm-8">
                    <div class="row text-justify">
                        {!!$category->description!!}
                    </div>
                    <div class="text-right promo"><h4>Популярное в категории</h4></div>
                    <div class="row">
                        @foreach($category->Articles as $aindex=>$article)
                            @if($aindex>2) @break @endif

                            <a href="{{route('showArticle', ['article' => $article->id])}}">
                                <div class="col-sm-4">
                                    <img class="img-responsive"
                                         src="{{$article->getIntroImg('S','intro1')}}" alt="">
                                    {{$article->name}}<br><br>
                                    Цена - <b>{{$article->priceGRN}}</b>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="row paddingTop">
                        @foreach($category->Articles as $aindex=>$article)
                            @if($aindex>2) @break @endif
                            <div class="col-sm-4">
                                <a class="btn btn-success btn-xs col-sm-6 col-sm-offset-3" role="button" href="{{route('addArticleToCart', ['article' => $article->id])}}">КУПИТЬ</a>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-2 paddingTop">
                            <h5><a href="{{route('showCategory', ['categoryId' => $category->id])}}">Перейти в категорию <strong>{{$category->name}}</strong></a></h5>
                        </div>
                    </div>

                </div>
            @endif

        </div>

    @endforeach
    {{--</div>--}}
@endif