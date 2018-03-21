@extends('layouts.shop')

@section('content')

    <div class="hero container-fluid">
        <div class="row no-gutters">
            <div class="col-md-12">
                <h1 class="hero__header" itemprop="headline">Магазин</h1>
            </div>
        </div>
    </div>

    <div id="shop-root"></div>

    <div class="robots-only" style="visibility: hidden; position: absolute">
        @forelse($products as $product)
            <div class="product">
                <h3 class="product__title">{{$product->title}}</h3>
                <a href={{url("/shop/product/".$product->id)}}>{{$product->title}}</a>
            </div>
        @empty
            Nothing
        @endforelse
    </div>

    @if($category)
        <script type="application/ld+json">
            {
              "@context": "http://schema.org",
              "@type": "BreadcrumbList",
              "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "item": {
                  "@id": "https://poddonu.com.ua",
                  "name": "Home"
                }
              },{
                "@type": "ListItem",
                "position": 2,
                "item": {
                  "@id": "{{"https://poddonu.com.ua/shop/".$category}}",
                  "name": "{{$category}}"
                }
              }]
            }
        </script>
    @else
        <script type="application/ld+json">
            {
              "@context": "http://schema.org",
              "@type": "BreadcrumbList",
              "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "item": {
                  "@id": "https://poddonu.com.ua",
                  "name": "Home"
                }
              },{
                "@type": "ListItem",
                "position": 2,
                "item": {
                  "@id": "https://poddonu.com.ua/shop/",
                  "name": "Магазин"
                }
              }]
            }
        </script>
    @endif

@endsection