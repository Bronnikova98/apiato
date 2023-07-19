<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Components\CustomImageUpload;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Containers\ShopSection\Category\Models\Category;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
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
use Closure;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Категория')
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

                    TextInput::make('description')
                        ->label('Описание')
                        ->maxLength(191),

                    TextInput::make('ordering')
                        ->label('Порядок отображения')
                        ->numeric()
                        ->maxLength(127),
                ]),

                Grid::make(2)->schema([
                    CustomImageUpload::make('thumbnail')
                        ->label('Изображение')
                        ->collection(MediaCollectionEnum::MEDIA_COLLECTION_CATEGORY)
                        ->required()
                        ->minFiles(1)
                        ->enableOpen()
                        ->enableDownload()
                        ->maxSize(5120)
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                        ->helperText('Максимальный размер: 5Мб. Допустимые типы: .png, .jpg, .jpeg'),
                ]),

                Grid::make(1)->schema([
                    Repeater::make('productFields')
                        ->label('Характеристики продукта')
                        ->relationship()
                        ->schema([
                            TextInput::make('name')
                                ->label('Название характеристики')
                                ->maxLength(191)
                                ->required(),
                        ]),
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
                TextColumn::make('description')
                    ->limit(25)
                    ->label('Описание'),
                TextColumn::make('ordering')
                    ->label('Порядок'),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_CATEGORY)
                    ->label('Изображение'),

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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
