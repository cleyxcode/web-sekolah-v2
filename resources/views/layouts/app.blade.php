<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'SD Negeri Warialau - Official Website')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1f3b61",
                        "accent": "#d4af37",
                        "background-light": "#f6f7f8",
                        "background-dark": "#14181e",
                    },
                    fontFamily: {
                        "display": ["Inter"]
                    },
                    borderRadius: {"DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px"},
                },
            },
        }
    </script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <style>
/* ── Page entrance ── */
@keyframes pageIn { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
main { animation: pageIn .45s ease both; }

/* ── Global reveal / stagger ── */
.reveal { opacity:0; transform:translateY(28px); transition:opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1); }
.reveal.visible { opacity:1; transform:translateY(0); }
.reveal-left { opacity:0; transform:translateX(-32px); transition:opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1); }
.reveal-left.visible { opacity:1; transform:translateX(0); }
.reveal-right { opacity:0; transform:translateX(32px); transition:opacity .55s cubic-bezier(.22,1,.36,1), transform .55s cubic-bezier(.22,1,.36,1); }
.reveal-right.visible { opacity:1; transform:translateX(0); }
.stagger > *:nth-child(1){transition-delay:.05s}
.stagger > *:nth-child(2){transition-delay:.12s}
.stagger > *:nth-child(3){transition-delay:.19s}
.stagger > *:nth-child(4){transition-delay:.26s}
.stagger > *:nth-child(5){transition-delay:.33s}
.stagger > *:nth-child(6){transition-delay:.40s}
.stagger > *:nth-child(7){transition-delay:.47s}
.stagger > *:nth-child(8){transition-delay:.54s}

/* ── Card lift ── */
.card-lift { transition:transform .25s cubic-bezier(.22,1,.36,1), box-shadow .25s ease; }
.card-lift:hover { transform:translateY(-6px) scale(1.01); box-shadow:0 20px 48px rgba(31,59,97,.13); }

