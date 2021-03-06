@extends('layouts.app')
@section('json-ld')<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name": "Купер&Хантер Украина",
      "alternateName": "Cooper&Hunter Украина",
      "description": "Магазин климатической техники производства Cooper&Hunter",
      "url": "http://www.куперхантер.укр"
    }
</script>
@endsection
@section('title')<title>Купер&Хантер Украина. Весь ассортимент продукции от производителя</title>
@endsection
@section('meta')<meta name="description" content="Весь ассортимент продукции Cooper&amp;Hunter - кондиционеры, осушители, вытяжки " />
<meta name="keywords" content="кондиционер, вытяжка, осушитель, купить Cooper&amp;Hunter КуперХантер" />
<meta name="yandex-verification" content="3af4a18ce1da17e1" />
@endsection
@section('content')

    <div class="container" >
        <div class="row">
            <div class="col-sm-{{isset($siteParameters['promotionEnable']) ? 10 : 12}}">
                @if(count($announceCategory))
                    @include('layouts.helpers.categoriesList2', ['categories' => $announceCategory])
                @endif
                @if(count($homeArticles) && isset($siteParameters['promotionEnable']))
                    {{--<div class="container">--}}
{{--                    <div class="row well">
                        <div class="row  text-center categoryList"><h3>Популярные товары</h3></div>
                        @foreach(array_chunk($homeArticles->all(),4) as $articleRow)
                            <div class="row">
                                @foreach($articleRow as $article)
                                <a href="{{route('showArticle', ['article' => $article->getArticleLink()])}}">
                                    <div class="col-sm-3">
                                        <img class="img-responsive img-thumbnail" src="{{$article->getIntroImg('S','intro1')}}"
                                             alt="">
                                        {{$article->name}}
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>--}}
<div style="height: 10px;"></div>
                @endif
                {{--</div>--}}
            </div>

            @if(isset($siteParameters['promotionEnable']))
            <div class="col-sm-2 well" style="border-left: 1px solid rgba(98, 159, 246, 0.41);border-radius: 0">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
                @endif
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.helpers.footer')
@endsection