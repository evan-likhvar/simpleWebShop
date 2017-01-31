<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/app.css" type="text/css"/>

    <link rel="stylesheet" href="/css/sfancy.css" type="text/css"/>
    <link rel="stylesheet" href="/css/sfancybutt.css" type="text/css"/>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
    {{--  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
    <link rel="stylesheet" href="/css/bootstrap/3.3.7/bootstrap.min.css" type="text/css" />--}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/js/sfancy.js"></script>
    <script src="/js/sfancybutt.js"></script>
    {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
      <script src="/js/jquery/1.12.4/jquery.min.js"></script>
      <script src="/js/bootstrap/3.3.7/bootstrap.min.js"></script>
      --}}


</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-10">
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
        <div class="col-sm-2 cart">
            @if(isset($countCartItems))
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#cart">В корзине <span
                            class="badge">{{$countCartItems}}</span></button>
            @endif
        </div>
    </div>
    <div class="row">
        @if(isset($mainMenu))
            <div class="col-sm-12 top-menu">

                <nav class="navbar">
                    <div class="container-fluid">
                        <div class="navbar-header" style="padding-right: 180px;">
                            <a class="navbar-brand" href="/">
                                <div style="padding-right: 50px">
                                    LOGO
                                </div>
                            </a>
                        </div>
                        <ul class="nav navbar-nav">
                            @foreach($mainMenu as $item)

                            <div class="menu-wrap {{$topActive == $item->id ? ' active' : ' menu-decoration'}}">
                                    <li style="padding-top: 12px;" {{$topActive == $item->id ? 'class=active' : '' }}>
                                        <a href="{{route('showCategory', ['categoryId' => $item->id])}}">{{$item->name}}</a>
                                    </li>
                            </div>
                                {{--@endif--}}
                            @endforeach


                        </ul>
                    </div>
                </nav>
            </div>

        @endif

    </div>
    @if(isset($mainMenu))
    @include('layouts.helpers.category_submenu', ['mainMenu' => $mainMenu])
    @endif
    @yield('content')
</div>


@if(isset($countCartItems))
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

                        {{--{{dd($article[1])}}--}}

                        <div id="cartRow" class="row">
                            <div id="articleId" style="display: none">{{$article[1]->id}}</div>
                            <div class="col-sm-2">
                                <img class="img-responsive" src="{{$article[1]->getIntroImg('XS')}}" alt="">
                            </div>
                            <div class="col-sm-4">
                                {{$article[1]->name}}
                            </div>
                            <div id="ArticlePrice" class="col-sm-1">
                                {{$article[1]->priceGRN}}
                            </div>
                            <div id="ArticleCount" class="col-sm-2">
                                <input class="form-control" min="1" step="1" name="count" type="number"
                                       value="{{$article[0]}}">
                            </div>
                            <div id="ArticleAmount" class="col-sm-2 text-right">
                                {{$article[0]*$article[1]->priceGRN}}
                            </div>
                            <div id="Remove" class="col-sm-1"><span class="glyphicon glyphicon-remove"></span></div>
                        </div>
                    @endforeach
                    <hr>
                    <div class="row">

                        <b>
                            <div class="col-sm-3 col-sm-offset-7">
                                Сумма заказа
                            </div>
                            <div id="OrderAmount" class="col-sm-2" style="font-size: 120%">
                            </div>
                        </b>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-5 col-sm-offset-4">
                            <a href="{{route('showOrder')}}" class="btn btn-info" role="button">Оформить заказ</a>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Вернуться к покупкам
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script type="application/javascript">
        $(document).ready(function () {
            $('div#OrderAmount').text(OrderAmount());
            $('div#ArticleCount input').change(ChangeCount);
            $('span.glyphicon-remove').css('cursor', 'pointer');
            $('span.glyphicon-remove').click(RemoveArticle);
            function ChangeCount(e) {
                var Selected = e.target;
                var NewCount = e.target.value;
                var ArticlePrice = e.target.offsetParent.previousElementSibling.innerText;
                var ArticleAmount = e.target.offsetParent.nextElementSibling.innerText;
                var ArticleId = $(this).parent().parent() [0].children[0].innerText;
                if (Number(e.target.value) > 0) {
                    var NewArticleAmount = Number(ArticlePrice) * Number(NewCount);
                    e.target.offsetParent.nextElementSibling.innerText = NewArticleAmount;
                    //console.log(ArticleId, NewCount);
                    //var tst = $(this).parent().parent()[0].children[0].innerText;
                    //console.dir(tst);
                }
                else {
                    e.target.value = 1;
                    NewCount = 1;
                }
                ;

                SetSessionArticles(ArticleId, NewCount);
                $('div#OrderAmount').text(OrderAmount());
                $('span.badge').text(OrderCount());
            }

            function OrderAmount() {
                var sum = 0;
                var count = 0;
                $('div#ArticleAmount').each(function () {
                    sum += Number($(this).text());
                });
                return sum;
            }

            function OrderCount() {
                var count = 0;

                $('div#ArticleCount input').each(function () {
                    count += Number($(this).val());
                });

                return count;
            }

            function RemoveArticle(e) {
                e.preventDefault();
                var ArticleId = $(this).parent().parent() [0].children[0].innerText;
                SetSessionArticles(ArticleId, 0);
                $(this).parents('div#cartRow').remove();
                $('div#OrderAmount').text(OrderAmount());
                $('span.badge').text(OrderCount());
            }

            function SetSessionArticles(ArticleId, Count) {
                var log = function (msg) {
                    console.log ? console.log(msg) : alert(msg);
                }
                var data = {
                    id: ArticleId,
                    count: Count
                };

                var t = JSON.stringify(data);
                var tt = 'count=' + Count + '&id=' + ArticleId;

                $.get("../setArticleCount", tt, function (data, status) {
                    log(data);
                    'json'
                });
                // console.log(t);
            }
        });

    </script>


@endif
</body>
</html>
