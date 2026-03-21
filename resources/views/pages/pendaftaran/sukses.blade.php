@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
@keyframes confetti-fall {
    0%   { transform: translateY(-20px) rotate(0deg);   opacity: 1; }
    100% { transform: translateY(80px)  rotate(720deg);  opacity: 0; }
}
.confetti-dot {
    position: absolute;
    width: 8px; height: 8px;
    border-radius: 2px;
    animation: confetti-fall 2.5s ease-in forwards;
}
@keyframes scaleIn { from{opacity:0;transform:scale(.7)} to{opacity:1;transform:scale(1)} }
.scale-in { animation: scaleIn .5s cubic-bezier(.34,1.56,.64,1) both; }
@keyframes slideUp { from{opacity:0;transform:translateY(30px)} to{opacity:1;transform:translateY(0)} }
.slide-up { animation: slideUp .55s cubic-bezier(.22,1,.36,1) both; }
</style>
@endpush

@section('content')

{{-- Confetti container --}}
<div id="confetti-wrap" class="fixed inset-0 pointer-events-none z-50 overflow-hidden"></div>

<div class="min-h-[80vh] flex items-center justify-center px-4 py-16">
    <div class="max-w-lg w-full text-center">

        {{-- Lottie Success --}}
        <div class="scale-in" style="animation-delay:.1s">
            <lottie-player
                src="https://assets2.lottiefiles.com/packages/lf20_jbrw3hcz.json"
                background="transparent"
                speed="1"
                style="width:220px;height:220px;margin:0 auto;"
                autoplay>
            </lottie-player>
        </div>

        {{-- Title --}}
        <div class="slide-up" style="animation-delay:.5s">
            <h1 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-3">
                Pendaftaran Berhasil! 🎉
            </h1>
            @if(session('nama_anak'))
                <p class="text-lg text-slate-600 dark:text-slate-400 mb-2">
                    Data pendaftaran atas nama <strong class="text-primary">{{ session('nama_anak') }}</strong> telah kami terima.
                </p>
            @endif
            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-8">
                Tim kami akan memverifikasi data dan menghubungi Anda melalui nomor HP yang terdaftar dalam <strong>1–3 hari kerja</strong>.
            </p>
        </div>

        {{-- Steps --}}
        <div class="slide-up bg-gradient-to-br from-accent/10 to-accent/5 border border-accent/25 rounded-2xl p-6 mb-8 text-left" style="animation-delay:.65s">
            <h3 class="font-bold text-slate-800 dark:text-slate-200 mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-accent" style="font-variation-settings:'FILL' 1">info</span>
                Langkah Selanjutnya
            </h3>
            <div class="space-y-3">
                @foreach([
                    ['Tunggu konfirmasi WhatsApp/telepon ke nomor HP yang Anda daftarkan.','notifications_active'],
                    ['Siapkan dokumen asli (Akta Lahir, KK) untuk verifikasi lanjutan.','folder_open'],
                    ['Datang ke sekolah sesuai jadwal yang akan kami informasikan.','calendar_month'],
                ] as $i => $step)
                <div class="flex items-start gap-3 reveal" style="transition-delay:{{ ($i+1)*0.1 }}s">
                    <div class="w-8 h-8 rounded-xl bg-primary flex items-center justify-center shrink-0 mt-0.5">
                        <span class="material-symbols-outlined text-white text-sm" style="font-variation-settings:'FILL' 1">{{ $step[1] }}</span>
                    </div>
                    <p class="text-sm text-slate-700 dark:text-slate-300 leading-relaxed pt-1">{{ $step[0] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Actions --}}
        <div class="slide-up flex flex-col sm:flex-row gap-4 justify-center" style="animation-delay:.8s">
            <a href="{{ route('home') }}"
               class="bg-primary hover:bg-primary/90 text-white px-8 py-3.5 rounded-xl font-bold inline-flex items-center justify-center gap-2 transition-all shadow-lg shadow-primary/25 hover:shadow-primary/40 hover:-translate-y-0.5 active:translate-y-0">
                <span class="material-symbols-outlined text-lg">home</span>
                Kembali ke Beranda
            </a>
            <a href="{{ route('berita') }}"
               class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-8 py-3.5 rounded-xl font-bold inline-flex items-center justify-center gap-2 hover:border-primary hover:text-primary transition-all hover:-translate-y-0.5 active:translate-y-0">
                <span class="material-symbols-outlined text-lg">newspaper</span>
                Lihat Berita
            </a>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
// Confetti burst
(function(){
    const colors = ['#d4af37','#1f3b61','#3b82f6','#22c55e','#f97316','#ec4899'];
    const wrap = document.getElementById('confetti-wrap');
    for(let i=0;i<60;i++){
        const dot = document.createElement('div');
        dot.className = 'confetti-dot';
        dot.style.cssText = `
            left:${Math.random()*100}%;
            top:${Math.random()*40}%;
            background:${colors[Math.floor(Math.random()*colors.length)]};
            animation-delay:${Math.random()*1.5}s;
            animation-duration:${2+Math.random()*1.5}s;
            width:${6+Math.random()*6}px;
            height:${6+Math.random()*6}px;
            border-radius:${Math.random()>.5?'50%':'3px'};
        `;
        wrap.appendChild(dot);
    }
    setTimeout(()=>{ wrap.innerHTML=''; },4000);
})();
</script>
@endpush
