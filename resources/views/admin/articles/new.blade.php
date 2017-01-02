@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Новый артикул</h3></div>
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

            <div class="row">
                {!! Form::open(['method'=>'POST','action'=>'Admin\ArticleController@store','files'=>true,'class'=>'form-horizontal']) !!}
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('name','Название:',['class'=>'control-label col-sm-4']) !!}
                        <div class="col-sm-8">
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('category_id','Категория:',['class'=>'control-label col-sm-4']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('category_id',[''=>'Choose Category']+$categories,null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('vendor_id','Производитель:',['class'=>'control-label col-sm-4']) !!}
                        <div class="col-sm-8">
                            {!! Form::select('vendor_id',[''=>'Choose vendor']+$vendors,null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1">
                    {!! Form::submit('Сохранить и перейти к редактированию параметров',['class'=>'btn btn-info']) !!}
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>

@endsection