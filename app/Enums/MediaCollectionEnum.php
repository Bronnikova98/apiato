<?php

namespace App\Enums;

enum MediaCollectionEnum
{
    public const MEDIA_COLLECTION_CATEGORY = 'category';
    public const MEDIA_COLLECTION_PRODUCT = 'product';
    public const MEDIA_COLLECTION_SLIDE = 'slide';
    public const MEDIA_COLLECTION_PARTNER = 'partner';
    public const MEDIA_COLLECTION_ARTICLE = 'article';
    public const MEDIA_COLLECTION_POST = 'post';

    public const PARAMS = [
        self::MEDIA_COLLECTION_CATEGORY => 'Категория',
        self::MEDIA_COLLECTION_PRODUCT => 'Продукт',
        self::MEDIA_COLLECTION_SLIDE => 'Слайд',
        self::MEDIA_COLLECTION_PARTNER => 'Партнер',
        self::MEDIA_COLLECTION_ARTICLE => 'Статья',
        self::MEDIA_COLLECTION_POST => 'Пост',

    ];
}
