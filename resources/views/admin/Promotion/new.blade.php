@extends('admin.adminapp')
@section('content')

    <div class="container-fluid">
        <div class="row well">
            Добавление акции
        </div>
        <div class="row">
            <div class="col-sm-12">
                {!! Form::open(['method'=>'POST','action'=>'Admin\PromotionController@PromotionStore','class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name','Название:',['class'=>'control-label col-sm-1']) !!}
                    <div class="col-sm-4">
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('promotion_type','Тип акции:',['class'=>'control-label col-sm-1']) !!}
                    <div class="col-sm-2">
                        {!! Form::select('promotion_type',$promotion_type,null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('intro','Краткое описание:',['class'=>'control-label col-sm-1']) !!}
                    <div class="col-sm-11">
                        {!! Form::textarea('intro',null,['class'=>'form-control','size' => '10x4']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('order','Приоритет:', ['class'=>'control-label col-sm-1']) !!}
                    <div class="col-sm-1">
                        {!! Form::text('order',0,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Создать',['class'=>'btn btn-info col-sm-offset-3']) !!}
                </div>
            </div>
        </div>
    </div>
@endsection