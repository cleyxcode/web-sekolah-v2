<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\NotifikasiService;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function __construct(private NotifikasiService $service) {}

    public function index(Request $request)
    {
        return response()->json(
            $this->service->getAll($request->user()->id)
        );
    }

    public function unreadCount(Request $request)
    {
        return response()->json([
            'unread' => $this->service->countUnread($request->user()->id),
        ]);
    }

    public function baca(Request $request, $id)
    {
        $this->service->markAsRead($id, $request->user()->id);

        return response()->json(['message' => 'Notifikasi ditandai sudah dibaca.']);
    }

    public function bacaSemua(Request $request)
    {
        $this->service->markAllAsRead($request->user()->id);

        return response()->json(['message' => 'Semua notifikasi ditandai sudah dibaca.']);
    }
}
