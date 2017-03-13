@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row text-center" style="border-bottom: 2px solid">
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
            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.helpers.footer')
@endsection