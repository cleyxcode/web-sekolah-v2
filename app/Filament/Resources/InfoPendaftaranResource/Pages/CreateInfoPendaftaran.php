<?php

namespace App\Filament\Resources\InfoPendaftaranResource\Pages;

use App\Filament\Resources\InfoPendaftaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreateInfoPendaftaran extends CreateRecord
{
    protected static string $resource = InfoPendaftaranResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }
}
