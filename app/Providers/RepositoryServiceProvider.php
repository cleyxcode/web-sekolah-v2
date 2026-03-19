<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Contracts
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BeritaRepositoryInterface;
use App\Repositories\Contracts\GaleriRepositoryInterface;
use App\Repositories\Contracts\GuruRepositoryInterface;
use App\Repositories\Contracts\ProfilSekolahRepositoryInterface;
use App\Repositories\Contracts\BannerRepositoryInterface;
use App\Repositories\Contracts\InfoPendaftaranRepositoryInterface;
use App\Repositories\Contracts\PendaftaranRepositoryInterface;
use App\Repositories\Contracts\NotifikasiRepositoryInterface;

// Eloquent Implementations
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\BeritaRepository;
use App\Repositories\Eloquent\GaleriRepository;
use App\Repositories\Eloquent\GuruRepository;
use App\Repositories\Eloquent\ProfilSekolahRepository;
use App\Repositories\Eloquent\BannerRepository;
use App\Repositories\Eloquent\InfoPendaftaranRepository;
use App\Repositories\Eloquent\PendaftaranRepository;
use App\Repositories\Eloquent\NotifikasiRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,           UserRepository::class);
        $this->app->bind(BeritaRepositoryInterface::class,         BeritaRepository::class);
        $this->app->bind(GaleriRepositoryInterface::class,         GaleriRepository::class);
        $this->app->bind(GuruRepositoryInterface::class,           GuruRepository::class);
        $this->app->bind(ProfilSekolahRepositoryInterface::class,  ProfilSekolahRepository::class);
        $this->app->bind(BannerRepositoryInterface::class,         BannerRepository::class);
        $this->app->bind(InfoPendaftaranRepositoryInterface::class, InfoPendaftaranRepository::class);
        $this->app->bind(PendaftaranRepositoryInterface::class,    PendaftaranRepository::class);
        $this->app->bind(NotifikasiRepositoryInterface::class,     NotifikasiRepository::class);
    }
}
