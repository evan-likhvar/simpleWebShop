@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Редактирование  <b>{{ $papercategory->id }}</b> -- <b>{{ $papercategory->name }}</b></h3></div>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row" style="height: 15px;"></div>
        <div class="row">
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    @foreach($errors->all() as $error)
                        {{$error}}<br>
                    @endforeach
                </div>
            @endif
            {!! Form::model($papercategory, ['method'=>'PATCH','action'=>['Admin\PaperController@PaperCategoryUpdate',$papercategory->id],'class'=>'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name','Название:',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
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
                    {!! Form::label('description','Описание:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">

                        {!! Form::textarea('description',null,['class'=>'form-control','id'=>'maincontent','size' => '2x2']) !!}
                    </div>
                </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Сохранить',['class'=>'btn btn-info']) !!}
            </div></div>
            {!! Form::close() !!}

        </div>

    </div>
    <script src="{{URL::to('src/js/vendor/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '#maincontent',
            height: 200,
            theme: 'modern',
            relative_urls: false,
            remove_script_host: false,
            plugins: [
                'advlist lists link image charmap print preview hr anchor anchorremove pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools rlinks replaceclass'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | code | rlinks replaceclass',
            //toolbar2: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | anchor | rlinks replaceclass',
            //  toolbar2: 'print preview media | forecolor backcolor emoticons',
            image_advtab: true,
            templates: [
                {title: 'Test template 1', content: 'Test 1'},
                {title: 'Test template 2', content: 'Test 2'}
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
        tinymce.init(editor_config);
    </script>

@endsection