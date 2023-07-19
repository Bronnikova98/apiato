<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Components\CustomImageUpload;
use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Containers\AppSection\Partners\Models\Partner;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
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

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([

                TextInput::make('name')
                    ->label('Название')
                    ->maxLength(191)
                    ->required(),

                TextInput::make('ordering')
                    ->label('Порядок отображения')
                    ->numeric()
                    ->maxLength(127),

                Toggle::make('is_publish')
                    ->label('Опубликовать'),
            ]),

            Grid::make(2)->schema([
                CustomImageUpload::make('thumbnail')
                    ->label('Логотип')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_PARTNER)
                    ->maxSize(5120)
                    ->minFiles(1)
                    ->enableOpen()
                    ->enableDownload()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->helperText('Максимальный размер: 5Мб. Допустимые типы: .png, .jpg, .jpeg')
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
                    ->label('Название')
                    ->limit(50),
                TextColumn::make('ordering')
                    ->label('Порядок'),
                BooleanColumn::make('is_publish')
                    ->label('Опубликовать'),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('Логотип')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_PARTNER),
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
