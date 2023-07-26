@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <a href="/" class="me-2 p-2" style="color: #0b2e13; border: #8fd19e solid 2px;">
            {{__('Домашняя страница')}}
        </a>
        <a href="{{route('catalog')}}"
           class="me-2 p-2" style="color: #0b2e13; border: #8fd19e solid 2px;">
            {{__('Каталог')}}
        </a>
        <a href="{{route('news')}}"
           class="me-2 p-2" style="color: #0b2e13; border: #8fd19e solid 2px;">
            {{__('Новости')}}
        </a>
    </div>
    <div class="container mt-3">
        <p><b style="border-bottom: solid 2px black; padding-bottom: 2px;">{{__('Слайдер')}}</b></p>

        {{$sliders}}

        {{--        <div class="container main_carousel">--}}
        {{--            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">--}}
        {{--                <div class="carousel-indicators">--}}
        {{--                    @foreach ($sliders as $slider)--}}
        {{--                        <button type="button" data-bs-target="#carouselExampleCaptions"--}}
        {{--                                data-bs-slide-to="{{ $loop->index }}"--}}
        {{--                                class="main_carousel_indicator @if ($loop->first) active @endif"--}}
        {{--                                aria-current="true"></button>--}}
        {{--                    @endforeach--}}
        {{--                </div>--}}
        {{--                <div class="carousel-inner">--}}
        {{--                    @foreach ($sliders as $slider)--}}
        {{--                        <div class="carousel-item @if ($loop->first) active @endif">--}}
        {{--                            <img src="{{ $slider->img }}" class="main_carousel_image"--}}
        {{--                                 alt="{{ $slider->alt }}">--}}
        {{--                            <div class="main_carousel_text d-none d-md-block text-center">--}}
        {{--                                <p>{{ $slider->text }}</p>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    @endforeach--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        {{--    с картинками, названиями и ссылками для перехода--}}
        <p><b style="border-bottom: solid 2px black; padding-bottom: 2px;">{{__('Категории продуктов')}}</b></p>
        <p> --- </p>


        <p><b style="border-bottom: solid 2px black; padding-bottom: 2px;">{{ __('Последние новости') }}</b></p>
        @if(empty($posts))
            <b> {{ __('Новости не найдены') }}</b>
        @else
            @foreach($posts as $post)
                <div class="my-3">
                    <img src="{{ $post->getFirstMediaUrl('post', 'small') }}" alt=""
                         style="max-height: 80px;">
                    <p> {{$post->getTitle()}}</p>
                    <p> {{$post->getShortDescription()}}</p>
                    <p> {{$post->getDate()}}</p>
                    <p>
                        <a style="color: #17a2b8;" href="{{ route('news.show', $post->getKey()) }}">
                            {{__('К новости')}}
                        </a>
                    </p>
                </div>
            @endforeach
        @endif
        <p class="mb-2">
            <a style="color: #17a2b8;" href="{{ route('news') }}">{{__('Все новости')}}</a>
        </p>
        <p><b style="border-bottom: solid 2px black; padding-bottom: 2px;">{{__('Партнеры')}}</b></p>
        @if(empty($partners))
            <b>{{ __('Партнеры не найдены') }}</b>
        @else
            @foreach($partners as $partner)
                <div class="my-3">
                    <p> {{$partner->getName()}}</p>
                </div>
            @endforeach
        @endif
    </div>
@endsection
