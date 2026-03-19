<?php

namespace App\Filament\Resources\AplikasiResource\Pages;

use App\Filament\Resources\AplikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAplikasi extends EditRecord
{
    protected static string $resource = AplikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
