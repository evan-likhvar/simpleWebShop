<?php
Form::macro('MakeNavigation', function($data) {

    foreach ($data as $key => $value) {
        if($value->submenu) {

            echo '<div class="panel panel-info">';
                echo '<div class="panel-heading">';
                    echo '<div class="row">';
                        echo '<div class="col-sm-4">';
            echo '<a class="btn btn-info btn-xs col-sm-3 col-sm-offset-1" role="button" href="'.route('admin.editCategory',$value->id).'">edit</a>';
            echo '<a class="btn btn-info btn-xs col-sm-3 col-sm-offset-1" role="button" href="'.route('admin.addCategory',$value->id).'">add</a>';
                        echo '</div>';
                        echo '<div class="col-sm-8">';
                        echo '<a data-toggle="collapse" href="#collapse_'.$value->id.'">'.$value->name.'</a>';
                        echo '</div>';
                        //echo $value->name;
                    echo '</div>';
                echo '</div>';
                echo '<div id="collapse_'.$value->id.'" class="panel-collapse collapse">';
                    echo '<div class="panel-body">';
                        Form::MakeNavigation($value->submenu);
                    echo '</div>';
                    echo '<div class="panel-footer">';

                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        else {
//return dd($value);
                echo '<div class="row">';
                    echo '<div class="col-sm-6">';
                        echo '<a class="btn btn-info btn-xs col-sm-2 col-sm-offset-1" role="button" href="'.route('admin.editCategory',$value->id).'">edit</a>';
                        echo '<a class="btn btn-info btn-xs col-sm-2 col-sm-offset-1" role="button" href="'.route('admin.addCategory',$value->id).'">add</a>';
                        echo '<a class="btn btn-info btn-xs col-sm-2 col-sm-offset-1" role="button" href="'.route('admin.delCategory',$value->id).'">del</a>';
                    echo '</div>';
                    echo '<div class="col-sm-6">';
                        echo $value->name;
                    echo '</div>';
                echo '</div>';

        }

    }});

Form::macro('MakeCategoryTable', function($data) {

    foreach ($data as $key => $value) {
        if($value->submenu) {
            echo '<tr>';
                echo '<td style="padding-left: 1px;padding-right: 1px;">';
                    echo '<a class="btn btn-info btn-xs col-sm-3" role="button" href="'.route('admin.editCategory',$value->id).'">edit</a>';
                    echo '<a style ="margin-left: 3.333%;" class="btn btn-warning btn-xs col-sm-3" role="button" href="'.route('admin.addCategory',$value->id).'">add</a>';
                echo '</td>';
                echo '<td>';
                    for($i=0;$i<($value->level-2)*3;$i++) {echo '&nbsp;';}
                    echo $value->name;
                echo '</td>';
            echo '</tr>';
            Form::MakeCategoryTable($value->submenu);
        }
        else {
            echo '<tr>';
            echo '<td style="padding-left: 1px;padding-right: 1px;">';
            echo '<a class="btn btn-info btn-xs col-sm-3" role="button" href="'.route('admin.editCategory',$value->id).'">edit</a>';
            echo '<a style ="margin-left: 3.333%;" class="btn btn-warning btn-xs col-sm-3" role="button" href="'.route('admin.addCategory',$value->id).'">add</a>';
            echo '<a style ="margin-left: 3.333%;" class="btn btn-danger btn-xs col-sm-3" role="button" href="'.route('admin.delCategory',$value->id).'">del</a>';
            echo '</td>';
            echo '<td>';
            for($i=0;$i<($value->level-2)*3;$i++) {echo '&nbsp;';}
            echo $value->name;
            echo '</td>';
            echo '</tr>';
        }

    }});
?>
@extends('admin.adminapp')


@section('content')

            <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3>Редактирование категорий</h3></div>
                </div>
            </div>
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
                        {!! session('infomessage') !!}
                    </div>
                @endif
                <div class="col-sm-4">
                    <table class="table table-hover table-bordered table-condensed">
                        <thead>
                        <tr>
                            <th class="col-sm-4"> </th>
                            <th class="text-center">Категория</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{ Form::MakeCategoryTable($menu) }}

                        <tr>
                            <td class="text-center">
                            </td>
                            <td>
                                <a  class="btn btn-warning btn-sm col-sm-8 col-sm-offset-1" role="button" href="{{route('admin.addCategory')}}">Добавить корневую категорию</a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>

                <div class="col-sm-8">
                    @yield('category_content')
                </div>
            </div>
@endsection