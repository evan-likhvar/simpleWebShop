@extends('admin.adminapp')
@section('content')
    <div class="panel-group">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3>Список акций</h3></div>
                </div>
            </div>
        </div>
    </div>

    <div class="well" style="background-color: #fff">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th class="col-sm-1"></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}"
                       .>Индекс</a></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Название</a>
                </th>
                <th>
                    <a href="{{route('admin.article')}}?sort=published&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Опубликована</a>
                </th>
                <th>
                    <a href="{{route('admin.article')}}?sort=order&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Приоритет</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($promotions as $item)
                <tr>
                    <td>
                        <div style="width: 140px;">
                            <div style="width: 40px; float: left;">
                                <a class="btn btn-info btn-xs" role="button"
                                   href="{{route('admin.editPromotion',$item->id)}}">Edit</a>
                            </div>
                            <div style="width: 40px; float: left;">
                                {!! Form::open(['method'=>'DELETE','action'=>['Admin\PromotionController@PromotionDestroy',$item->id]]) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </td>
                    <td>{{$item->id}}</td>
                    <td style="font-size: 90%; padding: 5px 0 5px 0;">{{$item->name}}</td>
                    <td>{{$item->is_published==0 ? 'Нет' : 'Да'}}</td>
                    <td>{{$item->order}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>


        {{ $promotions->appends(Request::input())->links() }}

    </div>


@endsection