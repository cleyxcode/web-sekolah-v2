<?php

namespace App\Filament\Resources\InfoPendaftaranResource\Pages;

use App\Filament\Resources\InfoPendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInfoPendaftaran extends EditRecord
{
    protected static string $resource = InfoPendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
