<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface NotifikasiRepositoryInterface
{
    public function paginate(int $userId, int $perPage = 20): LengthAwarePaginator;
    public function countUnread(int $userId): int;
    public function markAsRead(int $id, int $userId): bool;
    public function markAllAsRead(int $userId): void;
}
