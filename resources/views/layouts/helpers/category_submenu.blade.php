<div id="submenu" class="container">

        @foreach($mainMenu as $item)
            @if($topActive == $item->id && count($item->children))
            <div class="row category{{$item->id}}">

            @foreach($item->children as $child)
                    <a href="{{route('showCategory', ['categoryId' => $child->id])}}">
                    <div id="shadowBox" class="col-xs-3 {{$activeSubId == $child->id ? 'sub_active' : '' }}" >
                        <div class="row itemSubMenu" style="min-height: 65px">
                            <div class="col-sm-3">
                                <img class="img-responsive" src="{{$child->getIntroImg('S')}}"
                                     alt="">
                            </div>
                            <div class="col-sm-9">
                                {{--<a href="{{route('showCategory', ['categoryId' => $child->id])}}">{{$child->name}}</a>--}}
                                {{$child->name}}
                            </div>

                        </div>
                    </div>
                </a>
            @endforeach
            </div>
            @endif

        @endforeach

</div>



