<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <title>{{$product->title}}</title>

    <meta name="description" content={{$product->description}}>
    <meta name="keywords" content="Купить поддоны, магазин поддонов, продать поддоны, поддоны, паллеты, купить паллеты">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="x-rim-auto-match" content="none">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115814669-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-115814669-1');
    </script>

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
              "@id": "{{"https://poddonu.com.ua/shop/".$product->category->alias}}",
              "name": "{{$product->category->name}}"
            }
          }, {
            "@type": "ListItem",
            "position": 2,
            "item": {
              "@id": "{{"https://poddonu.com.ua/product/".$product->id}}",
              "name": "{{$product->title}}"
            }
          }]
        }
    </script>

</head>
<body>

@include('site._partials.navbar')

<main class="cd-main-content">
    <div class="hero container-fluid">
        <div class="row no-gutters">
            <div class="col-md-12">
                <h1 class="hero__header">{{$product->category->name}}</h1>
            </div>
        </div>
    </div>

    <div class="container product">
        <div class="row">
            <div class="col-md-6">
                <div class="product__slider">
                    <div class="slider-for">
                        <div class="product__slider-item-container">
                            <a href={{$product->title_image}} class="product__slider-item_popup">
                                <img class="product__slider-item" src={{$product->title_image}} alt={{$product->title}} />
                            </a>
                        </div>
                        @foreach($product->images as $image)
                            <div class="product__slider-item-container">
                                <a href={{$image->path}} class="product__slider-item_popup">
                                    <img class="product__slider-item" src={{$image->path}} alt={{$product->title}} />
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="slider-nav" id="slider-nav">
                        <div class="product__slider-item-container">
                            <img class="product__slider-item" src={{$product->title_image}} alt={{$product->title}} />
                        </div>
                        @foreach($product->images as $image)
                            <div class="product__slider-item-container">
                                <img class="product__slider-item" src={{$image->path}} alt={{$product->title}} />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div id="shop-root"></div>
            </div>
        </div>
    </div>
</main>

<div class="top"><i class="fa fa-angle-up" aria-hidden="true"></i></div>

@include('site._partials.footer')

<!-- Scripts -->
<script src="{{ asset('js/site/site.js') }}"></script>

</body>
</html>