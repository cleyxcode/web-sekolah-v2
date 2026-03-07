<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Pages\Page as ResourcePage;

class EditAllSettings extends ResourcePage implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = SettingResource::class;

    protected static string $view = 'filament.resources.setting-resource.pages.edit-all-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pengaturan')
                    ->tabs([
                        Tabs\Tab::make('Tampilan Web')
                            ->schema([
                                FileUpload::make('logo')
                                    ->label('Logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                FileUpload::make('background')
                                    ->label('Background')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                FileUpload::make('favicon')
                                    ->label('Favicon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                            ]),
                        Tabs\Tab::make('Info Sekolah')
                            ->schema([
                                Textarea::make('alamat_sekolah')->label('Alamat Sekolah'),
                                TextInput::make('no_telp')->label('No. Telepon'),
                                TextInput::make('email_sekolah')->label('Email Sekolah'),
                            ]),
                        Tabs\Tab::make('Media Sosial')
                            ->schema([
                                TextInput::make('facebook_url')->label('Facebook URL'),
                                TextInput::make('instagram_url')->label('Instagram URL'),
                            ]),
                        Tabs\Tab::make('Lokasi')
                            ->schema([
                                Textarea::make('maps_embed')
                                    ->label('Google Maps Embed')
                                    ->helperText('Paste iframe Google Maps di sini'),
                            ]),
                    ])->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
