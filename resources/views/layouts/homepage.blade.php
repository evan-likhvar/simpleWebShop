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
@section('title')<title>КуперХантер Украина. Весь ассортимент продукции от производителя</title>
@endsection
@section('meta')<meta name="description" content="Весь ассортимент продукции Cooper&amp;Hunter - кондиционеры, осушители, вытяжки " />
<meta name="keywords" content="кондиционер, вытяжка, осушитель, купить Cooper&amp;Hunter КуперХантер" />
@endsection
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                @if(count($announceCategory))
                    @include('layouts.helpers.categoriesList', ['categories' => $announceCategory])
                @endif
                @if(count($homeArticles))
                    {{--<div class="container">--}}
                    <div class="row well">
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
                    </div>

                @endif
                {{--</div>--}}
            </div>
            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.helpers.footer')
@endsection