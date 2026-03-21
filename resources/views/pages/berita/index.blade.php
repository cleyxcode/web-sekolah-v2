@extends('layouts.app')

@section('title', 'Berita & Pengumuman - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@section('content')

{{-- Hero Section --}}
<section class="bg-white dark:bg-slate-900 py-12 border-b border-slate-200 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 mb-4 text-sm font-medium text-slate-500 dark:text-slate-400">
            <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
            <span class="material-symbols-outlined text-xs">chevron_right</span>
            <span class="text-primary dark:text-slate-200">Berita</span>
        </div>
        <div class="max-w-3xl">
            <h1 class="text-primary text-4xl font-black leading-tight tracking-tight mb-4">
                Berita &amp; Pengumuman
            </h1>
            <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed">
                Pusat informasi resmi {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}. Temukan kabar terbaru mengenai kegiatan sekolah, prestasi siswa, dan pengumuman penting lainnya.
            </p>
        </div>
    </div>
</section>

{{-- Filter & Content --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Category Filters --}}
    <div class="flex flex-wrap items-center gap-3 mb-10">
        <a href="{{ route('berita') }}"
           class="px-5 py-2 rounded-full text-sm font-semibold shadow-sm transition-all
                  {{ !$kategori ? 'bg-primary text-white' : 'bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-primary hover:text-primary' }}">
            Semua
        </a>
        @foreach($kategoris as $kat)
            <a href="{{ route('berita', ['kategori' => $kat]) }}"
               class="px-5 py-2 rounded-full text-sm font-semibold shadow-sm transition-all
                      {{ $kategori === $kat ? 'bg-primary text-white' : 'bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 hover:border-primary hover:text-primary' }}">
                {{ $kat }}
            </a>
        @endforeach
    </div>

    {{-- News Grid --}}
    @if($beritas->isEmpty())
        <div class="text-center py-20 text-slate-400">
            <span class="material-symbols-outlined text-6xl mb-4 block">article</span>
            <p class="text-lg">Belum ada berita yang dipublikasikan{{ $kategori ? ' dalam kategori ini' : '' }}.</p>
            @if($kategori)
                <a href="{{ route('berita') }}" class="mt-4 inline-block text-primary font-bold hover:underline">
                    Lihat semua berita
                </a>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger">
            @foreach($beritas as $berita)
                @php
                    $badgeColor = match(strtolower($berita->kategori ?? '')) {
                        'prestasi'     => 'bg-green-600',
                        'kegiatan'     => 'bg-orange-500',
                        'pengumuman'   => 'bg-primary/90',
                        'pendidikan'   => 'bg-blue-600',
                        default        => 'bg-primary/90',
                    };
                @endphp
                <article class="bg-white dark:bg-slate-900 rounded-xl overflow-hidden shadow-sm card-lift flex flex-col border border-slate-100 dark:border-slate-800 reveal">
                    {{-- Gambar --}}
                    <div class="relative h-48 w-full overflow-hidden">
                        @if($berita->gambar)
                            <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 hover:scale-105"
                                 style="background-image: url('{{ asset('storage/' . $berita->gambar) }}');"></div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-primary to-primary/60 flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-6xl">article</span>
                            </div>
                        @endif
                        @if($berita->kategori)
                            <div class="absolute top-4 left-4">
                                <span class="{{ $badgeColor }} backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                    {{ $berita->kategori }}
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Konten --}}
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-slate-400 text-xs mb-3">
                            <span class="material-symbols-outlined text-sm mr-1">calendar_today</span>
                            {{ $berita->tanggal_publish
                                ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y')
                                : $berita->created_at->translatedFormat('d F Y') }}
                        </div>

                        <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-3 line-clamp-2 hover:text-primary cursor-pointer transition-colors">
                            <a href="{{ route('berita.show', $berita->id) }}">{{ $berita->judul }}</a>
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 line-clamp-3 leading-relaxed">
                            {{ Str::limit(strip_tags($berita->isi), 150) }}
                        </p>

                        <div class="mt-auto pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a class="text-primary font-bold text-sm inline-flex items-center group"
                               href="{{ route('berita.show', $berita->id) }}">
                                Baca Selengkapnya
                                <span class="material-symbols-outlined text-sm ml-1 group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($beritas->hasPages())
            <nav class="flex items-center justify-center gap-2 mt-16 border-t border-slate-200 dark:border-slate-800 pt-8">
                {{-- Prev --}}
                @if($beritas->onFirstPage())
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-300 cursor-not-allowed">
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </span>
                @else
                    <a href="{{ $beritas->previousPageUrl() }}"
                       class="flex h-10 w-10 items-center justify-center rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-600 hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined text-lg">chevron_left</span>
                    </a>
                @endif

                {{-- Pages --}}
                @foreach($beritas->getUrlRange(1, $beritas->lastPage()) as $page => $url)
                    @if($page == $beritas->currentPage())
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-primary text-white text-sm font-bold shadow-sm">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="flex h-10 w-10 items-center justify-center rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm font-medium hover:bg-slate-50 transition-colors">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                {{-- Next --}}
                @if($beritas->hasMorePages())
                    <a href="{{ $beritas->nextPageUrl() }}"
                       class="flex h-10 w-10 items-center justify-center rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-600 hover:bg-slate-50 transition-colors">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </a>
                @else
                    <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 text-slate-300 cursor-not-allowed">
                        <span class="material-symbols-outlined text-lg">chevron_right</span>
                    </span>
                @endif
            </nav>
        @endif
    @endif

</section>

@endsection
