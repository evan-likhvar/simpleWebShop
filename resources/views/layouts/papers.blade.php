@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-{{isset($siteParameters['promotionEnable']) ? 10 : 12}}">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row text-center" style="border-bottom: 2px solid; padding-top: 20px;">
                                <h3>{{$paper->name}}</h3>
                            </div>
                            <div class="row" style="height: 35px;"></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! $paper->fullDescription !!}
                                </div>
                            </div>

                        </div>
                    </div>
              

            </div>
            @if(isset($siteParameters['promotionEnable']))
            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
                @endif
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.helpers.footer')
@endsection