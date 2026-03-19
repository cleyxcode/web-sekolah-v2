<?php

namespace App\Filament\Widgets;

use App\Models\Aplikasi;
use App\Models\Berita;
use App\Models\Guru;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Guru Aktif', Guru::where('status', 'aktif')->count())
                ->icon('heroicon-o-academic-cap')
                ->color('success'),

            Stat::make('Total Siswa Aktif', Siswa::where('status', 'aktif')->count())
                ->icon('heroicon-o-users')
                ->color('info'),

            Stat::make('Pendaftaran Pending', Pendaftaran::where('status', 'pending')->count())
                ->icon('heroicon-o-document-text')
                ->color('warning'),

            Stat::make('Berita Tayang', Berita::where('status', 'publish')->count())
                ->icon('heroicon-o-newspaper')
                ->color('primary'),

            Stat::make('Aplikasi Android', Aplikasi::where('status', 'aktif')->count())
                ->icon('heroicon-o-device-phone-mobile')
                ->color('danger')
                ->description('Versi aktif tersedia'),
        ];
    }
}
