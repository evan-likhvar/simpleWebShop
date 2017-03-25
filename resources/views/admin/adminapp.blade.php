<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    <link rel="stylesheet" href="/css/bootstrap/3.3.7/bootstrap.min.css" type="text/css" />--}}
    <link rel="stylesheet" href="/css/dropzone/4.3.0/dropzone.min.css" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
      <script src="/js/jquery/1.12.4/jquery.min.js"></script>
      <script src="/js/bootstrap/3.3.7/bootstrap.min.js"></script>
      --}}
    <script src="/src/js/dropzone/4.3.0/dropzone.min.js"></script>
    <script>
        Dropzone.options.myDropzone = {
            maxFilesize: 500,
            init: function() {
                this.on("uploadprogress", function(file, progress) {
                    console.log("File progress", progress);
                });
            }
        }
    </script>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <div class="well">
                <h3 class="">Admin Console</h3>
                <h4>Вы вошли как: <strong>{{ Auth::user()->name }}</strong>

                    <a href="{{ url('/logout') }}"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <button type="button" class="btn btn-danger btn-xs"><b>Выход</b></button>
                    </a>

                </h4>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <h4>
                    <a href="/">
                        <button type="button" class="btn btn-warning btn-sm">На главную</button>
                    </a>
                </h4>
            </div>
            <div class="panel-group" id="__accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOrders">Заказы</a>
                        </h4>
                    </div>
                    <div id="collapseOrders" class="panel-collapse collapse in">
                        <div class="list-group">
                            <a href="{{route('admin.order')}}" class="list-group-item">Заказы</a>

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseArticle">Товары</a>
                        </h4>
                    </div>
                    <div id="collapseArticle" class="panel-collapse collapse in">
                        <div class="list-group">
                            <a href="{{route('admin.article')}}" class="list-group-item">Список товаров</a>
                            <a href="{{route('admin.createArticle')}}" class="list-group-item">Новый товар</a>
                            <a href="{{route('admin.priceArticleList')}}" class="list-group-item">Прайс листы</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseDirectory">Справочники</a>
                        </h4>
                    </div>
                    <div id="collapseDirectory" class="panel-collapse collapse">
                        <div class="list-group">
                            <a href="{{route('admin.category')}}" class="list-group-item">Категории</a>

                            <a href="{{route('admin.vendor')}}" class="list-group-item">Производители</a>
                            <a href="{{route('admin.parameter-category')}}" class="list-group-item">Классы параметров</a>
                            {{--<a href="{{route('admin.parameter')}}" class="list-group-item">Параметры</a>--}}
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Параметры</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="list-group">
                            @foreach($parGrp as $item)
                                <a href="{{route('admin.parameter', ['group' => $item->id])}}" class="list-group-item">{{$item->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePaper">Параметры сайта</a>
                        </h4>
                    </div>
                    <div id="collapsePaper" class="panel-collapse collapse in">
                        <div class="list-group">
                            <a href="{{route('admin.siteParameterEdit')}}" class="list-group-item">Параметры сайта</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePaper">Статьи</a>
                        </h4>
                    </div>
                    <div id="collapsePaper" class="panel-collapse collapse in">
                        <div class="list-group">
                            <a href="{{route('admin.paperCategoryIndex')}}" class="list-group-item">Категории Стататей</a>
                            <a href="{{route('admin.paper')}}" class="list-group-item">Статьи</a>
                            <a href="{{route('admin.createPaper')}}" class="list-group-item">Новая статья</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapsePaper">Акции</a>
                        </h4>
                    </div>
                    <div id="collapsePaper" class="panel-collapse collapse in">
                        <div class="list-group">
                            <a href="{{route('admin.promotion')}}" class="list-group-item">Акции</a>

                            <a href="{{route('admin.createPromotion')}}" class="list-group-item">Новая акция</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-10">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
