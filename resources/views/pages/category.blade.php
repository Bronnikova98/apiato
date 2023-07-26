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
        <p><b class="pb-1" style="border-bottom: solid 2px black;">{{__('Категория')}}</b></p>
        <p class="pb-1 pt-1">{{$category->getName()}}</p>
        <img src="{{ $category->getFirstMediaUrl('category', 'small') }}" alt=""
             style="max-width: 260px;">
        <p class="mb-3">{{$category->getDescription()}}</p>

        {{--список продуктов с пагинацией: название, превью, цена, ссылка для перехода--}}
        <p><b class="pb-1" style="border-bottom: solid 2px black;">{{__('Продукты')}}</b></p>

        @if(empty($products))
            <b> {{ __('Продукты не найдены') }}</b>
        @else
            @foreach($products as $product)
                <div class="mb-3 mt-1">
                    <p>{{__('Название')}}: {{$product->getName()}}</p>
                    <p>{{__('Описание')}}: {{$product->getDescription()}}</p>
                    <p>{{__('Цена')}}: {{$product->getPrice()}} {{__('руб.')}}</p>
                    <a style="color: #17a2b8;"
                       href="{{route('catalog.category.product', [$category->getSlug(), $product->getSlug()])}}">{{__('Подробнее о продукте')}}</a>
                </div>
            @endforeach
        @endif
        <div>
            {{ $products->links('pagination.custom')}}
        </div>
    </div>
@endsection
