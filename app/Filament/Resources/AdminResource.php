<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Pages\Actions\EditAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\AdminResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AdminResource\Pages\EditAdmin;
use App\Filament\Resources\AdminResource\Pages\ListAdmins;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Filament\Resources\AdminResource\Pages\CreateAdmin;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class AdminResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $label = 'Admin'; 
    protected static ?string $navigationLabel = 'Admins';
    protected static ?string $navigationGroup = 'User Managements';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Name')
                ->placeholder('Enter Name'),
                TextInput::make('email')
                ->label('Email')
                ->placeholder('Enter Email')
                ->email(),
                TextInput::make('phone')
                ->label('Phone Number')
                ->placeholder('Enter Phone Number'),
                TextInput::make('address')
                ->label('Full Address')
                ->placeholder('Enter full address'),
                TextInput::make('password')
                ->label('Password')
                ->placeholder('Enter Password')
                ->password()
                ->revealable(),
                FileUpload::make('photo_path')
                ->label('Photo')
                ->image()
                ->lazy()
                ->directory('profile-image')
                ->previewable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable(),
                TextColumn::make('email')
                ->searchable(),
                TextColumn::make('phone')
                ->searchable(),
                TextColumn::make('address'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->button(),
                DeleteAction::make()
                ->button(),
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
