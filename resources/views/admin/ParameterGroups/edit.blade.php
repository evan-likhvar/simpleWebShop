@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Редактирование группы параметров <b>{{ $parameter_group->id }}</b> -- <b>{{ $parameter_group->name }}</b></h3></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach($errors->all() as $error)
                        {{$error}}<br>
                    @endforeach
                </div>
            @endif
            {!! Form::model($parameter_group, ['method'=>'PATCH','action'=>['Admin\ParameterCategoryController@update',$parameter_group->id],'class'=>'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name','Название:',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
            </div>
{{--            <div class="form-group">
                {!! Form::label('path','Путь в линке:',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::text('path',null,['class'=>'form-control']) !!}
                </div>
            </div>--}}
            <div class="form-group">
                {!! Form::label('description','Описание:',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">

                    {!! Form::textarea('description',null,['class'=>'form-control','size' => '10x2']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('published','Опубликована:', ['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-1">
                    {!! Form::checkbox('published', null) !!}
                </div>

                {!! Form::label('order','Приоритет:', ['class'=>'control-label col-sm-1']) !!}
                <div class="col-sm-1">
                    {!! Form::text('order',null,['class'=>'form-control']) !!}
                </div>

                {!! Form::label('created_at','Дата создания:', ['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-4">
                    {!! Form::text('created_at',null,['class'=>'form-control','disabled' => 'disabled']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Сохранить',['class'=>'btn btn-info']) !!}
            </div></div>
            {!! Form::close() !!}

        </div>
    </div>


@endsection