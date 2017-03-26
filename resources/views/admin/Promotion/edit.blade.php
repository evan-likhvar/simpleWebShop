@extends('admin.adminapp')
@section('content')

    <div class="container-fluid">
        <div class="row well">
            Добавление акции
        </div>
        @if(\Illuminate\Support\Facades\Session::has('infomessage'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {!! session('infomessage') !!}
            </div>
        @endif
        <div class="row">
            <div class="col-sm-9">

                {!! Form::model($promotion, ['method'=>'PATCH','action'=>['Admin\PromotionController@PromotionUpdate',$promotion->id],'class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name','Название акции:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('intro','Краткое описание:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::textarea('intro',null,['class'=>'form-control','size' => '10x4']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('promo_articles','Акционные артикула:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('promo_articles',null,['class'=>'form-control','size' => '10x4']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('promo_categories','Акционные категории:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('promo_categories',null,['class'=>'form-control','size' => '10x4']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('is_published','Опубликована:', ['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-1">
                        {!! Form::checkbox('is_published', null) !!}
                    </div>

                    {!! Form::label('order','Приоритет:', ['class'=>'control-label col-sm-1']) !!}
                    <div class="col-sm-1">
                        {!! Form::text('order',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('description','Описание:',['class'=>'control-label col-sm-1 text-left']) !!}
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        {!! Form::textarea('description',null,['class'=>'form-control','class'=>'maincontent','size'
                        => '5x5']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::submit('Сохранить',['class'=>'btn btn-info col-sm-offset-3']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-3">
                @if(!empty($files['intro1']))
                    <img  class="img-responsive img-thumbnail" src="{!! url($files['intro1']) !!}">
                @endif
                {!! Form::open(['method'=>'POST','action'=>['Admin\PromotionController@storeMedia',$promotion->id,'intro1'],'class'=>'dropzone']) !!}
                {!! Form::close() !!}
            </div>
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
                'emoticons template paste textcolor colorpicker textpattern imagetools rlinks replaceclass responsivefilemanager'
            ],
            toolbar1: 'insertfile undo redo | responsivefilemanager | styleselect | bold italic | alignleft aligncenter alignright alignjustify | code | rlinks replaceclass',
            //toolbar2: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | anchor | rlinks replaceclass',
            //toolbar3: '| responsivefilemanager | print preview media | forecolor backcolor emoticons',
            image_advtab: true,
            external_filemanager_path:"/src/js/filemanager/",
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "/src/js/filemanager/plugin.min.js"},
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