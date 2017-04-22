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
                <th ><a href="{{route('admin.order')}}?sort=status&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Статус</a></th>
                <th><a href="{{route('admin.order')}}?sort=nomer&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}".>Номер</a></th>
                <th><a href="{{route('admin.order')}}?sort=contact_name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Имя</a></th>
                <th ><a href="{{route('admin.order')}}?sort=phone&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Телефон</a></th>
                <th ><a href="{{route('admin.order')}}?sort=e_mail&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Почта</a></th>
                <th >Сумма заказа</th>
                <th >Кол-во</th>
                <th >Оплата</th>
                <th >Доставка</th>
                <th >Адрес</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $item)
                <tr >
                    <td >
                        <div style="width: 100px;">
                            <div style="width: 40px; float: left;">
                                <a class="btn btn-info btn-xs" role="button"
                                   href="{{route('admin.editOrder',$item->id)}}">Edit</a>
                            </div>
                            {{-- <div style="width: 40px; float: left; margin-right: 15px;">
                                 <a class="btn btn-info btn-xs" role="button"
                                    href="{{route('admin.order',$item->id)}}">Copy</a>
                             </div>--}}
                             <div style="width: 40px; float: left;">
                                 {!! Form::open(['method'=>'DELETE','action'=>['Admin\OrderController@destroy',$item->id]]) !!}
                                 {!! Form::submit('Delete',['class'=>'btn btn-danger btn-xs']) !!}
                                 {!! Form::close() !!}
                             </div>
                        </div>
                    </td>
                    <td>{{$item->id}}</td>
                    <td style="background-color: {{$item->Color}};">{{$item->StatusName}}</td>
                    <td>{{$item->nomer}}</td>
                    <td  style="font-size: 90%; padding: 5px 0 5px 0;">{{$item->contact_name}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->e_mail}}</td>
                    <td>{{$item->orderAmount()}}</td>
                    <td>{{$item->quantityAmount()}}</td>
                    <td>{{$item->PaymentName}}</td>
                    <td>{{$item->ShipmentName}}</td>
                    <td>{{$item->location}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->appends(Request::input())->links() }}
    </div>

    <div style="color: greenyellow"
@endsection