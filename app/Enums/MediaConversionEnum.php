<?php

namespace App\Enums;

enum MediaConversionEnum
{
    public const  SMALL = 'small';
    public const LARGE = 'large';

    public const PARAMS = [
        self::SMALL => 'Маленькая',
        self::LARGE => 'Большая',
    ];
}
