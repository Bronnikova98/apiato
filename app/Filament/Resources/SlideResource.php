<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Resources\SlideResource\Pages;
use App\Filament\Resources\SlideResource\RelationManagers;
use App\Containers\AppSection\Slides\Models\Slide;
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

class SlideResource extends Resource
{
    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([

                Forms\Components\BelongsToSelect::make('slider_id')
                    ->relationship('slider', 'title')
                    ->required(),

                TextInput::make('name')
                    ->maxLength(191)
                    ->required(),

                TextInput::make('url')
                    ->maxLength(255)
                    ->required(),


                TextInput::make('ordering')
                    ->numeric()
                    ->maxLength(255),

                Forms\Components\Toggle::make('is_publish'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_SLIDE),

            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('url')->limit(50),
                Tables\Columns\TextColumn::make('ordering'),
                Tables\Columns\IconColumn::make('is_publish'),
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
