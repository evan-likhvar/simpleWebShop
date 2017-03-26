@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="row text-center" style="border-bottom: 2px solid; padding-top: 20px;">
                            <h3>{{$promotion->name}}</h3>
                        </div>
                        <div class="row" style="height: 35px;"></div>
                        <div class="row">
                            <div class="col-sm-12 text-justify">
                                {!! $promotion->description !!}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        @if(count($promotionCategories))
                            @include('layouts.helpers.categoriesList', ['categories' => $promotionCategories])
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">

                        @if(count($promotionArticles))
                            <div class="row text-center" style="border-bottom: 2px solid; padding-top: 20px;">
                                <h3>Акционные товары</h3>
                            </div>
                            @include('layouts.helpers.articlePlates', ['articles' => $promotionArticles])
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.helpers.footer')
@endsection