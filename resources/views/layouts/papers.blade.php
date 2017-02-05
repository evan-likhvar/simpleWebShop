@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">

                    <div class="row">
                        <div class="col-sm-12">
                            <h3><a href="{{route('showPaper', ['categoryId' => $paper->id])}}">{{$paper->name}}</a></h3>
                            {!! $paper->fullDescription !!}
                        </div>
                    </div>
              

            </div>
            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
        </div>
    </div>
@endsection