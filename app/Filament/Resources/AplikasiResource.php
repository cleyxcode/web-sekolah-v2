<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AplikasiResource\Pages;
use App\Models\Aplikasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AplikasiResource extends Resource
{
    protected static ?string $model = Aplikasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationLabel = 'Aplikasi Android';

    protected static ?string $pluralLabel = 'Aplikasi Android';

    protected static ?string $modelLabel = 'Aplikasi';

    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Aplikasi')
                    ->schema([
                        Forms\Components\TextInput::make('nama_aplikasi')
                            ->label('Nama Aplikasi')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('versi')
                            ->label('Versi Aplikasi')
                            ->required()
                            ->placeholder('Contoh: 1.0.0')
                            ->maxLength(50),

                        Forms\Components\TextInput::make('ukuran_file')
                            ->label('Ukuran File')
                            ->placeholder('Contoh: 12.5 MB')
                            ->maxLength(50),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'aktif'    => 'Aktif',
                                'nonaktif' => 'Non Aktif',
                            ])
                            ->default('aktif')
                            ->required(),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi Aplikasi')
                            ->rows(4)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('File APK')
                    ->schema([
                        Forms\Components\FileUpload::make('file_apk')
                            ->label('Upload File APK')
                            ->required()
                            ->disk('public')
                            ->directory('aplikasi')
                            ->acceptedFileTypes(['application/vnd.android.package-archive', 'application/octet-stream'])
                            ->maxSize(102400) // 100 MB
                            ->helperText('Upload file .apk, maksimal 100 MB.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_aplikasi')
                    ->label('Nama Aplikasi')
                    ->searchable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('versi')
                    ->label('Versi')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\TextColumn::make('ukuran_file')
                    ->label('Ukuran'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'aktif',
                        'danger'  => 'nonaktif',
                    ]),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diunggah')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index'  => Pages\ListAplikasi::route('/'),
            'create' => Pages\CreateAplikasi::route('/create'),
            'edit'   => Pages\EditAplikasi::route('/{record}/edit'),
        ];
    }
}
