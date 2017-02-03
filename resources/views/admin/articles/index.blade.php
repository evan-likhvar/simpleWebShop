@extends('admin.adminapp')
@section('content')
    <div class="panel-group">
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-info">
                    <div class="panel-heading"><h3>Список артикулов</h3></div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="panel">
                    {!! Form::open(['method'=>'POST','action'=>'Admin\ArticleController@recalculatePrices','class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('course','Пересчитать розничные цены по курсу:',['class'=>'control-label col-sm-6']) !!}
                        <div class="col-sm-2">
                            {!! Form::text('course',null,['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit('Пересчитать',['class'=>'btn btn-info']) !!}
                    </div>
                    {!! Form::close() !!}
                    {!! Form::open(['method'=>'GET','action'=>'Admin\ArticleController@index','class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('filter','Фильтр по категории:',['class'=>'control-label col-sm-4']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('filter',['0'=>'Снять фильтр']+$categories,null,['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit('Применить',['class'=>'btn btn-info']) !!}
                    </div>

                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>



    <div class="well" style="background-color: #fff">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th class="col-sm-1"></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}"
                       .>Индекс</a></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}"
                       .>Номер</a></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Название</a>
                </th>
                <th>
                    <a href="{{route('admin.article')}}?sort=category_id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Категория</a>
                </th>
                <th>
                    <a href="{{route('admin.article')}}?sort=vendor_id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Производитель</a>
                </th>
                <th>
                    <a href="{{route('admin.article')}}?sort=priceYE&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Цена
                        УЕ</a></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=priceGRN&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Цена
                        ГРН</a></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=avaliable&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">В
                        наличии</a></th>
                <th>
                    <a href="{{route('admin.article')}}?sort=published&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Опубликована</a>
                </th>
                <th>
                    <a href="{{route('admin.article')}}?sort=order&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Приоритет</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $item)
                <tr>
                    <td>
                        <div style="width: 140px;">
                            <div style="width: 40px; float: left;">
                                <a class="btn btn-info btn-xs" role="button"
                                   href="{{route('admin.editArticle',$item->id)}}">Edit</a>
                            </div>
                            <div style="width: 40px; float: left; margin-right: 15px;">
                                <a class="btn btn-info btn-xs" role="button"
                                   href="{{route('admin.copyArticle',$item->id)}}">Copy</a>
                            </div>
                            <div style="width: 40px; float: left;">
                                {!! Form::open(['method'=>'DELETE','action'=>['Admin\ArticleController@destroy',$item->id]]) !!}
                                {!! Form::submit('Delete',['class'=>'btn btn-danger btn-xs']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nomer}}</td>
                    <td style="font-size: 90%; padding: 5px 0 5px 0;">{{$item->name}}</td>
                    <td>{{$item->Category->name}}</td>
                    <td>{{$item->Vendor->name}}</td>
                    <td>{{$item->priceYE}}</td>
                    <td>{{$item->priceGRN}}</td>
                    <td>{{$item->avaliable==0 ? 'Нет' : 'Да'}}</td>
                    <td>{{$item->published==0 ? 'Нет' : 'Да'}}</td>
                    <td>{{$item->order}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>


        {{ $articles->appends(Request::input())->links() }}
        {{--        {!! Form::open(['method'=>'GET','action'=>'Admin\ItemController@index','class'=>'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('name','Фильтр по названию:',['class'=>'control-label col-sm-2']) !!}
                    <div class="col-sm-6">
                        {!! Form::text('filter',null,['class'=>'form-control']) !!}
                    </div>
                    {!! Form::submit('Установить',['class'=>'btn btn-info']) !!}
                </div>
                {!! Form::close() !!}--}}
    </div>


@endsection