<?php

namespace App\Filament\Resources;

use App\Models\MediaFile;
use Filament\Forms\Set;
use App\Models\Book;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Pages\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\BookResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BookResource\Pages\EditBook;
use App\Filament\Resources\BookResource\Pages\ListBooks;
use App\Filament\Resources\BookResource\Pages\CreateBook;
use App\Filament\Resources\BookResource\RelationManagers;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use function Illuminate\Log\log;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;
    protected static ?string $navigationLabel = 'Books and Ebooks';
    protected static ?string $label = 'Books and E-books';
    protected static ?string $navigationGroup = 'Library Collection';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->placeholder('Enter book title'),
                TextInput::make('author')
                    ->label('Author')
                    ->placeholder('Enter book author'),
                TextInput::make('isbn')
                    ->label('ISBN')
                    ->placeholder('Enter the ISBN code'),
                Textarea::make('descriptions')
                    ->label('Descriptions')
                    ->placeholder('Enter book description/sinopsis'),
                TextInput::make('quantity')
                    ->label('Quantity')
                    ->placeholder('Enter the quantity of books'),
                TextInput::make('year')
                    ->label('Publication Year')
                    ->placeholder('Enter the year the book was published'),
                TextInput::make('publisher')
                    ->label('Publisher')
                    ->placeholder('Enter the name of the book publisher'),
                Select::make('language')
                    ->label('Language')
                    ->options([
                        'indonesia' => 'Indonesia',
                        'english' =>'English',
                        'malaysia' =>'Malaysia',
                        'arabic' =>'Arabic',
                    ]),
                Select::make('type')
                    ->label('Type')
                    ->options([
                        'phisical book' => "Physical Book",
                        'ebook' => "E-Book",
                    ])
                    ->live(false, 500),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Category'),
                FileUpload::make('cover')
                    ->label('Book Cover')
                    ->afterStateHydrated(function (?Book $record, ?Set $set) {
                        if (!empty($record)) {
                            $filePath = MediaFile::where('book_id', $record->id)->where('media_type', 'cover image')->pluck('file_path')->toArray();
                            $set('cover', $filePath);
                        }
                    })
                    ->image()
                    ->directory('book-cover')
                    ->previewable(),
                FileUpload::make('ebook')
                    ->hidden(function (Get $get) {
                        if ($get('type') == 1) {
                            return false;
                        }
                        return true;
                    })
                    ->label('E Book File')
                    ->directory('ebook-files')
                    ->acceptedFileTypes(['application/pdf'])
                    ->afterStateHydrated(function(?Book $record, ?Set $set) {
                        if (!empty($record)) {
                            $filePath = MediaFile::where('book_id', $record->id)->where('media_type', 'ebook file')->pluck('file_path')->toArray();
                            $set('ebook', $filePath);
                        }
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('mediaFiles.file_path')
                    ->label('Cover')
                    ->state(function($record) {
                        return MediaFile::where('book_id', $record['id'])->where('media_type', 'cover image')->pluck('file_path')->toArray();
                    }),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),
                TextColumn::make('author')
                    ->label('Author')
                    ->searchable(),
                TextColumn::make('isbn')
                    ->label('ISBN')
                    ->searchable(),
                TextColumn::make('quantity')
                    ->label('Stock')
                    ->sortable(),
                TextColumn::make('publisher')
                    ->label('Publisher')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
