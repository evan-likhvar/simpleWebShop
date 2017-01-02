@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Редактирование производителей</h3></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                @if(count($errors)>0)
                    <div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        @foreach($errors->all() as $error)
                            {{$error}}<br>
                        @endforeach
                    </div>
                @endif
                    @if(Session::has('infomessage'))
                        <div class="alert alert-danger">
                            {!! session('infomessage') !!}
                        </div>
                    @endif
                {!! Form::open(['method'=>'POST','action'=>'Admin\VendorController@store','class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name','Название:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Создать',['class'=>'btn btn-info']) !!}
                </div>
{{--                <div class="form-group">
                    {!! Form::label('alias','Путь:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('path',null,['class'=>'form-control']) !!}
                    </div>

                    --}}{{--{!! Form::submit('Создать',['class'=>'btn btn-info']) !!}--}}{{--
                </div>--}}
                {!! Form::close() !!}


            </div>

            <div class="col-sm-6">
                <div class="well">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th> </th>
                            <th>Номер</th>
                            <th>Имя</th>
                            <th>Опубликована</th>
                            <th>Приоритет</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($vendors as $item)
                            <tr>
                                <td style="width: 130px;">
                                    <div style="width: 120px;">

                                        <div style="width: 40px; float: left">
                                            <a class="btn btn-info btn-xs" role="button"
                                               href="{{route('admin.editVendor',$item->id)}}">Edit</a>
                                        </div>
                                        <div style="width: 60px; float: left">
                                            {!! Form::open(['method'=>'DELETE','action'=>['Admin\VendorController@destroy',$item->id]]) !!}
                                            {!! Form::submit('Delete',['class'=>'btn btn-danger btn-xs']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </td>
                                <td><b>{{ $item->id }}</b></td>
                                <td><b>{{ $item->name }}</b></td>
                                <td><b>{{ $item->published }}</b></td>
                                <td><b>{{ $item->order }}</b></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection