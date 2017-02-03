@extends('admin.categories.index')
@section('category_content')

    <div class="container-fluid">
        <div class="row well">
            Редактирование категории  {{$category->name}}
        </div>
        <div class="row">
            <div class="col-sm-3 col-sm-offset-1">
                {!! Form::open(['method'=>'POST','action'=>['Admin\CategoryController@storeMedia',$category->id,'intro1'],'class'=>'dropzone']) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-sm-4 ">
                @if(!empty($files['intro1']))
                    <img  class="img-responsive img-thumbnail" src="{!! url($files['intro1']) !!}">
                @endif
            </div>
        </div>
        <div class="row" style="height: 15px;"></div>
        <div class="row">
            {!! Form::model($category, ['method'=>'PATCH','action'=>['Admin\CategoryController@update',$category->id],'class'=>'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name','Название:',['class'=>'control-label col-sm-1']) !!}
                <div class="col-sm-4">
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                {!! Form::label('onHomePage','На главной:',['class'=>'control-label col-sm-1']) !!}
                <div class="col-sm-1">
                    {!! Form::text('onHomePage',null,['class'=>'form-control']) !!}
                </div>
                @if($category->parent)
                    {!! Form::label('parent','Родительская категория:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-3">
                        {!! Form::text('parent',$category->parent->name,['class' => 'form-control', 'readonly' => 'true']) !!}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('metakey','Мета-кей:',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::text('metakey',null,['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('metadescription','Мета-дескрипшин:',['class'=>'control-label col-sm-2']) !!}
                <div class="col-sm-10">
                    {!! Form::text('metadescription',null,['class'=>'form-control']) !!}
                </div>
            </div>



            <div class="form-group">
                <div class="well">
                    <h4>Используемые параметры</h4>
                @foreach($parameterGroups as $key=>$group)
                    {!! Form::label('parameter_groups',$group,['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-1">
                         <?php if (array_search($key,$checkedParameters) === false) $check = false; else $check = true; //$check = false?>

                        {!! Form::checkbox('parameter_groups['.$key.']', null,$check) !!}
                    </div>
                @endforeach
                    <div class="row" style="min-height: 25px;"></div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description','Описание:',['class'=>'control-label col-sm-1']) !!}
            </div>
            <div class="form-group">
                <div class="col-sm-12">

                    {!! Form::textarea('description',null,['class'=>'form-control','id'=>'maincontent','size' => '2x2']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('published','Опубликована:', ['class'=>'control-label col-sm-2 col-sm-offset-1']) !!}
                <div class="col-sm-1">
                    {!! Form::checkbox('published', null) !!}
                </div>

                {!! Form::label('order','Приоритет:', ['class'=>'control-label col-sm-1']) !!}
                <div class="col-sm-1">
                    {!! Form::text('order',null,['class'=>'form-control']) !!}
                </div>
                @if($category->parent)
                    {!! Form::hidden ('parent_id',$category->parent->id,['class'=>'form-control']) !!}
                @endif
            </div>


            <div class="form-group">
                {!! Form::submit('Сохранить',['class'=>'btn btn-info col-sm-offset-3']) !!}
            </div>

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