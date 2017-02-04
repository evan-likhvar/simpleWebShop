@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Редактирование <b>{{ $paper->id }}</b> --
                    <b>{{ $paper->name }}</b></h3></div>
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

            @if(Session::has('infomessage'))
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    {!! session('infomessage') !!}

                </div>
            @endif
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#text1">Основные параметры</a></li>
                <li><a data-toggle="tab" href="#text7">Галерея и файлы товара</a></li>

                <li><a data-toggle="tab" href="#text6">Описание</a></li>

            </ul>

            <div class="tab-content">
                <div id="text7" class="tab-pane fade">

                </div>

                <div id="text1" class="tab-pane fade in active">
                    <div class="row" style="height: 10px;"></div>
                    <div class="row">

                        <div class="col-sm-1 ">


                        </div>
                        <div class="col-sm-3 ">

                        </div>

                        {!! Form::model($paper, ['method'=>'PATCH','action'=>['Admin\PaperController@PaperUpdate',$paper->id],'class'=>'form-horizontal']) !!}
                        <div class="col-sm-8">

                            <div class="form-group">
                                {!! Form::label('name','Название:',['class'=>'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::label('papercategory_id','Категория:',['class'=>'control-label col-sm-3']) !!}
                                <div class="col-sm-8">
                                    {!! Form::select('papercategory_id',$categories,null,['class'=>'form-control']) !!}
                                    {{--{!! Form::select('category_id',$categories,null,['class'=>'form-control','disabled' => 'disabled']) !!}--}}
                                </div>
                                {{--{!! Form::hidden('category_id', $article->category_id) !!}--}}
                            </div>


                            <div class="form-group">
                                {!! Form::label('published','Опубликована:', ['class'=>'control-label col-sm-3']) !!}
                                <div class="col-sm-1">
                                    {!! Form::checkbox('published', null) !!}
                                </div>
                            </div>
                            <div class="form-group">

                                {!! Form::label('created_at','Дата создания:', ['class'=>'control-label col-sm-3']) !!}
                                <div class="col-sm-5">
                                    {!! Form::text('created_at',null,['class'=>'form-control','disabled' => 'disabled']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('metakey','Мета-кей:',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('metakey',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('metadescription','Мета-дескрипшин:',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-9">
                                {!! Form::text('metadescription',null,['class'=>'form-control']) !!}
                            </div>
                        </div>


                    </div>

                </div>

                <div id="text6" class="tab-pane fade">
                    <div class="form-group">
                        {!! Form::label('fullDescription','Описание:',['class'=>'control-label col-sm-1']) !!}
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            {!!
                            Form::textarea('fullDescription',null,['class'=>'form-control','class'=>'maincontent','size'
                            => '5x5']) !!}
                        </div>
                    </div>
                </div>


            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10" style="padding-top: 20px;">
                    {!! Form::hidden('redirects_to', URL::previous()) !!}
                    {!! Form::submit('Сохранить',['class'=>'btn btn-info']) !!}
                </div>
            </div>
            {!! Form::close() !!}

        </div>

    </div>

    <script src="{{URL::to('src/js/vendor/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
            selector: '.maincontent',
            height: 600,
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