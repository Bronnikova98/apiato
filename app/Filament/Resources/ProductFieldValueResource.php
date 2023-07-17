<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductFieldValueResource\Pages;
use App\Filament\Resources\ProductFieldValueResource\RelationManagers;
use App\Containers\ShopSection\Product_field_values\Models\ProductFieldValue;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductFieldValueResource extends Resource
{
    protected static ?string $model = ProductFieldValue::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    Select::make('product_field_id')
                        ->label('Характеристика продукта')
                        ->relationship('productField', 'name')
                        ->required(),

                    Select::make('product_id')
                        ->label('Продукт')
                        ->relationship('product', 'name')
                        ->required(),

                    TextInput::make('value')
                        ->label('Значение')
                        ->maxLength(191)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(),
                TextColumn::make('value')
                    ->label('Значение'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductFieldValues::route('/'),
            'create' => Pages\CreateProductFieldValue::route('/create'),
            'edit' => Pages\EditProductFieldValue::route('/{record}/edit'),
        ];
    }
}
