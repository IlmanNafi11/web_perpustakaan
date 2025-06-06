<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BorrowRecordResource\Pages;
use App\Filament\Resources\BorrowRecordResource\RelationManagers;
use App\Models\BorrowRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BorrowRecordResource extends Resource
{
    protected static ?string $model = BorrowRecord::class;
    protected static ?string $navigationLabel = 'Loan Record';
    protected static ?string $label = 'Loan Records';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListBorrowRecords::route('/'),
            'create' => Pages\CreateBorrowRecord::route('/create'),
            'edit' => Pages\EditBorrowRecord::route('/{record}/edit'),
        ];
    }
}
