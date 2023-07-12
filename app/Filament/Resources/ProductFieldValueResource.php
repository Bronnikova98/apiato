<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductFieldValueResource\Pages;
use App\Filament\Resources\ProductFieldValueResource\RelationManagers;
use App\Containers\ShopSection\Product_field_values\Models\ProductFieldValue;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
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
                Card::make()->schema([

                    Forms\Components\BelongsToSelect::make('product_field_id')
                        ->relationship('productField', 'name')
                        ->required(),

                    Forms\Components\BelongsToSelect::make('product_id')
                        ->relationship('product', 'name')
                        ->required(),

                    TextInput::make('value')
                        ->maxLength(191)
                        ->required(),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('value'),
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
