<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Pendaftaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Status Pendaftaran')
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'diterima' => 'Diterima',
                                'ditolak' => 'Ditolak',
                            ])
                            ->required(),
                    ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Data Anak')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama_anak'),
                        Infolists\Components\TextEntry::make('tempat_lahir'),
                        Infolists\Components\TextEntry::make('tanggal_lahir')->date(),
                        Infolists\Components\TextEntry::make('jenis_kelamin'),
                        Infolists\Components\TextEntry::make('agama'),
                        Infolists\Components\TextEntry::make('anak_ke'),
                        Infolists\Components\TextEntry::make('asal_sekolah'),
                        Infolists\Components\TextEntry::make('nik'),
                        Infolists\Components\TextEntry::make('no_kk'),
                    ])->columns(3),

                Infolists\Components\Section::make('Alamat')
                    ->schema([
                        Infolists\Components\TextEntry::make('alamat')->columnSpanFull(),
                    ]),

                Infolists\Components\Section::make('Data Orang Tua')
                    ->schema([
                        Infolists\Components\TextEntry::make('nama_ayah'),
                        Infolists\Components\TextEntry::make('pekerjaan_ayah'),
                        Infolists\Components\TextEntry::make('nama_ibu'),
                        Infolists\Components\TextEntry::make('pekerjaan_ibu'),
                        Infolists\Components\TextEntry::make('nama_wali'),
                        Infolists\Components\TextEntry::make('no_hp'),
                    ])->columns(3),

                Infolists\Components\Section::make('Dokumen')
                    ->schema([
                        Infolists\Components\TextEntry::make('dokumen'),
                    ]),

                Infolists\Components\Section::make('Status Pendaftaran')
                    ->schema([
                        Infolists\Components\BadgeEntry::make('status')
                            ->colors([
                                'warning' => 'pending',
                                'success' => 'diterima',
                                'danger' => 'ditolak',
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_anak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_ayah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'diterima',
                        'danger' => 'ditolak',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarans::route('/'),
            'view' => Pages\ViewPendaftaran::route('/{record}'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
        ];
    }
}
