@if(count($categories))
    {{--<div class="container">--}}
    @foreach($categories as $index=>$category)

        <div class="row well" style="margin-bottom: 0; padding-bottom: 0">
            @if ( $index & 1 )
                <div class="row text-left categoryList"><h3><a
                                href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">{{$category->name}}</a>
                    </h3></div>
            <div class="row">
                <div class="col-sm-7 text-justify categoryBlock">
                    <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                        <img class="img-responsive img-rounded col-sm-3" src="{{$category->getIntroImg('M')}}"
                             alt="">
                    </a>

                    {!!$category->description!!}
                    <div class="col-sm-10 col-sm-offset-2 paddingTop">
                        <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                в категорию <strong>{{$category->name}}</strong></a></h5>
                    </div>
                </div>
                <div class="col-sm-5 text-justify">
                    @include('layouts.helpers.articlePlates2', ['articles' => $category->getTopArticles(3)])
                </div>

            </div>
{{--                <div class="row">
                    <div class="col-sm-10 col-sm-offset-2 paddingTop">
                        <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                в категорию <strong>{{$category->name}}</strong></a></h5>
                    </div>
                </div>--}}
            @else
                <div class="row text-left categoryList"><h3><a
                                href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">{{$category->name}}</a>
                    </h3></div>
                <div class="row">
                    <div class="col-sm-7 text-justify categoryBlock">
                        <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                            <img class="img-responsive img-rounded col-sm-3" src="{{$category->getIntroImg('M')}}"
                                 alt="">
                        </a>

                        {!!$category->description!!}
                        <div class="col-sm-10 col-sm-offset-2 paddingTop">
                            <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                    в категорию <strong>{{$category->name}}</strong></a></h5>
                        </div>
                    </div>
                    <div class="col-sm-5 text-justify">
                        @include('layouts.helpers.articlePlates2', ['articles' => $category->getTopArticles(3)])
                    </div>



                </div>
{{--                <div class="row">
                    <div class="col-sm-10 col-sm-offset-2 paddingTop">
                        <h5><a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">Перейти
                                в категорию <strong>{{$category->name}}</strong></a></h5>
                    </div>
                </div>--}}
            @endif

        </div>

    @endforeach
    {{--</div>--}}
@endif