<?php

namespace App\Services;

use App\Repositories\Contracts\NotifikasiRepositoryInterface;

class NotifikasiService
{
    public function __construct(private NotifikasiRepositoryInterface $repo) {}

    public function getAll(int $userId, int $perPage = 20)
    {
        return $this->repo->paginate($userId, $perPage);
    }

    public function countUnread(int $userId): int
    {
        return $this->repo->countUnread($userId);
    }

    public function markAsRead(int $id, int $userId): bool
    {
        return $this->repo->markAsRead($id, $userId);
    }

    public function markAllAsRead(int $userId): void
    {
        $this->repo->markAllAsRead($userId);
    }
}
