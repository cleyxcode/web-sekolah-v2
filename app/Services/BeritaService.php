<?php

namespace App\Services;

use App\Repositories\Contracts\BeritaRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class BeritaService
{
    public function __construct(private BeritaRepositoryInterface $repo) {}

    public function getAll(int $perPage = 10)
    {
        // Paginated → cache per page number, TTL pendek agar berita baru cepat muncul
        $page = request()->get('page', 1);
        return Cache::remember("berita_page_{$page}_per{$perPage}", now()->addMinutes(10), fn() => $this->repo->paginate($perPage));
    }

    public function getById(int $id)
    {
        return Cache::remember("berita_{$id}", now()->addHours(1), fn() => $this->repo->find($id));
    }

    public function getLatest(int $limit = 5)
    {
        return Cache::remember("berita_latest_{$limit}", now()->addMinutes(15), fn() => $this->repo->latest($limit));
    }
}
