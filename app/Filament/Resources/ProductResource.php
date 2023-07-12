<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Containers\ShopSection\Product\Models\Product;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                        ->autofocus()
                        ->maxLength(191)
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) {
                            $set('slug', Str::slug($state));
                        }
                        )
                        ->required(),

                    TextInput::make('slug')
                        ->maxLength(191)
                        ->required(),

                    Forms\Components\BelongsToSelect::make('category_id')
                        ->relationship('category', 'name')
                        ->required(),

                    TextInput::make('price')
                        ->numeric()
                        ->maxLength(263),

                    Forms\Components\Textarea::make('description')
                        ->maxLength(65535),

                    TextInput::make('ordering')
                        ->numeric()
                        ->maxLength(255),

                    Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                        ->collection(MediaCollectionEnum::MEDIA_COLLECTION_PRODUCT),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('description')->limit(50),
                Tables\Columns\TextColumn::make('ordering'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
