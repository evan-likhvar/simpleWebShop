@if(count($categories))
    {{--<div class="container">--}}
    @foreach($categories as $index=>$category)

        <div class="row well">
            @if ( $index & 1 )
                <div class="row text-right categoryList"><h3><a
                                href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">{{$category->name}}</a>
                    </h3></div>
                <div class="col-sm-8">
                    <div class="row text-justify">
                        {!!$category->description!!}
                    </div>
                    <div class="text-right promo"><h4>Популярное в категории</h4></div>



                    @include('layouts.helpers.articlePlates', ['articles' => $category->getTopArticles(3), 'perRow' => 3])

                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-2 paddingTop">
                            <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                    в категорию <strong>{{$category->name}}</strong></a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                        <img class="img-responsive" src="{{$category->getIntroImg('M')}}"
                             alt="">
                    </a>
                </div>


            @else
                <div class="row text-left categoryList"><h3><a
                                href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">{{$category->name}}</a>
                    </h3></div>
                <div class="col-sm-4">
                    <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                        <img class="img-responsive" src="{{$category->getIntroImg('M')}}"
                             alt="">
                    </a>
                </div>
                <div class="col-sm-8">
                    <div class="row text-justify">
                        {!!$category->description!!}
                    </div>
                    <div class="text-right promo"><h4>Популярное в категории</h4></div>
                    @include('layouts.helpers.articlePlates', ['articles' => $category->getTopArticles(3), 'perRow' => 3])


                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-2 paddingTop">
                            <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                    в категорию <strong>{{$category->name}}</strong></a></h5>
                        </div>
                    </div>

                </div>
            @endif

        </div>

    @endforeach
    {{--</div>--}}
@endif