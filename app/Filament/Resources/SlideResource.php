<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Components\CustomImageUpload;
use App\Filament\Resources\SlideResource\Pages;
use App\Filament\Resources\SlideResource\RelationManagers;
use App\Containers\AppSection\Slides\Models\Slide;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([
                Select::make('slider_id')
                    ->label('Слайдер')
                    ->relationship('slider', 'title')
                    ->required(),

                TextInput::make('name')
                    ->label('Название')
                    ->maxLength(191)
                    ->required(),

                TextInput::make('url')
                    ->label('Путь')
                    ->maxLength(255)
                    ->required(),

                TextInput::make('ordering')
                    ->label('Порядок отображения')
                    ->numeric()
                    ->maxLength(255),

                Toggle::make('is_publish')
                    ->label('Опубликовать'),
            ]),

            Grid::make(2)->schema([
                CustomImageUpload::make('thumbnail')
                    ->label('Изображение')
                    ->minFiles(1)
                    ->enableOpen()
                    ->enableDownload()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->helperText('Максимальный размер: 5Мб. Допустимые типы: .png, .jpg, .jpeg')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_SLIDE)
                    ->required(),
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
                TextColumn::make('url')->limit(50)
                    ->label('Путь'),
                TextColumn::make('ordering')
                    ->label('Порядок'),
                BooleanColumn::make('is_publish')
                    ->label('Опубликовать'),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('Изображение')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_SLIDE),
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
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }
}
