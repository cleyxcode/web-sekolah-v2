<?php

namespace App\Services;

use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\Contracts\ProfilSekolahRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ProfilSekolahService
{
    public function __construct(
        private ProfilSekolahRepositoryInterface $profilRepo,
        private BannerRepositoryInterface $bannerRepo,
    ) {}

    public function getProfil()
    {
        return Cache::remember('profil_sekolah', now()->addHours(6), fn() => $this->profilRepo->get());
    }

    public function getBanner()
    {
        return Cache::remember('banner_aktif', now()->addHours(3), fn() => $this->bannerRepo->allAktif());
    }
}
