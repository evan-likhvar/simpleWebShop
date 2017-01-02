@if(count($categories))
    {{--<div class="container">--}}
    @foreach($categories as $index=>$category)
        <div class="row well">
            @if ( $index & 1 )
                <div class="row"><h3><a href="{{route('showCategory', ['categoryId' => $category->id])}}">{{$category->name}}</a></h3></div>
                <div class="col-sm-4">
                    <img class="img-responsive img-thumbnail" src="{{$category->getIntroImg('M')}}"
                         alt="">
                </div>
                <div class="col-sm-8">
                    <div class="row">
                        {!!$category->description!!}
                    </div>
                    <div class="row">
                        @foreach($category->Articles as $aindex=>$article)
                            @if($aindex>3) @break @endif
                            <a href="{{route('showArticle', ['article' => $article->id])}}">
                                <div class="col-sm-3">
                                    <img class="img-responsive img-thumbnail"
                                         src="{{$article->getIntroImg('S')}}" alt="">
                                    {{$article->name}}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="row"><h3><a href="{{route('showCategory', ['categoryId' => $category->id])}}">{{$category->name}}</a></h3></div>
                <div class="col-sm-8">
                    <div class="row">
                        {!!$category->description!!}
                    </div>
                    <div class="row">
                        @foreach($category->Articles as $aindex=>$article)
                            @if($aindex>3) @break @endif
                            <a href="{{route('showArticle', ['article' => $article->id])}}">
                                <div class="col-sm-3">
                                    <img class="img-responsive img-thumbnail"
                                         src="{{$article->getIntroImg('S')}}" alt="">
                                    {{$article->name}}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-4">
                    <img class="img-responsive img-thumbnail" src="{{$category->getIntroImg('M')}}"
                         alt="">
                </div>
            @endif

        </div>

    @endforeach
    {{--</div>--}}
@endif