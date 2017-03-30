@if(count($categories))
    {{--<div class="container">--}}
    @foreach($categories as $index=>$category)

        <div class="row well" style="margin-bottom: 0; padding-bottom: 0">
            @if ( $index & 1 )
                <div class="row text-right categoryList"><h3><a
                                href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">{{$category->name}}</a>
                    </h3></div>
            <div class="row">
                <div class="col-sm-2">
                    <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                        <img class="img-responsive" src="{{$category->getIntroImg('M')}}"
                             alt="">
                    </a>
                </div>
                <div class="col-sm-7 text-justify">
                    {!!$category->description!!}
                </div>
                <div class="col-sm-3 text-justify">
                    @include('layouts.helpers.articlePlates2', ['articles' => $category->getTopArticles(2)])
                </div>
            </div>
{{--                <div class="col-sm-8">


                    <div class="row text-justify">
                        {!!$category->description!!}
                    </div>
                    <div class="text-right promo"><h4>Популярное в категории</h4></div>


                    @include('layouts.helpers.articlePlates', ['articles' => $category->getTopArticles(4)])

                    <div class="row">
                        <div class="col-sm-10 col-sm-offset-2 paddingTop">
                            <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                    в категорию <strong>{{$category->name}}</strong></a></h5>
                        </div>
                    </div>


                </div>--}}
{{--                <div class="col-sm-4">
                    <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                        <img class="img-responsive" src="{{$category->getIntroImg('M')}}"
                             alt="">
                    </a>
                </div>--}}


            @else
                <div class="row text-left categoryList"><h3><a
                                href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">{{$category->name}}</a>
                    </h3></div>
                <div class="col-sm-2">
                    <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                        <img class="img-responsive" src="{{$category->getIntroImg('M')}}"
                             alt="">
                    </a>
                </div>
                <div class="col-sm-10">
                    <div class="row text-justify">
                        {!!$category->description!!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-right promo"><h4>Популярное в категории</h4></div>
                        @include('layouts.helpers.articlePlates6', ['articles' => $category->getTopArticles(6)])


                        <div class="row">
                            <div class="col-sm-10 col-sm-offset-2 ">
                                <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                        в категорию <strong>{{$category->name}}</strong></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    @endforeach
    {{--</div>--}}
@endif