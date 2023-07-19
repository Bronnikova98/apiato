<?php

namespace App\Filament\Resources\ProductFieldValueResource\Pages;

use App\Filament\Resources\ProductFieldValueResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductFieldValues extends ListRecords
{
    protected static string $resource = ProductFieldValueResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
