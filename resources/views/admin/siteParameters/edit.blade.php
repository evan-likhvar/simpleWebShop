@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Редактирование параметров сайта</h3></div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if(\Illuminate\Support\Facades\Session::has('user_message'))
               <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   {!! session('user_message') !!}
               </div>
            @endif
            {!! Form::model($parameter, ['method'=>'PATCH','action'=>['Admin\SiteParameterController@store'],'class'=>'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('phone1','Телефоны:', ['class'=>'control-label col-sm-2']) !!}
                {!! Form::text('phone1', null) !!}
                {!! Form::text('phone2', null) !!}
                {!! Form::text('phone3', null) !!}
                {!! Form::text('phone4', null) !!}
            </div>

            <div class="form-group">
                {!! Form::label('address','Адрес:', ['class'=>'control-label col-sm-2']) !!}
                {!! Form::text('address', null, ['class'=>'col-sm-6']) !!}
            </div>
                <div class="form-group">
                    {!! Form::label('cord','Координаты на карте:', ['class'=>'control-label col-sm-2']) !!}
                    {!! Form::text('cordX', null, ['class'=>'col-sm-1']) !!}
                    {!! Form::text('cordY', null, ['class'=>'col-sm-1']) !!}
                </div>
            <div class="form-group">
                {!! Form::label('workFlow','Режим работы:', ['class'=>'control-label col-sm-2']) !!}
                {!! Form::text('workFlow', null, ['class'=>'col-sm-6']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('emailName','Имя отправителя:', ['class'=>'control-label col-sm-2']) !!}
                {!! Form::text('emailName', null, ['class'=>'col-sm-6']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('emailTitle','Тема письма:', ['class'=>'control-label col-sm-2']) !!}
                {!! Form::text('emailTitle', null, ['class'=>'col-sm-6']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('emailSender','Адресс отправителя:', ['class'=>'control-label col-sm-2']) !!}
                {!! Form::text('emailSender', null, ['class'=>'col-sm-6']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('emailAdministrator','Адресс администратора:', ['class'=>'control-label col-sm-2']) !!}
                {!! Form::text('emailAdministrator', null, ['class'=>'col-sm-6']) !!}
            </div>
                <div class="form-group">
                    {!! Form::label('promotionEnable','Включить акции:', ['class'=>'control-label col-sm-2']) !!}
                    {!! Form::checkbox('promotionEnable', null) !!}
                </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    {!! Form::submit('Сохранить',['class'=>'btn btn-info']) !!}
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>


@endsection