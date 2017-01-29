<div id="submenu" class="container">

        @foreach($mainMenu as $item)
            @if($topActive == $item->id && count($item->children))
            <div class="row category{{$item->id}}">

            @foreach($item->children as $child)

                    <div class="col-xs-3 {{$activeSubId == $child->id ? 'sub_active' : '' }}">
                <a href="{{route('showCategory', ['categoryId' => $child->id])}}">{{$child->name}}</a>
                    </div>
            @endforeach

            @endif
            </div>
        @endforeach

</div>



