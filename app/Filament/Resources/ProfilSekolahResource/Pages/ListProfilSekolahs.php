<?php

namespace App\Filament\Resources\ProfilSekolahResource\Pages;

use App\Filament\Resources\ProfilSekolahResource;
use App\Models\ProfilSekolah;
use Filament\Resources\Pages\ListRecords;

class ListProfilSekolahs extends ListRecords
{
    protected static string $resource = ProfilSekolahResource::class;

    public function mount(): void
    {
        $record = ProfilSekolah::first();
        if ($record) {
            $this->redirect(ProfilSekolahResource::getUrl('edit', ['record' => $record]));
        } else {
            $this->redirect(ProfilSekolahResource::getUrl('create'));
        }
    }
}
