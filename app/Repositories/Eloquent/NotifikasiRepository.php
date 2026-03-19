<?php

namespace App\Repositories\Eloquent;

use App\Models\Notifikasi;
use App\Repositories\Contracts\NotifikasiRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class NotifikasiRepository implements NotifikasiRepositoryInterface
{
    public function paginate(int $userId, int $perPage = 20): LengthAwarePaginator
    {
        return Notifikasi::where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }

    public function countUnread(int $userId): int
    {
        return Notifikasi::where('user_id', $userId)
            ->where('dibaca', false)
            ->count();
    }

    public function markAsRead(int $id, int $userId): bool
    {
        $notifikasi = Notifikasi::where('id', $id)
            ->where('user_id', $userId)
            ->firstOrFail();

        return $notifikasi->update(['dibaca' => true]);
    }

    public function markAllAsRead(int $userId): void
    {
        Notifikasi::where('user_id', $userId)
            ->where('dibaca', false)
            ->update(['dibaca' => true]);
    }
}
