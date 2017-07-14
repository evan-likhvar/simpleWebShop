@extends('admin.adminapp')
@section('content')
    <div class="panel-group">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3>Список товаров для акции
                            <span style="color: red;background-color: snow; font-weight: bold;border-radius: 10px; padding: 0 10px">{{$promotion->name}}</span>
                        </h3></div>
                </div>
            </div>
        </div>
    </div>

    <div class="well" style="background-color: #fff">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th class="col-sm-1"></th>
                <th> Индекс</th>
                <th> Товар</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $item)
                <tr>
                    <td>
                        <div style="width: 40px; float: left;">
                            {!! Form::open(['method'=>'DELETE','action'=>['Admin\PromotionController@PromotionArticleDestroy',$promotion->id,$item->id]]) !!}
                            {!! Form::submit('Delete',['class'=>'btn btn-danger btn-xs']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection