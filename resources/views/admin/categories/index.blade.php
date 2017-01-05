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
?>
@extends('admin.adminapp')


@section('content')

            <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3>Редактирование категорий</h3></div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">

                    <div class="panel-group" id="__accordion">

                            {{ Form::MakeNavigation($menu) }}
                            <a href="#" class="list-group-item">+++++++++++++++</a>
                    </div>

                </div>

                <div class="col-sm-8">
                    @yield('category_content')
                </div>
            </div>
@endsection