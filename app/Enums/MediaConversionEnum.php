<?php

namespace App\Enums;

enum MediaConversionEnum
{
    public const  MEDIA_CONVERSION_SIZE_SMALL = 'small';
    public const MEDIA_CONVERSION_SIZE_LARGE = 'large';

    public const PARAMS = [
        self::MEDIA_CONVERSION_SIZE_SMALL => 'Маленькая',
        self::MEDIA_CONVERSION_SIZE_LARGE => 'Большая',
    ];
}
