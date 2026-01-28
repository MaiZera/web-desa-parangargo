@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto space-y-12">
    <div class="flex flex-col md:flex-row justify-between items-end gap-6">
        <div class="max-w-xl">
            <h1 class="text-4xl font-bold mb-4">Artikel &amp; Kabar Desa</h1>
            <p class="text-lg text-slate-600">Liputan mendalam tentang perkembangan, budaya, dan inovasi di Desa Mandiri Jaya.</p>
        </div>
        <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
            <button class="px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap bg-emerald-600 text-white shadow-lg">Semua</button>
            <button class="px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap bg-white text-slate-500 hover:bg-slate-50 border border-slate-200">Pembangunan</button>
            <button class="px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap bg-white text-slate-500 hover:bg-slate-50 border border-slate-200">Budaya</button>
            <button class="px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap bg-white text-slate-500 hover:bg-slate-50 border border-slate-200">Ekonomi</button>
            <button class="px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap bg-white text-slate-500 hover:bg-slate-50 border border-slate-200">Kesehatan</button>
        </div>
    </div>

    <!-- Featured News -->
    <section class="relative h-[450px] rounded-[3rem] overflow-hidden group cursor-pointer">
        <img alt="Pembangunan Jalan Lingkar Desa Tahap 1 Selesai" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="https://picsum.photos/seed/village1/600/400">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/40 to-transparent flex items-end p-8 md:p-16">
            <div class="max-w-3xl space-y-4">
                <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Pembangunan</span>
                <h2 class="text-3xl md:text-5xl font-bold text-white leading-tight">Pembangunan Jalan Lingkar Desa Tahap 1 Selesai</h2>
                <p class="text-slate-200 line-clamp-2 text-lg">Pemerintah desa berhasil merampungkan pembangunan jalan lingkar sepanjang 2km untuk mempermudah akses tani.</p>
                <div class="flex items-center gap-4 text-emerald-400 font-medium">
                    <span class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-4 h-4" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 15 Okt 2023
                    </span>
                    <a href="{{ route('news.show', 'featured-article') }}" class="flex items-center gap-1 hover:underline">Baca Selengkapnya
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="grid md:grid-cols-3 gap-8">
        <!-- Article 1 -->
        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 group cursor-pointer">
            <div class="h-56 overflow-hidden relative">
                <img alt="Pembangunan Jalan Lingkar Desa Tahap 1 Selesai" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://picsum.photos/seed/village1/600/400">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-emerald-600 uppercase">Pembangunan</div>
            </div>
            <div class="p-8 space-y-4">
                <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 15 Okt 2023
                </div>
                <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">Pembangunan Jalan Lingkar Desa Tahap 1 Selesai</h3>
                <p class="text-slate-500 text-sm line-clamp-3 leading-relaxed">Pemerintah desa berhasil merampungkan pembangunan jalan lingkar sepanjang 2km untuk mempermudah akses tani.</p>
                <a href="{{ route('news.show', 'pembangunan-jalan-lingkar') }}" class="pt-2 text-emerald-600 font-bold text-sm flex items-center gap-1 hover:gap-2 transition-all">Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
                </a>
            </div>
        </article>
        <!-- Article 2 -->
        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 group cursor-pointer">
            <div class="h-56 overflow-hidden relative">
                <img alt="Festival Budaya Mandiri Jaya 2023 Berlangsung Meriah" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://picsum.photos/seed/village2/600/400">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-emerald-600 uppercase">Budaya</div>
            </div>
            <div class="p-8 space-y-4">
                <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 10 Okt 2023
                </div>
                <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">Festival Budaya Mandiri Jaya 2023 Berlangsung Meriah</h3>
                <p class="text-slate-500 text-sm line-clamp-3 leading-relaxed">Ribuan warga memadati balai desa untuk menyaksikan pertunjukan seni tradisional tahunan.</p>
                <a href="{{ route('news.show', 'festival-budaya') }}" class="pt-2 text-emerald-600 font-bold text-sm flex items-center gap-1 hover:gap-2 transition-all">Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
                </a>
            </div>
        </article>
        <!-- Article 3 -->
        <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100 group cursor-pointer">
            <div class="h-56 overflow-hidden relative">
                <img alt="Pelatihan Digital Marketing untuk Pelaku UMKM" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" src="https://picsum.photos/seed/village3/600/400">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[10px] font-bold text-emerald-600 uppercase">Ekonomi</div>
            </div>
            <div class="p-8 space-y-4">
                <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3.5 h-3.5" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 05 Okt 2023
                </div>
                <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">Pelatihan Digital Marketing untuk Pelaku UMKM</h3>
                <p class="text-slate-500 text-sm line-clamp-3 leading-relaxed">Puluhan pengusaha lokal diberikan pelatihan cara berjualan online menggunakan marketplace.</p>
                <a href="{{ route('news.show', 'pelatihan-umkm') }}" class="pt-2 text-emerald-600 font-bold text-sm flex items-center gap-1 hover:gap-2 transition-all">Selengkapnya
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right w-4 h-4" aria-hidden="true"><path d="m9 18 6-6-6-6"></path></svg>
                </a>
            </div>
        </article>
    </div>
</div>
@endsection
