<?php

namespace App\Services;

use App\Repositories\Contracts\GuruRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class GuruService
{
    public function __construct(private GuruRepositoryInterface $repo) {}

    public function getAll()
    {
        return Cache::remember('guru_aktif', now()->addHours(3), fn() => $this->repo->allAktif());
    }
}
