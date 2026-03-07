<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoPendaftaranResource\Pages;
use App\Models\InfoPendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InfoPendaftaranResource extends Resource
{
    protected static ?string $model = InfoPendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Info Pendaftaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('tahun_ajaran')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_buka')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_tutup')
                    ->required(),
                Forms\Components\TextInput::make('kuota')
                    ->numeric()
                    ->required(),
                Forms\Components\Textarea::make('syarat')
                    ->rows(6)
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'aktif' => 'Aktif',
                        'nonaktif' => 'Non Aktif',
                    ])
                    ->default('nonaktif')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tahun_ajaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_buka')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_tutup')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kuota')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'aktif',
                        'danger' => 'nonaktif',
                    ]),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInfoPendaftarans::route('/'),
            'create' => Pages\CreateInfoPendaftaran::route('/create'),
            'edit' => Pages\EditInfoPendaftaran::route('/{record}/edit'),
        ];
    }
}
