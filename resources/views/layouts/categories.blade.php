@extends('layouts.app')
@section('json-ld')<script type="application/ld+json">
[    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name": "Купер&Хантер Украина",
      "alternateName": "Cooper&Hunter Украина",
      "description": "Магазин климатической техники производства Cooper&Hunter",
      "url": "http://www.куперхантер.укр"
    },
    {
    "@context": "http://schema.org",
    "@type":"WebPage",
    "headline": "{{$category->name}}",
    "description": "{{strlen($category->description)>4 ? strip_tags($category->description) : $category->name }}"
    }
]
</script>
@endsection
@section('title')<title>Продукция Cooper&amp;Hunter в категории {{$category->name}}</title>
@endsection
{{--@section('meta')<meta name="description" content="Продукция КуперХантер в категории {{$category->name}}" />
<meta name="keywords" content="{{$category->name}} Cooper&amp;Hunter КуперХантер" />
@endsection--}}
@section('meta')<meta name="description" content="{{strlen($category->metadescription)>10 ? $category->metadescription : strip_tags($category->description)}}" />
<meta name="keywords" content="{{ strlen($category->metakey)>10 ? $category->metakey : $category->name}} {{$category->name}}" />
@endsection
@section('content')
    <div class="container">
        <div class="row" style="height: 30px;"></div>
        <div class="row text-justify">
            <div class="col-sm-12">
                {!! $category->description !!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-{{isset($siteParameters['promotionEnable']) ? 10 : 12}}">
                @if(count($category->Children))
                    @include('layouts.helpers.categoriesList', ['categories' => $category->Children->where('published','=','1')])
                @endif
            </div>
            @if(isset($siteParameters['promotionEnable']))
            <div class="col-sm-2 well">
                @include('layouts.helpers.promoRight', ['Articles' => $homeArticles])
            </div>
                @endif
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.helpers.footer')
@endsection