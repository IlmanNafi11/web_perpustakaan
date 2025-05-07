<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Tables;
use App\Models\Member;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Pages\Actions\EditAction;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\MemberResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MemberResource\Pages\EditMember;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Filament\Resources\MemberResource\Pages\ListMembers;
use App\Filament\Resources\MemberResource\Pages\CreateMember;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?string $navigationLabel = 'Members';
    protected static ?string $navigationGroup = 'User Managements';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nik'),
                TextInput::make('attempt_count'),
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('status'),
                Select::make('is_locked')
                    ->options([
                        0,
                        1
                    ]),
                DateTimePicker::make('last_attempt_at'),
                FileUpload::make('pas_foto_path')
                    ->directory('pas-foto')
                    ->image(),
                FileUpload::make('ktp_path')
                    ->directory('ktp-image')
                    ->image(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('pas_foto_path')
                    ->label('Pas Foto')
                    ->circular(),
                TextColumn::make('user.name')
                    ->label('Name'),
                TextColumn::make('nik')
                    ->label('NIK'),
                TextColumn::make('user.phone')
                    ->label('Phone'),
                TextColumn::make('user.address')
                    ->label('Address'),
                TextColumn::make('status')
                    ->badge()
                    ->color(function ($record) {
                        return match ($record->status) {
                            'pending' => 'warning',
                            'approved' => 'success',
                            'rejected' => 'danger',
                        };
                    })
                    ->icon(function ($record) {
                        return match ($record->status) {
                            'pending' => 'heroicon-o-clock',
                            'approved' => 'heroicon-o-check-circle',
                            'rejected' => 'heroicon-o-x-circle',
                        };
                    }),
                TextColumn::make('attempt_count')
                    ->label('Number of attempts'),
                TextColumn::make('last_attempt_at')
                    ->label('Last attempt')

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('approved')
                        ->label('approved')
                        ->visible(function ($record) {
                            if ($record->status === 'pending' && $record->is_locked === 0) {
                                return true;
                            }
                            return false;
                        })
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->action(function ($record) {
                            Member::where('id', $record->id)->update(['status' => 'approved']);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Aproved')
                        ->modalDescription('Are you sure you want to approve the request? Make sure you double check the completeness of the request data'),
                    Action::make('rejected')
                        ->label('rejected')
                        ->visible(function ($record) {
                            if ($record->status === 'pending' && $record->is_locked === 0) {
                                return true;
                            }
                            return false;
                        })
                        ->color('danger')
                        ->icon('heroicon-o-x-circle')
                        ->action(function ($record) {
                            Member::where('id', $record->id)->update(['status' => 'rejected']);
                        })
                        ->requiresConfirmation()
                        ->modalHeading('Reject')
                        ->modalDescription('Are you sure you want to reject the request?'),
                    ViewAction::make(),
                    Action::make('unlocked')
                        ->label('Unblock')
                        ->visible(function ($record) {
                            if ($record->is_locked === 1) {
                                return true;
                            }
                            return false;
                        })
                        ->color('info'),
                    DeleteAction::make(),
                ])
                    ->label('More Action')
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
            'index' => Pages\ListMembers::route('/'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Group::make([
                    ImageEntry::make('pas_foto_path')
                        ->label('Pas Foto'),
                    ImageEntry::make('ktp_path')
                        ->label('KTP'),
                ]),
                Group::make([
                    TextEntry::make('user.name')
                        ->label('Name'),
                    TextEntry::make('nik')
                        ->label('NIK'),
                    TextEntry::make('user.email')
                        ->label('Email'),
                    TextEntry::make('user.phone')
                        ->label('Phone'),
                    TextEntry::make('user.address')
                        ->label('Address'),
                    TextEntry::make('attempt_count')
                        ->label('Number of attempts'),
                    TextEntry::make('last_attempt_at')
                        ->label('Last Attempt')
                        ->dateTime(),
                    TextEntry::make('is_locked')
                        ->label('Blocked')
                        ->formatStateUsing(function ($state) {
                            if ($state === 0) {
                                return 'No';
                            }
                            return 'Yes';
                        })
                        ->badge()
                        ->color(function ($state) {
                            if ($state === 0) {
                                return 'success';
                            }
                            return 'danger';
                        }),
                    TextEntry::make('status')
                        ->label('Status')
                        ->badge()
                        ->color(function ($record) {
                            return match ($record->status) {
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger',
                            };
                        })
                        ->icon(function ($record) {
                            return match ($record->status) {
                                'pending' => 'heroicon-o-clock',
                                'approved' => 'heroicon-o-check-circle',
                                'rejected' => 'heroicon-o-x-circle',
                            };
                        }),
                ])
                    ->columns(2),
            ])
            ->columns(2);
    }
}
