<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductFieldResource\Pages;
use App\Filament\Resources\ProductFieldResource\RelationManagers;
use App\Containers\ShopSection\Product_fields\Models\ProductField;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductFieldResource extends Resource
{
    protected static ?string $model = ProductField::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    Forms\Components\Select::make('category_id')
                        ->label('Категория')
                        ->relationship('category', 'name')
                        ->required(),

                    TextInput::make('name')
                        ->label('Название характеристики')
                        ->maxLength(191)
                        ->required(),
                ]),

                Grid::make(1)->schema([
                    Repeater::make('productFieldsValues')
                        ->label('Значение характеристик продукта')
                        ->relationship()
                        ->schema([
                            Select::make('product_id')
                                ->label('Продукт')
                                ->relationship('product', 'name')
                                ->required(),

                            TextInput::make('value')
                                ->label('Значение')
                                ->maxLength(191)
                                ->required(),
                        ])->columns(2),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(),
                TextColumn::make('name')
                    ->label('Название'),
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
            'index' => Pages\ListProductFields::route('/'),
            'create' => Pages\CreateProductField::route('/create'),
            'edit' => Pages\EditProductField::route('/{record}/edit'),
        ];
    }
}
