@extends('admin.adminapp')
@section('content')
    <div class="panel-group">
        <div class="panel panel-info">
            <div class="panel-heading"><h3>Список заказов</h3></div>
        </div>
    </div>

    <div class="well" style="background-color: #fff">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>
                <th class="col-sm-1"> </th>
                <th><a href="{{route('admin.order')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}".>Индекс</a></th>
                <th><a href="{{route('admin.order')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}".>Номер</a></th>
                <th><a href="{{route('admin.order')}}?sort=name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Имя</a></th>
                <th ><a href="{{route('admin.order')}}?sort=category_id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Телефон</a></th>
                <th ><a href="{{route('admin.order')}}?sort=vendor_id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Почта</a></th>
                <th >Плательщик</th>
                <th >Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $item)
                <tr>
                    <td >
                        <div style="width: 140px;">
                            <div style="width: 40px; float: left;">
                                <a class="btn btn-info btn-xs" role="button"
                                   href="{{route('admin.editOrder',$item->id)}}">Edit</a>
                            </div>
                            {{-- <div style="width: 40px; float: left; margin-right: 15px;">
                                 <a class="btn btn-info btn-xs" role="button"
                                    href="{{route('admin.order',$item->id)}}">Copy</a>
                             </div>
                             <div style="width: 40px; float: left;">
                                 {!! Form::open(['method'=>'DELETE','action'=>['Admin\ArticleController@destroy',$item->id]]) !!}
                                 {!! Form::submit('Delete',['class'=>'btn btn-danger btn-xs']) !!}
                                 {!! Form::close() !!}
                             </div>--}}
                        </div>
                    </td>
                    <td>{{$item->id}}</td>
                    <td>{{$item->nomer}}</td>
                    <td  style="font-size: 90%; padding: 5px 0 5px 0;">{{$item->contact_name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->e_mail}}</td>
                    <td>{{$item->payer}}</td>
                    <td>{{$item->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->appends(Request::input())->links() }}
    </div>
@endsection