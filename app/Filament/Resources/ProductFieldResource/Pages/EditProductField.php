<?php

namespace App\Filament\Resources\ProductFieldResource\Pages;

use App\Filament\Resources\ProductFieldResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductField extends EditRecord
{
    protected static string $resource = ProductFieldResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
