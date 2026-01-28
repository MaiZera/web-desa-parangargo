@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto space-y-20">
    <!-- Hero Section -->
    <div class="text-center space-y-4">
        <h1 class="text-5xl md:text-7xl font-black text-slate-900 tracking-tight">Pusat Kabar & Dokumentasi</h1>
        <p class="text-xl text-slate-500 max-w-2xl mx-auto font-medium">Jelajahi berbagai informasi terkini, pengumuman resmi, dan laporan kegiatan Desa Parangargo dalam satu wadah digital.</p>
    </div>

    <!-- Category Selection Cards -->
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Artikel Card -->
        <a href="{{ route('news.artikel') }}" class="group relative bg-white rounded-[3.5rem] p-10 border border-slate-100 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] hover:shadow-[0_48px_80px_-16px_rgba(16,185,129,0.15)] hover:-translate-y-4 transition-all duration-700 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full translate-x-8 -translate-y-8 group-hover:scale-[3] transition-transform duration-1000"></div>
            <div class="relative z-10 space-y-6">
                <div class="w-20 h-20 bg-emerald-600 text-white rounded-3xl flex items-center justify-center shadow-2xl shadow-emerald-600/20 group-hover:rotate-12 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>
                </div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-black text-slate-900">Artikel Desa</h2>
                    <p class="text-slate-500 font-medium leading-relaxed text-lg">Liputan mendalam mengenai perkembangan, budaya, dan inovasi desa.</p>
                </div>
                <div class="flex items-center gap-3 text-emerald-600 font-black uppercase tracking-widest text-sm">
                    Eksplorasi
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-3 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <!-- Pengumuman Card -->
        <a href="{{ route('news.pengumuman') }}" class="group relative bg-white rounded-[3.5rem] p-10 border border-slate-100 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] hover:shadow-[0_48px_80px_-16px_rgba(239,68,68,0.15)] hover:-translate-y-4 transition-all duration-700 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-red-50 rounded-full translate-x-8 -translate-y-8 group-hover:scale-[3] transition-transform duration-1000"></div>
            <div class="relative z-10 space-y-6">
                <div class="w-20 h-20 bg-red-600 text-white rounded-3xl flex items-center justify-center shadow-2xl shadow-red-600/20 group-hover:rotate-12 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
                </div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-black text-slate-900">Pengumuman</h2>
                    <p class="text-slate-500 font-medium leading-relaxed text-lg">Info resmi, surat edaran, dan instruksi kedinasan bagi warga.</p>
                </div>
                <div class="flex items-center gap-3 text-red-600 font-black uppercase tracking-widest text-sm">
                    Lihat Semua
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-3 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </div>
            </div>
        </a>

        <!-- Laporan Card -->
        <a href="{{ route('news.laporan') }}" class="group relative bg-white rounded-[3.5rem] p-10 border border-slate-100 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.05)] hover:shadow-[0_48px_80px_-16px_rgba(79,70,229,0.15)] hover:-translate-y-4 transition-all duration-700 overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full translate-x-8 -translate-y-8 group-hover:scale-[3] transition-transform duration-1000"></div>
            <div class="relative z-10 space-y-6">
                <div class="w-20 h-20 bg-indigo-600 text-white rounded-3xl flex items-center justify-center shadow-2xl shadow-indigo-600/20 group-hover:rotate-12 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                </div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-black text-slate-900">Laporan Kegiatan</h2>
                    <p class="text-slate-500 font-medium leading-relaxed text-lg">Dokumentasi hasil pelaksanaan program dan akuntabilitas dana.</p>
                </div>
                <div class="flex items-center gap-3 text-indigo-600 font-black uppercase tracking-widest text-sm">
                    Buka Berkas
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-3 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </div>
            </div>
        </a>
    </div>

    <!-- Recent Mixed Stream -->
    <div class="space-y-10">
        <h3 class="text-2xl font-black text-slate-800 flex items-center gap-4">
            Kabar Terkini
            <div class="flex-1 h-px bg-slate-100"></div>
        </h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @for ($i = 1; $i <= 4; $i++)
            <a href="{{ route('news.show', 'slug-' . $i) }}" class="bg-white rounded-[2rem] p-6 border border-slate-50 shadow-sm hover:shadow-xl transition-all group">
                <div class="aspect-square bg-slate-100 rounded-2xl mb-4 overflow-hidden">
                    <img src="https://picsum.photos/seed/recent{{ $i }}/400/400" alt="news" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest text-emerald-600 mb-2">Kabar Terbaru</p>
                <h4 class="font-black text-slate-900 leading-tight line-clamp-2">Update Pembangunan Posyandu Terintegrasi Blok A</h4>
            </a>
            @endfor
        </div>
    </div>
</div>
@endsection
