<div id="submenu" class="container">

    @foreach($mainMenu as $item)
        @if($topActive == $item->id && count($item->children))
            <div class="row category{{$item->id}}">
                @foreach($item->children as $child)
                    @if($child->published == 1)
                        @if($activeSubId == $child->id)

                            <div id="shadowBox"
                                 class="col-xs-3 sub_active  {{$topActive==$lastActive ? ' animated ' : ' animated zoomIn'}}">
                                <div class="row itemSubMenu">
                                    <div class="col-sm-12 text-center">
                                        {{$child->name}}
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{route('showCategory', ['categoryId' => $child->getCategoryLink()])}}">
                                <div id="shadowBox"
                                     class="col-xs-3 shadow {{$topActive==$lastActive ? ' animated ' : ' animated zoomIn'}}">
                                    <div class="row itemSubMenu">
                                        <div class="col-sm-3">
                                            <img class="img-responsive" src="{{$child->getIntroImg('S')}}"
                                                 alt="">
                                        </div>
                                        <div class="col-sm-9">
                                            {{$child->name}}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endif
                @endforeach
            </div>
        @endif

    @endforeach

</div>



