@extends('layouts.app')

@section('title', 'Daftar Guru - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
.guru-card { transition: transform .3s cubic-bezier(.22,1,.36,1), box-shadow .3s ease, border-color .3s ease; }
.guru-card:hover { transform: translateY(-8px) scale(1.02); box-shadow: 0 24px 56px rgba(31,59,97,.15); border-color: rgba(31,59,97,.25); }
.guru-card:hover .avatar-ring { transform: scale(1.15); border-color: #d4af37; }
.avatar-ring { transition: transform .35s cubic-bezier(.22,1,.36,1), border-color .3s ease; }
.guru-card:hover .avatar-inner img,
.guru-card:hover .avatar-inner div { transform: scale(1.08); }
.avatar-inner img, .avatar-inner div { transition: transform .35s cubic-bezier(.22,1,.36,1); }
</style>
@endpush

@section('content')

{{-- Hero --}}
<section class="relative bg-gradient-to-br from-primary via-primary/90 to-primary/80 py-20 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-8 right-16 w-64 h-64 bg-accent/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-8 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 px-4 py-1.5 rounded-full text-xs font-semibold mb-5 reveal">
            <span class="material-symbols-outlined text-sm text-accent">academic_cap</span>
            Tenaga Pendidik
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight reveal">
            Guru & Tenaga Pengajar
        </h1>
        <p class="text-slate-300 max-w-2xl mx-auto text-base md:text-lg reveal">
            Mengenal lebih dekat para pendidik profesional kami yang berdedikasi tinggi mencerdaskan generasi bangsa.
        </p>
        <div class="flex items-center justify-center gap-2 mt-6 reveal">
            <a href="{{ route('home') }}" class="text-white/60 hover:text-white text-sm font-medium transition-colors">Beranda</a>
            <span class="material-symbols-outlined text-xs text-white/40">chevron_right</span>
            <span class="text-accent text-sm font-semibold">Guru</span>
        </div>
    </div>
</section>

{{-- Grid --}}
<section class="py-20 bg-background-light dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4">

        @if($gurus->isEmpty())
        <div class="text-center py-24 reveal">
            <lottie-player
                src="https://assets5.lottiefiles.com/packages/lf20_wnqlfojb.json"
                background="transparent" speed="1"
                style="width:240px;height:240px;margin:0 auto;"
                loop autoplay>
            </lottie-player>
            <h3 class="text-xl font-bold text-slate-500 mt-4 mb-2">Belum Ada Data Guru</h3>
            <p class="text-slate-400">Data guru akan segera ditambahkan oleh admin.</p>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7 stagger">
            @foreach($gurus as $guru)
            <div class="guru-card bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 p-6 flex flex-col items-center text-center reveal cursor-default">

                {{-- Avatar --}}
                <div class="relative mb-6 mt-2">
                    <div class="avatar-ring absolute inset-0 rounded-full border-2 border-primary/20 scale-110 pointer-events-none"></div>
                    <div class="avatar-inner relative w-28 h-28 rounded-full overflow-hidden shadow-lg">
                        @if($guru->foto)
                            <img src="{{ asset('storage/' . $guru->foto) }}" alt="{{ $guru->nama }}" class="w-full h-full object-cover"/>
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-primary/10 to-primary/20 flex items-center justify-center">
                                <span class="material-symbols-outlined text-5xl text-primary/60">person</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Info --}}
                <h3 class="font-bold text-slate-900 dark:text-white text-base leading-tight mb-1">{{ $guru->nama }}</h3>

                @if($guru->jabatan)
                    <span class="text-primary dark:text-accent text-xs font-bold uppercase tracking-wider mb-3">{{ $guru->jabatan }}</span>
                @endif

                @if($guru->mata_pelajaran)
                    <div class="inline-flex items-center gap-1.5 bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-400 px-3 py-1.5 rounded-full text-xs font-medium mb-3">
                        <span class="material-symbols-outlined text-sm text-primary">menu_book</span>
                        {{ $guru->mata_pelajaran }}
                    </div>
                @endif

                @if($guru->nip)
                    <p class="text-slate-400 text-xs">NIP: {{ $guru->nip }}</p>
                @endif

                @if($guru->no_hp)
                    <a href="https://wa.me/{{ preg_replace('/\D/','',$guru->no_hp) }}" target="_blank"
                       class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold text-green-600 hover:text-green-700 bg-green-50 dark:bg-green-900/20 hover:bg-green-100 px-3 py-1.5 rounded-full transition-colors">
                        <span class="material-symbols-outlined text-sm">chat</span>
                        Hubungi
                    </a>
                @endif
            </div>
            @endforeach
        </div>
        @endif

    </div>
</section>

@endsection
