<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Pengaturan')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Tampilan Web')
                            ->schema([
                                Forms\Components\FileUpload::make('logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                Forms\Components\FileUpload::make('background')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                Forms\Components\FileUpload::make('favicon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Info Sekolah')
                            ->schema([
                                Forms\Components\Textarea::make('alamat_sekolah'),
                                Forms\Components\TextInput::make('no_telp'),
                                Forms\Components\TextInput::make('email_sekolah'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Media Sosial')
                            ->schema([
                                Forms\Components\TextInput::make('facebook_url'),
                                Forms\Components\TextInput::make('instagram_url'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Lokasi')
                            ->schema([
                                Forms\Components\Textarea::make('maps_embed')
                                    ->helperText('Paste iframe Google Maps di sini'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getNavigationUrl(): string
    {
        return static::getUrl('edit-all');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'edit-all' => Pages\EditAllSettings::route('/edit-all'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
