@extends('admin.adminapp')
@section('content')

    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Редактирование артикула <b>{{ $article->id }}</b> --
                    <b>{{ $article->name }}</b></h3></div>
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
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#text1">Основные параметры</a></li>
                    <li><a data-toggle="tab" href="#text2">Описание</a></li>
                    <li><a data-toggle="tab" href="#text3">Технические данные</a></li>
                    <li><a data-toggle="tab" href="#text4">Дополнительная информация</a></li>
                    <li><a data-toggle="tab" href="#text5">info</a></li>
                </ul>

                <div class="tab-content">
                    <div id="text1" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-sm-2 ">
                                {!! Form::open(['method'=>'POST','action'=>['Admin\ArticleController@storeMedia',$article->id,'intro1'],'class'=>'dropzone']) !!}
                                {!! Form::close() !!}
                            </div>
                            <div class="col-sm-3 ">
                                @if(!empty($files['intro1']['0']))
                                    <img  class="img-responsive img-thumbnail" src="{!! url($files['intro1']['0']) !!}">
                                @endif
                            </div>

                            {!! Form::model($article, ['method'=>'PATCH','action'=>['Admin\ArticleController@update',$article->id],'class'=>'form-horizontal']) !!}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    {!! Form::label('name','Название:',['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('category_id','Категория:',['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('category_id',[''=>'Choose Category']+$categories,null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('vendor_id','Производитель:',['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('vendor_id',$vendors,null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('priceYE','Цена у.е.:',['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('priceYE',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('priceGRN','Цена грн:',['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('priceGRN',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('published','Опубликована:', ['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-1">
                                        {!! Form::checkbox('published', null) !!}
                                    </div>

                                    {!! Form::label('order','Приоритет:', ['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-1">
                                        {!! Form::text('order',null,['class'=>'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">

                                    {!! Form::label('created_at','Дата создания:', ['class'=>'control-label col-sm-3']) !!}
                                    <div class="col-sm-5">
                                        {!! Form::text('created_at',null,['class'=>'form-control','disabled' => 'disabled']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row well">
                                <h4>Параметры</h4>
                                @foreach($parameterGroups as $group)
                                    <div class="col-sm-3">
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                {{$group->name}}
                                            </div>
                                            <div class="panel-body">
                                                @foreach($group->Parameters as $parameter)
                                                    <?php if (array_search($parameter->id,$checkedParameters) === false) $check = false; else $check = true; //$check = false?>
                                                    {!! Form::checkbox('parameter['.$parameter->id.']', null,$check) !!} -- {{$parameter->name}}<br>
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="row" style="min-height: 25px;"></div>
                            </div>
                        </div>
                    </div>
                    <div id="text2" class="tab-pane fade">
                        <div class="form-group">
                            {!! Form::label('description','Описание:',['class'=>'control-label col-sm-1']) !!}
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::textarea('description',null,['class'=>'form-control','class'=>'maincontent','size' => '5x5']) !!}
                            </div>
                        </div>
                    </div>
                    <div id="text3" class="tab-pane fade">
                        <div class="form-group">
                            {!! Form::label('techDescription','Технические данные:',['class'=>'control-label col-sm-1']) !!}
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::textarea('techDescription',null,['class'=>'form-control','class'=>'maincontent','size' => '5x5']) !!}
                            </div>
                        </div>
                    </div>
                    <div id="text4" class="tab-pane fade">
                        <div class="form-group">
                            {!! Form::label('additionInfo','Дополнительная информация:',['class'=>'control-label col-sm-1']) !!}
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::textarea('additionInfo',null,['class'=>'form-control','class'=>'maincontent','size' => '5x5']) !!}
                            </div>
                        </div>
                    </div>
                    <div id="text5" class="tab-pane fade">
                        <div class="form-group">
                            {!! Form::label('extraInfo','info:',['class'=>'control-label col-sm-1']) !!}
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                {!! Form::textarea('extraInfo',null,['class'=>'form-control','class'=>'maincontent','size' => '5x5']) !!}
                            </div>
                        </div>
                    </div>
                </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
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