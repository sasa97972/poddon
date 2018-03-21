<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <title>Poddonu - покупка и продажа поддонов</title>

    <meta name="description" content="Poddonu - мы компания, которая занимается покупкой и продажей поддонов. Здесь вы можете найти любые поддоны, которые вам необходимы">
    <meta name="keywords" content="Купить поддоны, купить поддоны Киев, продать поддоны, поддоны, паллеты, купить паллеты">

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
          "@type": "Organization",
          "url": "https://poddonu.com.ua",
          "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "066-900-96-03",
            "contactType": "Александр",
            "areaServed": "UKR"
          },{
            "@type": "ContactPoint",
            "telephone": "098-575-87-70",
            "contactType": "Александр",
            "areaServed": "UKR"
          }]
        }
    </script>

</head>
<body>

    @include('site._partials.navbar')

    <main class="cd-main-content">
        @yield('content')
    </main>

    <div class="top"><i class="fa fa-angle-up" aria-hidden="true"></i></div>

    @include('site._partials.footer')

<!-- Scripts -->
<script src="{{ asset('js/site/site.js') }}"></script>
</body>
</html>
