<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Components\CustomImageUpload;
use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Containers\AppSection\Sliders\Models\Slider;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    TextInput::make('title')
                        ->name('Название')
                        ->maxLength(191)
                        ->required(),
                ]),

                Grid::make(1)->schema([
                    Repeater::make('slides')
                        ->label('Слайды')
                        ->relationship()
                        ->schema([
                            Grid::make(2)->schema([
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
                            ]),

                            Toggle::make('is_publish')
                                ->label('Опубликовать'),

                            Grid::make(2)->schema([
                                CustomImageUpload::make('thumbnail')
                                    ->label('Изображение')
                                    ->maxSize(5000)
                                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_SLIDE),

                            ]),
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
                TextColumn::make('title')
                    ->label('Заголовок'),
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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
        ];
    }
}
