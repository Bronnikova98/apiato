<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Components\CustomImageUpload;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Containers\ShopSection\Product\Models\Product;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
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
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Название')
                        ->autofocus()
                        ->maxLength(191)
                        ->reactive()
                        ->afterStateUpdated(function (Closure $set, $state) {
                            $set('slug', Str::slug($state));
                        }
                        )
                        ->required(),

                    TextInput::make('slug')
                        ->label('Ссылка')
                        ->maxLength(191)
                        ->required(),

                    TextInput::make('price')
                        ->label('Цена')
                        ->numeric()
                        ->maxLength(263)
                        ->required(),

                    Select::make('category_id')
                        ->label('Категория')
                        ->relationship('category', 'name')
                        ->required(),

                    Textarea::make('description')
                        ->label('Описание')
                        ->maxLength(65535),

                    TextInput::make('ordering')
                        ->label('Порядок отображения')
                        ->numeric()
                        ->maxLength(255),
                ]),

                Grid::make(4)->schema([
                        CustomImageUpload::make('thumbnail')
                            ->label('Изображения')
                            ->collection(MediaCollectionEnum::MEDIA_COLLECTION_PRODUCT)
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                            ->multiple()
                            ->maxFiles(5)
                            ->minFiles(1)
                            ->enableOpen()
                            ->enableDownload()
                            ->enableReordering()
                            ->helperText('До 5 файлов. Максимальный размер каждого: 5Мб. Допустимые типы: .png, .jpg, .webp')

                            ->required(),
                ]),

                Grid::make(1)->schema([
                    Repeater::make('productFieldValues')
                        ->label('Значения характеристик продукта')
                        ->relationship()
                        ->schema([
                            Select::make('product_field_id')
                                ->label('Характеристика')
                                ->relationship('productField', 'name')
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
                    ->limit(25)
                    ->label('Название'),
                TextColumn::make('price')
                    ->label('Цена'),
                TextColumn::make('description')
                    ->limit(25)
                    ->label('Описание'),
                TextColumn::make('ordering'),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('Изображения')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_PRODUCT),
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
