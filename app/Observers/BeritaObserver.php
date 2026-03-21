<?php

namespace App\Observers;

use App\Models\Berita;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class BeritaObserver
{
    /**
     * Saat berita diupdate: jika status berubah menjadi 'publish',
     * buat notifikasi untuk semua user orangtua.
     */
    public function updated(Berita $berita): void
    {
        // Invalidasi cache berita saat ada perubahan
        Cache::forget("berita_{$berita->id}");
        Cache::forget('berita_latest_5');
        Cache::forget('berita_latest_3');

        if ($berita->wasChanged('status') && $berita->status === 'publish') {
            $orangtua = User::where('role', 'orangtua')->pluck('id');

            $notifikasi = $orangtua->map(fn($userId) => [
                'user_id'      => $userId,
                'judul'        => 'Berita Baru',
                'pesan'        => 'Berita baru telah diterbitkan: ' . $berita->judul,
                'tipe'         => 'berita',
                'referensi_id' => $berita->id,
                'dibaca'       => false,
                'created_at'   => now(),
                'updated_at'   => now(),
            ])->toArray();

            Notifikasi::insert($notifikasi);
        }
    }

    public function created(Berita $berita): void
    {
        Cache::forget('berita_latest_5');
        Cache::forget('berita_latest_3');
    }

    public function deleted(Berita $berita): void
    {
        Cache::forget("berita_{$berita->id}");
        Cache::forget('berita_latest_5');
        Cache::forget('berita_latest_3');
    }
}
