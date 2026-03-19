<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AplikasiController extends Controller
{
    public function index()
    {
        $aplikasiAktif = Aplikasi::where('status', 'aktif')
            ->latest()
            ->first();

        $riwayat = Aplikasi::where('status', 'aktif')
            ->latest()
            ->get();

        return view('pages.download-aplikasi', compact('aplikasiAktif', 'riwayat'));
    }

    public function download($id): BinaryFileResponse
    {
        $aplikasi = Aplikasi::findOrFail($id);

        $path = Storage::disk('public')->path($aplikasi->file_apk);

        abort_unless(file_exists($path), 404, 'File tidak ditemukan.');

        $filename = 'SDN-Warialau-v' . $aplikasi->versi . '.apk';

        return response()->download($path, $filename);
    }
}
