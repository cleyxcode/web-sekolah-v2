<?php

namespace App\Filament\Resources\AplikasiResource\Pages;

use App\Filament\Resources\AplikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAplikasi extends ListRecords
{
    protected static string $resource = AplikasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
