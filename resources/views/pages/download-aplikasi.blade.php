@extends('layouts.app')

@section('title', 'Download Aplikasi — ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
@keyframes fadeUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
@keyframes pulse-ring {
    0%   { transform: scale(1);   opacity: .6; }
    100% { transform: scale(1.4); opacity: 0;  }
}
.reveal { opacity:0; transform:translateY(24px); transition:opacity .5s ease, transform .5s ease; }
.reveal.visible { opacity:1; transform:translateY(0); }
.stagger > *:nth-child(1){transition-delay:.0s}
.stagger > *:nth-child(2){transition-delay:.1s}
.stagger > *:nth-child(3){transition-delay:.2s}
.stagger > *:nth-child(4){transition-delay:.3s}
.card-lift { transition:transform .25s ease, box-shadow .25s ease; }
.card-lift:hover { transform:translateY(-4px); box-shadow:0 16px 40px rgba(31,59,97,.12); }
.pulse-ring::before {
    content: '';
    position: absolute;
    inset: -8px;
    border-radius: 9999px;
    border: 2px solid #d4af37;
    animation: pulse-ring 1.8s ease-out infinite;
}
</style>
@endpush

@section('content')

{{-- ════════ PAGE HEADER ════════ --}}
<section class="relative bg-gradient-to-br from-primary to-primary/85 pt-24 pb-16 overflow-hidden">
    {{-- Decorative blobs --}}
    <div class="absolute top-0 right-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-2xl translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 px-4 py-1.5 rounded-full text-xs font-semibold mb-6">
            <span class="material-symbols-outlined text-sm text-accent">android</span>
            Aplikasi Mobile
        </div>
        <h1 class="text-3xl md:text-5xl font-black text-white mb-4 leading-tight">
            Download Aplikasi Android
        </h1>
        <p class="text-slate-300 max-w-xl mx-auto text-sm md:text-base">
            Akses informasi sekolah, pantau pendaftaran, dan terima notifikasi langsung di smartphone Anda.
        </p>
    </div>
</section>

{{-- ════════ MAIN CONTENT ════════ --}}
<section class="py-16 bg-background-light dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($aplikasiAktif)
        {{-- ── DOWNLOAD CARD UTAMA ── --}}
        <div class="reveal mb-16">
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 overflow-hidden max-w-4xl mx-auto">

                {{-- Header kartu --}}
                <div class="bg-gradient-to-r from-primary to-primary/80 p-8 md:p-10 flex flex-col md:flex-row items-center gap-8">
                    {{-- Icon Android --}}
                    <div class="relative shrink-0">
                        <div class="relative w-28 h-28 rounded-3xl bg-white/15 border-2 border-white/30 flex items-center justify-center pulse-ring">
                            <span class="material-symbols-outlined text-white text-6xl" style="font-variation-settings:'FILL' 1">android</span>
                        </div>
                    </div>

                    {{-- Info aplikasi --}}
                    <div class="flex-1 text-center md:text-left">
                        <div class="inline-flex items-center gap-1.5 bg-accent/20 text-accent border border-accent/30 px-3 py-1 rounded-full text-xs font-bold mb-3">
                            <span class="material-symbols-outlined text-sm">verified</span>
                            Versi Terbaru
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black text-white mb-2">
                            {{ $aplikasiAktif->nama_aplikasi }}
                        </h2>
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 text-sm text-white/70">
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-base text-accent">tag</span>
                                Versi {{ $aplikasiAktif->versi }}
                            </span>
                            @if($aplikasiAktif->ukuran_file)
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-base text-accent">save</span>
                                {{ $aplikasiAktif->ukuran_file }}
                            </span>
                            @endif
                            <span class="flex items-center gap-1">
                                <span class="material-symbols-outlined text-base text-accent">calendar_today</span>
                                {{ $aplikasiAktif->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    {{-- Tombol download --}}
                    <div class="shrink-0">
                        <a href="{{ route('aplikasi.download', $aplikasiAktif->id) }}"
                           class="inline-flex flex-col items-center gap-2 bg-accent hover:bg-accent/90 active:scale-95 text-primary font-black px-8 py-5 rounded-2xl shadow-lg shadow-accent/30 transition-all">
                            <span class="material-symbols-outlined text-3xl" style="font-variation-settings:'FILL' 1">download</span>
                            <span class="text-sm">Download APK</span>
                        </a>
                    </div>
                </div>

                {{-- Deskripsi --}}
                @if($aplikasiAktif->deskripsi)
                <div class="p-8 md:p-10 border-b border-slate-100 dark:border-slate-800">
                    <h3 class="text-base font-bold text-slate-800 dark:text-white mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">description</span>
                        Tentang Aplikasi
                    </h3>
                    <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed whitespace-pre-line">{{ $aplikasiAktif->deskripsi }}</p>
                </div>
                @endif

                {{-- Cara pasang --}}
                <div class="p-8 md:p-10">
                    <h3 class="text-base font-bold text-slate-800 dark:text-white mb-5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">install_mobile</span>
                        Cara Memasang Aplikasi
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 stagger">
                        @foreach([
                            ['download',       'Unduh File APK', 'Tekan tombol Download APK di atas'],
                            ['folder_open',    'Buka File',      'Buka File Manager, cari file APK yang diunduh'],
                            ['security',       'Izinkan Sumber', 'Aktifkan "Sumber Tidak Dikenal" di Pengaturan → Keamanan'],
                            ['check_circle',   'Pasang & Buka',  'Ketuk file APK dan ikuti proses pemasangan'],
                        ] as $step)
                        <div class="reveal flex flex-col items-center text-center p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50">
                            <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center mb-3">
                                <span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings:'FILL' 1">{{ $step[0] }}</span>
                            </div>
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200 mb-1">{{ $step[1] }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $step[2] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- ── FITUR APLIKASI ── --}}
        <div class="reveal mb-16">
            <div class="text-center mb-10">
                <h2 class="text-2xl md:text-3xl font-black text-primary dark:text-white mb-3">Fitur Aplikasi</h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm">Semua kebutuhan informasi sekolah dalam satu aplikasi</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 stagger">
                @foreach([
                    ['newspaper',        'Berita & Pengumuman',   'Dapatkan informasi terbaru dari sekolah langsung di genggaman Anda.'],
                    ['photo_library',    'Galeri Kegiatan',       'Lihat foto-foto kegiatan dan momen berharga di sekolah.'],
                    ['how_to_reg',       'Pendaftaran Online',    'Daftarkan anak Anda secara online tanpa perlu datang ke sekolah.'],
                    ['notifications',    'Notifikasi Real-time',  'Terima pemberitahuan saat status pendaftaran berubah.'],
                    ['school',           'Profil Sekolah',        'Informasi lengkap tentang sekolah, visi misi, dan sejarah.'],
                    ['manage_accounts',  'Kelola Akun',           'Atur informasi akun dan kata sandi dengan mudah.'],
                ] as $fitur)
                <div class="reveal card-lift bg-white dark:bg-slate-900 rounded-xl p-6 border border-slate-100 dark:border-slate-800 shadow-sm flex gap-4">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings:'FILL' 1">{{ $fitur[0] }}</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 dark:text-white text-sm mb-1">{{ $fitur[1] }}</h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">{{ $fitur[2] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ── SEMUA VERSI ── --}}
        @if($riwayat->count() > 1)
        <div class="reveal">
            <h2 class="text-xl font-black text-primary dark:text-white mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined">history</span>
                Riwayat Versi
            </h2>
            <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach($riwayat as $apk)
                    <div class="flex items-center gap-4 px-6 py-4">
                        <div class="w-9 h-9 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-primary text-base">android</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ $apk->nama_aplikasi }}</p>
                            <p class="text-xs text-slate-400">{{ $apk->created_at->format('d M Y') }}
                                @if($apk->ukuran_file) · {{ $apk->ukuran_file }} @endif
                            </p>
                        </div>
                        <span class="px-2.5 py-1 bg-primary/10 text-primary dark:text-blue-300 rounded-lg text-xs font-bold shrink-0">
                            v{{ $apk->versi }}
                        </span>
                        @if($apk->id === $aplikasiAktif->id)
                            <span class="px-2.5 py-1 bg-accent/20 text-yellow-700 dark:text-accent rounded-lg text-xs font-bold shrink-0">Terbaru</span>
                        @else
                            <a href="{{ route('aplikasi.download', $apk->id) }}"
                               class="flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-500 hover:text-primary hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors shrink-0">
                                <span class="material-symbols-outlined text-sm">download</span>
                                Unduh
                            </a>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @else
        {{-- ── TIDAK ADA APLIKASI ── --}}
        <div class="text-center py-24">
            <div class="w-24 h-24 rounded-3xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-slate-400 text-5xl">android</span>
            </div>
            <h3 class="text-xl font-bold text-slate-700 dark:text-slate-300 mb-2">Aplikasi Belum Tersedia</h3>
            <p class="text-slate-400 text-sm max-w-sm mx-auto">Aplikasi Android sedang dalam tahap pengembangan. Pantau terus halaman ini untuk pembaruan.</p>
        </div>
        @endif

    </div>
</section>

@endsection

@push('scripts')
<script>
(function () {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
})();
</script>
@endpush
