@extends('layouts.app')

@section('content')

@include('site._partials.slider-fluid')

<section class="points container" id="points">
    <div class="points__row row">
        <div class="points__item col-md-4 col-sm-12">
            <div class="points__icon"><i class="fas fa-heartbeat" aria-hidden="true"></i></div>
            <h2 class="points__header">Индивидуальный подход</h2>
            <p class="points__text">Мы индивидуально подходим к каждому нашему клиенту, даем хорошие советы и всегда готовы пойти на компромисс</p>
        </div>
        <div class="points__item col-md-4 col-sm-12">
            <div class="points__icon"><i class="fas fa-heartbeat" aria-hidden="true"></i></div>
            <h2 class="points__header">Отличное качество</h2>
            <p class="points__text">У нас самое лучшее качество поддонов, которые мы сами контролируем</p>
        </div>
        <div class="points__item col-md-4 col-sm-12">
            <div class="points__icon"><i class="fas fa-heartbeat" aria-hidden="true"></i></div>
            <h2 class="points__header">Всегда в наличии</h2>
            <p class="points__text">Весь товар который вы найдете у нас на сайте, всегда в наличии</p>
        </div>
    </div>
</section>

<section class="services container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="services__hero-header hero-header">Категории товаров</h2>
        </div>
    </div>
    <div class="row services__row">
        @forelse($categories as $category)
        <div class="services__service col-md-4 col-sm-6 col-xs-12">
            <a href={{url("/shop/".$category->alias)}} class="services__link">
                <div class="services__image">
                    <img src={{$category->title_image}} class="services__image-image" alt="Alghero">
                    <p class="services__text">{{$category->description}}</p>
                </div>
                <h2 class="services__header">{{$category->name}}</h2>
            </a>
        </div>
        @empty
        <h1>Здесь ещё нет категорий</h1>
        @endforelse
    </div>
</section>

<section class="events container-fluid" id="events">
    <div class="container">
        <div class="events__row row">
            <div class="col-md-12 events__content">
                <h2 class="events__header">Продажа поддонов</h2>
                <p class="events__text">Только в нашем магазине вы можете продать свои поддоны - нам! <br> Вы можете отправить заявку на продажу и мы обязательно её рассмотрим и свяжемся с вами!</p>
                <a href="#" class="events__button">Продать поддоны</a>
            </div>
        </div>
    </div>
</section>

<section class="counter container-fluid">
    <div class="container">
        <div class="row counter__row">
            <div class="col-md-4 col-sm-12 counter__content">
                <div class="counter__icon"><i class="fas fa-users"></i></div>
                <h2 class="counter__count first-count">1000+</h2>
                <p class="counter__text">Довольных покупателей</p>
            </div>
            <div class="col-md-4 col-sm-12 counter__content">
                <div class="counter__icon"><i class="fas fa-mobile-alt"></i></div>
                <h2 class="counter__count second-count">1 000 000 +</h2>
                <p class="counter__text">Поддонов продано</p>
            </div>
            <div class="col-md-4 col-sm-12 counter__content">
                <div class="counter__icon"><i class="fas fa-sun"></i></div>
                <h2 class="counter__count third-count">15</h2>
                <p class="counter__text">Лет наша компания на рынке</p>
            </div>
        </div>
    </div>
</section>

<div id="shop-root" style="position: absolute"></div>

@endsection
