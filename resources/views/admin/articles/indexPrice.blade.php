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
                <div class="row" style="background-color: #fff">
                    {!! Form::open(['method'=>'GET','action'=>'Admin\PriceController@index','class'=>'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('filter','Фильтр по категории:',['class'=>'control-label col-sm-4']) !!}
                        <div class="col-sm-4">
                            {!! Form::select('filter',['0'=>'Снять фильтр']+$categories,null,['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit('Применить',['class'=>'btn btn-info']) !!}
                    </div>
                    {!! Form::close() !!}
                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-2">
                            {!! Form::open(['method'=>'POST','action'=>'Admin\PriceController@hotLinePriceXML','class'=>'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::submit('hotline.ua',['class'=>'btn btn-info col-sm-10']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Form::open(['method'=>'POST','action'=>'Admin\PriceController@priceUAPriceXML','class'=>'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::submit('price.ua',['class'=>'btn btn-info col-sm-10']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="col-sm-2">
                            {!! Form::open(['method'=>'POST','action'=>'Admin\PriceController@createSiteMap','class'=>'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::submit('карта сайта',['class'=>'btn btn-info col-sm-10']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="well" style="background-color: #fff">
        <table class="table table-hover table-bordered table-condensed">
            <thead>
            <tr>

                <th>
                    <a href="{{route('admin.priceArticleList')}}?sort=id&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}"
                       .>Индекс</a></th>
                <th>
                    <a href="{{route('admin.priceArticleList')}}?sort=name&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Название</a>
                </th>
                <th>
                    <a href="{{route('admin.priceArticleList')}}?sort=priceGRN&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Цена
                        ГРН</a></th>
                <th class="text-center">
                    <a href="{{route('admin.priceArticleList')}}?sort=avaliable&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">Наличие</a>
                </th>
                <th class="text-center">
                    <a href="{{route('admin.priceArticleList')}}?sort=hotline&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">hotline</a>
                </th>
                <th class="text-center">
                    <a href="{{route('admin.priceArticleList')}}?sort=priceua&order={{Request::input('order')=='desc' ? 'asc' : 'desc' }}&filter={{Request::input('filter')}}">priceua</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach ($articles as $item)
                <tr>

                    <td>{{$item->id}}</td>

                    <td style="font-size: 90%; padding: 5px 0 5px 0;">{{$item->name}}</td>

                    <td class="priceCell" style="width: 250px;"><input style="width: 100px;" type="text"
                                                                       name="price{{$item->id}}" data-id="{{$item->id}}"
                                                                       value="{{$item->priceGRN}}" disabled>
                        <a class="editPrice" href="#">редактировать</a>
                        <a class="savePrice" style="display: none;" href="#">сохранить</a>
                    </td>
                    <td style="vertical-align: middle;" class="text-center" data-id="{{$item->id}}" data-value="{{$item->avaliable}}"
                        data-type="avaliable"><span
                                class="toggleable {{$item->avaliable==0 ? 'classNo' : 'classYes'}}">{{$item->avaliable==0 ? 'Нет' : 'Да'}}</span>
                    </td>

                    <td style="vertical-align: middle;" class="text-center"
                        data-id="{{$item->id}}" data-type="hotline" data-value="{{$item->hotline}}"><span
                                class="toggleable {{$item->hotline==0 ? 'classNo' : 'classYes'}}">{{$item->hotline==0 ? 'Нет' : 'Да'}}</span>
                    </td>

                    <td style="vertical-align: middle;" class="text-center"
                        data-id="{{$item->id}}" data-type="priceua" data-value="{{$item->priceua}}"><span
                                class="toggleable {{$item->priceua==0 ? 'classNo' : 'classYes'}}">{{$item->priceua==0 ? 'Нет' : 'Да'}}</span>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>


        {{ $articles->appends(Request::input())->links() }}

    </div>

    <script>
        $(document).ready(function () {
            $(" .editPrice").on("click", priceEnable);
            $(" .savePrice").on("click", priceSave);
            $(" .toggleable").on("click", toggleValue);
        });
        function toggleValue() {
            var id = $(this).parent().data("id");
            var value = $(this).parent().data("value");
            var type = $(this).parent().data("type");
            //alert('click before'+ id +' '+ value +' '+ type);
            if (value == 0) {
                value = 1;
                $(this).parent().data("value",1);
                $(this).text('Да').removeClass("classNo").addClass("classYes");
            } else {
                value = 0;
                $(this).parent().data("value",0);
                $(this).text('Нет').removeClass("classYes").addClass("classNo");
            }

            var request = $.ajax({
                url: "/admin/articleToggleJSON",
                method: "GET",
                data: {'id': id, 'value': value, 'type': type},
                dataType: "json"
            });
            request.fail(function () {alert('ошибка!')});
        }

        function priceEnable() {
            $(this).prev().css("background-color", "white").removeAttr("disabled");
            $(" .editPrice ").css("display", "none");
            $(this).next().css("display", "inline");
        }

        function priceSave() {
            var articleID = $(this).prev().prev().data("id");
            var newPrice = $(this).prev().prev().val();
            var updatePrice = sendRequest(articleID, newPrice);
            $(this).css("display", "none").prev().prev().css("background-color", "#ddd").attr("disabled", "disabled");
            $(" .editPrice ").css("display", "inline");
            //alert('save new price - '+newPrice+' id = '+ articleID);
        }

        function sendRequest(articleID, newPrice) {
            var request = $.ajax({
                url: "/admin/articlePriceJSON",
                method: "GET",
                data: {'id': articleID, 'price': newPrice},
                dataType: "json"
            });
            request.fail(function (mesages) {
                if (mesages.status == 422) {
                    alert(mesages.responseText);
                }
                else {
                    alert(mesages.responseJSON.message);
                }
            });
            request.done(function (mesages) {
                //alert('success!!!'+mesages.message);
            });

        }
    </script>
@endsection