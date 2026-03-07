<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilSekolahResource\Pages;
use App\Models\ProfilSekolah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfilSekolahResource extends Resource
{
    protected static ?string $model = ProfilSekolah::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Profil Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas')
                    ->schema([
                        Forms\Components\TextInput::make('nama_sekolah')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('kepala_sekolah'),
                        Forms\Components\Select::make('akreditasi')
                            ->options(['A' => 'A', 'B' => 'B', 'C' => 'C']),
                        Forms\Components\TextInput::make('tahun_berdiri'),
                        Forms\Components\TextInput::make('jumlah_ruang_kelas')
                            ->numeric(),
                    ])->columns(2),

                Forms\Components\Section::make('Visi Misi')
                    ->schema([
                        Forms\Components\Textarea::make('visi')->rows(3),
                        Forms\Components\Textarea::make('misi')->rows(3),
                        Forms\Components\Textarea::make('sejarah')->rows(5)->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak')
                    ->schema([
                        Forms\Components\Textarea::make('alamat')->rows(3),
                        Forms\Components\TextInput::make('kontak'),
                    ])->columns(2),

                Forms\Components\Section::make('Logo')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->disk('public')
                            ->directory('profil'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_sekolah')->searchable(),
                Tables\Columns\TextColumn::make('kepala_sekolah')->searchable(),
                Tables\Columns\TextColumn::make('akreditasi'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getNavigationUrl(): string
    {
        $record = ProfilSekolah::first();
        if ($record) {
            return static::getUrl('edit', ['record' => $record]);
        }
        return static::getUrl('create');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfilSekolahs::route('/'),
            'create' => Pages\CreateProfilSekolah::route('/create'),
            'edit' => Pages\EditProfilSekolah::route('/{record}/edit'),
        ];
    }
}