/* ── Pulse ring ── */
@keyframes pulse-ring { 0%{transform:scale(1);opacity:.6} 100%{transform:scale(1.5);opacity:0} }
.pulse-ring { position:relative; }
.pulse-ring::before { content:''; position:absolute; inset:-6px; border-radius:9999px; border:2px solid #d4af37; animation:pulse-ring 2s ease-out infinite; }

/* ── Shimmer loading ── */
@keyframes shimmer { 0%{background-position:-200% 0} 100%{background-position:200% 0} }
.shimmer { background:linear-gradient(90deg,#f0f0f0 25%,#e0e0e0 50%,#f0f0f0 75%); background-size:200% 100%; animation:shimmer 1.5s infinite; }

/* ── Float ── */
@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
.float { animation:float 3.5s ease-in-out infinite; }
    </style>
    @stack('styles')
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">

<!-- Top Accent Bar -->
<div class="w-full h-1 bg-gradient-to-r from-primary via-accent to-primary sticky top-0 z-50"></div>

<!-- Main Navigation -->
<header class="sticky top-1 z-40 w-full bg-white/95 dark:bg-background-dark/95 backdrop-blur-lg shadow-sm border-b border-slate-100 dark:border-slate-800/60">
    @php
        $navLinks = [
            ['route' => 'home',       'label' => 'Beranda',     'match' => 'home'],
            ['route' => 'profil',     'label' => 'Profil',      'match' => 'profil'],
            ['route' => 'guru',       'label' => 'Guru',        'match' => 'guru'],
            ['route' => 'berita',     'label' => 'Berita',      'match' => 'berita*'],
            ['route' => 'galeri',     'label' => 'Galeri',      'match' => 'galeri'],
            ['route' => 'pendaftaran','label' => 'Pendaftaran', 'match' => 'pendaftaran*'],
            ['route' => 'aplikasi',   'label' => 'Download App','match' => 'aplikasi*'],
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between" style="height:68px">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                @if(!empty($settings['logo']))
                    <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo"
                         class="h-10 w-10 object-contain rounded-xl ring-2 ring-slate-100 group-hover:ring-accent/40 transition-all"/>
                @else
                    <div class="h-10 w-10 bg-gradient-to-br from-primary to-primary/80 rounded-xl flex items-center justify-center shadow-md shadow-primary/20 group-hover:shadow-primary/40 transition-all shrink-0">
                        <span class="material-symbols-outlined text-white text-xl" style="font-variation-settings:'FILL' 1">school</span>
                    </div>
                @endif
                <div class="hidden sm:flex flex-col leading-tight">
                    <span class="text-[15px] font-black tracking-tight text-primary dark:text-white">
                        {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
                    </span>
                    <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-widest">
                        Kab. Kepulauan Aru · Maluku
                    </span>
                </div>
            </a>

            {{-- Desktop Nav Links --}}
            <nav class="hidden lg:flex items-center gap-0.5">
                @foreach($navLinks as $link)
                    @php $active = request()->routeIs($link['match']); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="relative px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-150
                              {{ $active
                                  ? 'text-primary dark:text-white'
                                  : 'text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-white hover:bg-slate-50 dark:hover:bg-white/5' }}">
                        {{ $link['label'] }}
                        @if($active)
                            <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-4 h-0.5 bg-accent rounded-full"></span>
                        @endif
                    </a>
                @endforeach
            </nav>

            {{-- Desktop Auth --}}
            <div class="hidden lg:flex items-center gap-2">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin"
                           class="flex items-center gap-1.5 text-xs font-bold text-primary/80 hover:text-primary border border-primary/20 hover:border-primary/50 px-3 py-2 rounded-lg transition-all">
                            <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                            Admin
                        </a>
                    @endif
                    <div class="relative" id="user-dropdown-wrapper">
                        <button id="user-dropdown-btn"
                                class="flex items-center gap-2 bg-slate-50 dark:bg-white/5 hover:bg-slate-100 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 px-3 py-2 rounded-xl transition-all">
                            <span class="w-7 h-7 rounded-lg bg-primary text-white text-xs font-black flex items-center justify-center shrink-0">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-200 max-w-[110px] truncate">{{ auth()->user()->name }}</span>
                            <span class="material-symbols-outlined text-sm text-slate-400 transition-transform duration-200" id="dropdown-chevron">expand_more</span>
                        </button>
                        <div id="user-dropdown-menu"
                             class="hidden absolute right-0 top-full mt-2 w-56 bg-white dark:bg-slate-900 rounded-2xl shadow-2xl border border-slate-100 dark:border-white/10 overflow-hidden z-50">
                            <div class="px-4 py-3.5 bg-gradient-to-br from-primary to-primary/80 text-white">
                                <p class="text-xs font-semibold opacity-70 mb-0.5">Masuk sebagai</p>
                                <p class="text-sm font-bold truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs opacity-60 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <div class="p-2">
                                <a href="{{ route('profil-akun') }}"
                                   class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-white/5 rounded-xl transition-colors">
                                    <span class="material-symbols-outlined text-base text-primary">manage_accounts</span>
                                    Profil Akun
                                </a>
                                @if(auth()->user()->role === 'orangtua')
                                <a href="{{ route('pendaftaran.riwayat') }}"
                                   class="flex items-center gap-2.5 px-3 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-white/5 rounded-xl transition-colors">
                                    <span class="material-symbols-outlined text-base text-primary">assignment</span>
                                    Riwayat Pendaftaran
                                </a>
                                @endif
                                <div class="my-1.5 border-t border-slate-100 dark:border-white/10"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-2.5 px-3 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-xl transition-colors">
                                        <span class="material-symbols-outlined text-base">logout</span>
                                        Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold text-slate-600 dark:text-slate-400 hover:text-primary dark:hover:text-white transition-colors px-3 py-2">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="flex items-center gap-1.5 bg-primary hover:bg-primary/90 text-white px-4 py-2.5 rounded-xl font-bold text-sm transition-all shadow-lg shadow-primary/25 active:scale-95">
                        <span class="material-symbols-outlined text-sm">person_add</span>
                        Daftar
                    </a>
                @endauth
            </div>

            {{-- Mobile Hamburger --}}
            <button id="mobile-menu-btn"
                    class="lg:hidden flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                <span class="material-symbols-outlined" id="mobile-menu-icon">menu</span>
            </button>
        </div>
    </div>

    {{-- Mobile Drawer --}}
    <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-100 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 py-3 space-y-0.5">
            @foreach($navLinks as $link)
                @php $active = request()->routeIs($link['match']); @endphp
                <a href="{{ route($link['route']) }}"
                   class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold transition-all
                          {{ $active
                              ? 'bg-primary text-white shadow-md shadow-primary/20'
                              : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-white/5 hover:text-primary dark:hover:text-white' }}">
                    {{ $link['label'] }}
                    @if($active)
                        <span class="w-1.5 h-1.5 rounded-full bg-accent"></span>
                    @endif
                </a>
            @endforeach
        </div>
        <div class="px-4 pb-4 pt-2 border-t border-slate-100 dark:border-white/5 mx-4 mt-1">
            @auth
                <div class="flex items-center gap-3 py-3 mb-2">
                    <span class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center text-white font-black shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <div class="min-w-0">
                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-400 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                @if(auth()->user()->role === 'admin')
                    <a href="/admin"
                       class="flex items-center gap-2 w-full px-4 py-2.5 mb-2 rounded-xl text-sm font-semibold text-primary bg-primary/8 hover:bg-primary/15 transition-colors">
                        <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                        Panel Admin
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-2 w-full px-4 py-2.5 rounded-xl text-sm font-semibold text-red-600 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 transition-colors">
                        <span class="material-symbols-outlined text-base">logout</span>
                        Keluar
                    </button>
                </form>
            @else
                <div class="flex flex-col gap-2 mt-2">
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center w-full px-4 py-3 rounded-xl text-sm font-bold text-primary border-2 border-primary/30 hover:border-primary hover:bg-primary/5 transition-all">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                       class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl text-sm font-bold bg-primary text-white shadow-lg shadow-primary/25 hover:bg-primary/90 transition-all">
                        <span class="material-symbols-outlined text-base">person_add</span>
                        Daftar Akun
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

<main>
    @if(session('success'))
        <div id="flash-success"
             class="fixed top-24 right-4 z-50 max-w-sm bg-green-500 text-white px-5 py-4 rounded-xl shadow-xl flex items-start gap-3 animate-bounce-once">
            <span class="material-symbols-outlined shrink-0" style="font-variation-settings:'FILL' 1">check_circle</span>
            <p class="text-sm font-medium">{{ session('success') }}</p>
            <button onclick="document.getElementById('flash-success').remove()" class="ml-auto text-white/80 hover:text-white">
                <span class="material-symbols-outlined text-base">close</span>
            </button>
        </div>
    @endif
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-primary text-white pt-20 pb-10">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
            <!-- Info Sekolah -->
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-white/10 p-2 rounded-lg">
                        <span class="material-symbols-outlined text-2xl">school</span>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight">{{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</h2>
                </div>
                <p class="text-slate-300 text-sm leading-relaxed mb-6">
                    {{ $settings['alamat_sekolah'] ?? $profil->alamat ?? 'Kec. Aru Utara, Kab. Kepulauan Aru, Maluku' }}
                </p>
                <div class="flex gap-4">
                    @if(!empty($settings['facebook_url']))
                        <a class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent hover:text-primary transition-colors"
                           href="{{ $settings['facebook_url'] }}" target="_blank" rel="noopener">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path></svg>
                        </a>
                    @endif
                    @if(!empty($settings['instagram_url']))
                        <a class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-accent hover:text-primary transition-colors"
                           href="{{ $settings['instagram_url'] }}" target="_blank" rel="noopener">
                            <svg class="w-5 h-5 fill-current" viewbox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path></svg>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Tautan Cepat -->
            <div>
                <h3 class="text-lg font-bold mb-6">Tautan Cepat</h3>
                <ul class="space-y-4 text-sm text-slate-300">
                    <li><a class="hover:text-accent transition-colors" href="{{ route('profil') }}">Profil Sekolah</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('profil') }}#visi-misi">Visi &amp; Misi</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('guru') }}">Daftar Guru</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('galeri') }}">Galeri Kegiatan</a></li>
                    <li><a class="hover:text-accent transition-colors" href="{{ route('pendaftaran') }}">Pendaftaran Siswa</a></li>
                </ul>
            </div>

            <!-- Informasi Kontak -->
            <div>
                <h3 class="text-lg font-bold mb-6">Kontak Kami</h3>
                <ul class="space-y-4 text-sm text-slate-300">
                    @if(!empty($settings['email_sekolah']))
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">mail</span>
                            {{ $settings['email_sekolah'] }}
                        </li>
                    @else
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">mail</span>
                            info@sdwarialau.sch.id
                        </li>
                    @endif
                    @if(!empty($settings['no_telp']))
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">call</span>
                            {{ $settings['no_telp'] }}
                        </li>
                    @elseif($profil && $profil->kontak)
                        <li class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-accent">call</span>
                            {{ $profil->kontak }}
                        </li>
                    @endif
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-accent">schedule</span>
                        Senin - Sabtu: 07.30 - 14.00
                    </li>
                </ul>
            </div>

            <!-- Google Maps -->
            <div class="rounded-xl overflow-hidden h-48 border-2 border-white/10">
                @if(!empty($settings['maps_embed']))
                    {!! $settings['maps_embed'] !!}
                @else
                    <div class="w-full h-full bg-slate-700 flex flex-col items-center justify-center text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2">map</span>
                        <p class="text-xs px-4 text-center">Peta Lokasi {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-8 border-t border-white/10 text-center text-sm text-slate-400">
            <p>© {{ date('Y') }} {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}. Seluruh Hak Cipta Dilindungi.</p>
        </div>
    </div>
</footer>

<script>
(function () {
    // Mobile menu toggle
    const mobileBtn  = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileIcon = document.getElementById('mobile-menu-icon');

    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            const open = !mobileMenu.classList.contains('hidden');
            mobileMenu.classList.toggle('hidden', open);
            if (mobileIcon) mobileIcon.textContent = open ? 'menu' : 'close';
        });
    }

    // User dropdown
    const dropBtn     = document.getElementById('user-dropdown-btn');
    const dropMenu    = document.getElementById('user-dropdown-menu');
    const dropChevron = document.getElementById('dropdown-chevron');

    if (dropBtn && dropMenu) {
        dropBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const open = !dropMenu.classList.contains('hidden');
            dropMenu.classList.toggle('hidden', open);
            if (dropChevron) dropChevron.style.transform = open ? '' : 'rotate(180deg)';
        });

        document.addEventListener('click', () => {
            dropMenu.classList.add('hidden');
            if (dropChevron) dropChevron.style.transform = '';
        });
    }

    // Auto-hide flash message after 4s
    const flash = document.getElementById('flash-success');
    if (flash) setTimeout(() => flash.remove(), 4000);
})();
</script>
<script>
// Global Intersection Observer for .reveal, .reveal-left, .reveal-right
(function(){
  const els = document.querySelectorAll('.reveal, .reveal-left, .reveal-right');
  if(!els.length) return;
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if(e.isIntersecting){ e.target.classList.add('visible'); obs.unobserve(e.target); } });
  }, { threshold: 0.1, rootMargin:'0px 0px -40px 0px' });
  els.forEach(el => obs.observe(el));
})();
</script>
@stack('scripts')
</body>
</html>
