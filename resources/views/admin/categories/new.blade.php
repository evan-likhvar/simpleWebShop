@extends('admin.categories.index')
@section('category_content')

    <div class="container-fluid">
        <div class="row well">
            Добавление новой категории в категорию {{$parent->name}}
        </div>
        <div class="row">
            {!! Form::open(['method'=>'POST','action'=>'Admin\CategoryController@store','class'=>'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name','Название:',['class'=>'control-label col-sm-1']) !!}
                <div class="col-sm-4">
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>

                {!! Form::label('parent','Родительская категория:',['class'=>'control-label col-sm-3']) !!}
                <div class="col-sm-4">
                    {!! Form::text('parent',$parent->name,['class' => 'form-control', 'readonly' => 'true']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description','Описание:',['class'=>'control-label col-sm-1']) !!}
                <div class="col-sm-11">

                    {!! Form::textarea('description',null,['class'=>'form-control','size' => '10x4']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('published','Опубликована:', ['class'=>'control-label col-sm-2 col-sm-offset-1']) !!}
                <div class="col-sm-1">
                    {!! Form::checkbox('published', null) !!}
                </div>

                {!! Form::label('order','Приоритет:', ['class'=>'control-label col-sm-1']) !!}
                <div class="col-sm-1">
                    {!! Form::text('order',0,['class'=>'form-control']) !!}
                </div>
                {!! Form::hidden ('parent_id',$parent->id,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Создать',['class'=>'btn btn-info col-sm-offset-3']) !!}
            </div>
        </div>
    </div>


@endsection