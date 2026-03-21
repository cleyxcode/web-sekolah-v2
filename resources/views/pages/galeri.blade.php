@extends('layouts.app')

@section('title', 'Galeri Kegiatan - ' . ($profil->nama_sekolah ?? 'SD Negeri Warialau'))

@push('styles')
<style>
.galeri-item { opacity:0; transform:scale(.92); transition:opacity .5s cubic-bezier(.22,1,.36,1), transform .5s cubic-bezier(.22,1,.36,1); }
.galeri-item.visible { opacity:1; transform:scale(1); }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<section class="bg-primary py-16 px-4">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl font-black text-white mb-3">Galeri Kegiatan</h1>
        <p class="text-slate-300 text-lg max-w-2xl mx-auto">
            Dokumentasi kegiatan dan momen berharga di {{ $profil->nama_sekolah ?? 'SD Negeri Warialau' }}
        </p>
        <div class="w-20 h-1.5 bg-accent rounded-full mx-auto mt-6"></div>
    </div>
</section>

{{-- Galeri Grid --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">

        @if($galeri->isNotEmpty())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($galeri as $item)
                    <div class="galeri-item relative group aspect-square rounded-xl overflow-hidden shadow-md cursor-pointer"
                         onclick="openLightbox('{{ asset('storage/' . $item->foto) }}', '{{ addslashes($item->judul) }}', '{{ addslashes($item->keterangan ?? '') }}')">
                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                             style="background-image: url('{{ asset('storage/' . $item->foto) }}');"></div>
                        <div class="absolute inset-0 bg-primary/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center p-4">
                            <span class="material-symbols-outlined text-white text-4xl mb-2">zoom_in</span>
                            <p class="text-white font-bold text-center text-sm line-clamp-2">{{ $item->judul }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($galeri->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $galeri->links() }}
                </div>
            @endif

        @else
            <div class="text-center py-24">
                <span class="material-symbols-outlined text-7xl text-slate-300 dark:text-slate-600 mb-4 block">photo_library</span>
                <h3 class="text-xl font-bold text-slate-500 dark:text-slate-400 mb-2">Belum Ada Foto</h3>
                <p class="text-slate-400 dark:text-slate-500">Galeri kegiatan akan segera ditambahkan.</p>
            </div>
        @endif

    </div>
</section>

{{-- Lightbox Modal --}}
<div id="lightbox"
     class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center p-4"
     onclick="closeLightbox()">
    <div class="relative max-w-4xl w-full mx-auto" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()"
                class="absolute -top-12 right-0 text-white hover:text-accent transition-colors">
            <span class="material-symbols-outlined text-4xl">close</span>
        </button>
        <img id="lightbox-img" src="" alt=""
             class="w-full max-h-[75vh] object-contain rounded-xl shadow-2xl">
        <div class="mt-4 text-center">
            <p id="lightbox-title" class="text-white font-bold text-xl"></p>
            <p id="lightbox-caption" class="text-slate-400 text-sm mt-1"></p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
(function(){
    const items = document.querySelectorAll('.galeri-item');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach((e,i) => {
            if(e.isIntersecting){
                setTimeout(()=>e.target.classList.add('visible'), (parseInt(e.target.dataset.idx)||0) % 8 * 80);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.05 });
    items.forEach((el,i) => { el.dataset.idx = i; obs.observe(el); });
})();

function openLightbox(src, title, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-title').textContent = title;
    document.getElementById('lightbox-caption').textContent = caption;

    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeLightbox();
});
</script>
@endpush
