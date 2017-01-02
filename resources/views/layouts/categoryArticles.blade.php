@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h3>Параметры</h3>
                @foreach($category->Parameter_groups as $parameter_group)
                    <div class="panel panel-default">
                        <div class="panel-heading">{{$parameter_group->name}}</div>
                        <div class="panel-body">
                            <ul>
                                @foreach($parameter_group->Parameters as $parameter)
                                    <li>{{$parameter->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-footer"></div>
                    </div>

                @endforeach
            </div>
            <div class="col-sm-9">

                 @if(count($category->Articles))

                    <div class="row well">
                        <div class="row"><h3>-- товары</h3></div>
                        @foreach(array_chunk($category->Articles->all(),4) as $articleRow)
                            <div class="row">
                                @foreach($articleRow as $article)
                                    <a href="{{route('showArticle', ['article' => $article->id])}}">
                                        <div class="col-sm-3">
                                            <img class="img-responsive img-thumbnail"
                                                 src="{{$article->getIntroImg('S')}}"
                                                 alt="">
                                            {{$article->name}}
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                @endif

            </div>

        </div>
    </div>
@endsection