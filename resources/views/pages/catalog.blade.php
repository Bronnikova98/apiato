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
        <p><b style="border-bottom: solid 2px black; padding-bottom: 2px;">{{__('Категории продуктов')}}</b></p>

        {{--        список категорий с картинками, названиями и ссылками для перехода--}}
        @if(empty($categories))
            <b> {{ __('Категории не найдены') }}</b>
        @else
            @foreach($categories as $category)
                <div style="margin-top: 6px; margin-bottom: 6px;">
                    <p> {{$category->getName()}}</p>
                    <p>
                        <a style="color: #17a2b8;"
                           href="{{route('catalog.category', $category->getSlug())}}">
                            {{__('Подробнее о категории')}}
                        </a>
                    </p>
                </div>
            @endforeach
        @endif
        <div>
@endsection
