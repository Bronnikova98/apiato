<?php

namespace App\Filament\Resources;

use App\Enums\MediaCollectionEnum;
use App\Filament\Components\CustomImageUpload;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Containers\AppSection\Posts\Models\Post;
use Closure;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
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
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)->schema([
                TextInput::make('title')
                    ->label('Заголовок')
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

                DateTimePicker::make('date')
                    ->label('Дата публикации')
                    ->displayFormat('j F Y, H:i:s')
                    ->format('Y-m-d H:i:s')
                    ->required()
                    ->default(now()),

                TextInput::make('short_description')
                    ->label('Краткое описание')
                    ->maxLength(191)
                    ->required(),

                Toggle::make('is_publish')
                    ->label('Опубликовать'),
            ]),

            Grid::make(1)->schema([
                RichEditor::make('text')
                    ->label('Текст новости')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->maxLength(65535)
                    ->required(),
            ]),

            Grid::make(2)->schema([
                CustomImageUpload::make('thumbnail')
                    ->label('Превью')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_POST)
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg'])
                    ->helperText('Максимальный размер: 5Мб. Допустимые типы: .png, .jpg, .jpeg'),
            ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->toggleable(),
                TextColumn::make('title')
                    ->limit(25)
                    ->label('Заголовок'),
                TextColumn::make('date')
                    ->label('Дата публикации'),
                TextColumn::make('short_description')
                    ->limit(25)
                    ->label('Описание'),
                BooleanColumn::make('is_publish')
                    ->label('Опубликовать'),
                SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->label('Превью')
                    ->collection(MediaCollectionEnum::MEDIA_COLLECTION_POST),
            ])
            ->DefaultSort('date', 'desc')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
