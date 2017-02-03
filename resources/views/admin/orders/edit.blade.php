@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Заказ <b>{{ $orderHeader->id }}</b> --
                    <b>{{ $orderHeader->nomer }}</b></h3></div>
        </div>
    </div>
    <div class="container-fluid">
        {!! Form::model($orderHeader, ['method'=>'PATCH','action'=>['Admin\OrderController@update',$orderHeader->id],'class'=>'form-horizontal']) !!}
        <div class="row">
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
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! session('infomessage') !!}

                </div>
            @endif

            <div class="col-sm-12">
                <div class="row well">


                    <div class="form-group">
                        {!! Form::label('nomer','Внутренний номер:',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('nomer',null,['class'=>'form-control']) !!}
                        </div>
                        {!! Form::label('created_at','Дата создания:', ['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('created_at',null,['class'=>'form-control col-sm-2','disabled' => 'disabled']) !!}
                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::label('contact_name','Контактное лицо:',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('contact_name',null,['class'=>'form-control']) !!}
                        </div>
                        {!! Form::label('payer','Плательщик:',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('payer',null,['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('phone','Телефон:',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('phone',null,['class'=>'form-control']) !!}
                        </div>
                        {!! Form::label('e_mail','Почта:',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('e_mail',null ,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('status','Статус заказа:',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-2">
                            {!! Form::select('status',$orderStatus,null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description','Примечания:',['class'=>'control-label col-sm-2']) !!}
                        <div class="col-sm-10">
                            {!! Form::textarea('description',null,['class'=>'form-control','size' => '2x2']) !!}
                            {{--{!! Form::text('description',null,['class'=>'form-control']) !!}--}}
                        </div>
                    </div>

                </div>
            </div>
            {{--header end--}}
            <div class="col-sm-12">
                <div class="row ">
                    <table class="table table-hover table-bordered table-condensed">

                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>№ артикула</th>
                            <th>Название</th>
                            <th>Кол-во</th>
                            <th>Цена шт.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($orderHeader->orderRows as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->article_id}}</td>
                                <td>{{$item->article_name}}</td>
                                <td>{{$item->count}}</td>
                                <td>{{$item->priceGRN}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::hidden('redirects_to', URL::previous()) !!}
                {!! Form::submit('Сохранить',['class'=>'btn btn-info']) !!}
            </div>
        </div>
        {!! Form::close() !!}

    </div>



@endsection