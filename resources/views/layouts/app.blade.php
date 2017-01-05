<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css" type="text/css"/>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    <link rel="stylesheet" href="/css/bootstrap/3.3.7/bootstrap.min.css" type="text/css" />--}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
      <script src="/js/jquery/1.12.4/jquery.min.js"></script>
      <script src="/js/bootstrap/3.3.7/bootstrap.min.js"></script>
      --}}


</head>
<body>
<div class="container">
    <div class="row">
        <div class="text-center topborder">
            <h4>
                <span class="glyphicon glyphicon-earphone main-color"></span> 044 292-19-49<span
                        style="padding-right: 20px;"></span>
                <span class="glyphicon glyphicon-earphone main-color"></span> 044 292-19-49<span
                        style="padding-right: 20px;"></span>
                <span class="glyphicon glyphicon-earphone main-color"></span> 044 292-19-49<span
                        style="padding-right: 20px;"></span>
                <span class="glyphicon glyphicon-earphone main-color"></span> 044 292-19-49
            </h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-10 top-menu">

            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">
                            <div>
                                Кондиционирование<br>вентиляция отопление
                            </div>
                        </a>
                    </div>
                    <ul class="nav navbar-nav">
                        {{--<li class="active"><a href="/">Home</a></li>--}}
                        @foreach($mainMenu as $item)
                            <li><a href="{{route('showCategory', ['categoryId' => $item->id])}}">{{$item->name}}</a>
                            </li>
                        @endforeach
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="">Page 1 <span
                                        class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="google.com">Page 1-1</a></li>
                                <li><a href="#">Page 1-2</a></li>
                                <li><a href="#">Page 1-3</a></li>
                            </ul>
                        </li>
                        <li><a href="/">Контакты</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="col-sm-2 cart">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cart">В корзине <span class="badge">{{$countCartItems}}</span></button>
        </div>
    </div>
    @yield('content')
</div>
<div class="container-fluid" style="height: 100px;background-color: #67b168">

</div>

<!-- Modal -->
<div id="cart" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Корзина</h4>
            </div>
            <div class="modal-body">
                @foreach($cartItemsDescription as $article)
                    <div class="row">
                        <div class="col-sm-2">
                            <img class="img-responsive" src="{{$article->getIntroImg('S')}}" alt="">
                        </div>
                        <div class="col-sm-6">
                            {{$article->name}}
                        </div>
                        <div class="col-sm-4">
                            {{$article->priceGRN}}
                        </div>
                    </div>

                @endforeach
                <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Оформить заказ</h4>
                        </div>
                    </div>
                <div class=" well">
                    <div class="row">
                        <div class="form-group">
                            {!! Form::label('order','Ваше имя:', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('order',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('order','Телефон:', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('order',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('order','E-mail:', ['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('order',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</body>
</html>
