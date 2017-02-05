@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                @foreach($categoryPapers as $paper)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12 text-left" style="border-bottom: 2px solid">
                                    <h3><a href="{{route('showPaper', ['categoryId' => $paper->id])}}">{{$paper->name}}</a></h3>
                                </div>
                            </div>
                            <div class="row" style="height: 25px;"></div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <a href="{{route('showPaper', ['categoryId' => $paper->id])}}">
                                    <img class="img-responsive"
                                         src="{{$paper->getIntroImg('S','intro1')}}" alt="">
                                    </a>
                                </div>
                                <div class="col-sm-9">
                                    {!! $paper->description !!} <a href="{{route('showPaper', ['categoryId' => $paper->id])}}">
                                      <span style="font-size: 80%;"><i>читать дальше>></i></span>
                                    </a>
                                </div>
                            </div>
                            <div class="row" style="height: 25px;"></div>
                        </div>
                    </div>
                @endforeach
                    @foreach($categoryPapers as $paper)
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12 text-center" style="border-bottom: 1px solid">
                                        <h3><a href="{{route('showPaper', ['categoryId' => $paper->id])}}">{{$paper->name}}</a></h3>
                                    </div>
                                </div>
                                <div class="row" style="height: 25px;"></div>
                                <div class="row">

                                    <div class="col-sm-12">
                                        {!! $paper->fullDescription !!}
                                    </div>
                                </div>
                                <div class="row" style="height: 25px;"></div>
                            </div>
                        </div>
                        @break
                    @endforeach
            </div>


            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
        </div>
    </div>
@endsection