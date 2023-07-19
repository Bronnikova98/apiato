<?php

namespace App\Filament\Resources\ProductFieldResource\Pages;

use App\Filament\Resources\ProductFieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductField extends CreateRecord
{
    protected static string $resource = ProductFieldResource::class;
}
