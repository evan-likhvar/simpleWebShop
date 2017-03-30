@if(count($categories))
    {{--<div class="container">--}}
    @foreach($categories as $index=>$category)

        <div class="row well" style="margin-bottom: 0; padding-bottom: 0">
            @if ( $index & 1 )
                <div class="row text-left categoryList"><h3><a
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

            @else
                <div class="row text-left categoryList"><h3><a
                                href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()])}}">{{$category->name}}</a>
                    </h3></div>
                <div class="row">
                    <div class="col-sm-9 text-justify">
                        <a href="{{route('showCategory', ['categoryId' => $category->getCategoryLink()]) }}">
                            <img class="img-responsive col-sm-3" src="{{$category->getIntroImg('M')}}"
                                 alt="">
                        </a>

                        {!!$category->description!!}
                    </div>
                    <div class="col-sm-3 text-justify">
                        @include('layouts.helpers.articlePlates2', ['articles' => $category->getTopArticles(2)])
                    </div>
                </div>
            @endif

        </div>

    @endforeach
    {{--</div>--}}
@endif