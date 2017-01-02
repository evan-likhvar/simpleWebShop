<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            <div class="col-sm-2">

            </div>
            <div class="col-sm-6">
                г. Киев, пр. Леся Курбаса, 3а (044) 502-81-42, (050) 614-22-22<br>
            г. Киев, ул. Донецкая, 3, (044) 520-17-15, (050) 875-92-30<br>
            г. Одесса, ул. Днепропетровская дорога, 99 б (066) 160-54-94
            096 344 6222 050 614 2222
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-primary">В козине <span class="badge">{{$cartItems}}</span></button>
            </div>
        </div>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">WebSiteName</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="/">Home</a></li>
                    @foreach($mainMenu as $item)
                        <li><a href="{{route('showCategory', ['categoryId' => $item->id])}}">{{$item->name}}</a></li>
                    @endforeach
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="">Page 1 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="google.com">Page 1-1</a></li>
                            <li><a href="#">Page 1-2</a></li>
                            <li><a href="#">Page 1-3</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        @yield('content')
    </div>

</body>
</html>
