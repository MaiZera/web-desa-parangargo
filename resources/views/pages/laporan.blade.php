@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto space-y-16">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-8 bg-white p-12 rounded-[3rem] shadow-sm border border-slate-100">
        <div class="max-w-2xl space-y-4 text-center md:text-left">
            <h1 class="text-4xl font-bold text-slate-900">Laporan Kegiatan Desa</h1>
            <p class="text-lg text-slate-600 leading-relaxed">Transparansi dalam setiap gerak langkah pembangunan. Temukan laporan detail mengenai penggunaan dana dan realisasi program desa di sini.</p>
            <div class="flex flex-wrap gap-4 justify-center md:justify-start pt-2">
                <button class="bg-emerald-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-emerald-700 transition-all">Laporan Tahunan 2022</button>
                <button class="bg-white border border-slate-200 text-slate-600 px-8 py-3 rounded-full font-bold hover:bg-slate-50 transition-all">Arsip Laporan</button>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div class="p-6 bg-blue-50 rounded-3xl text-center">
                <p class="text-3xl font-bold text-blue-600">42</p>
                <p class="text-xs font-bold text-blue-400 uppercase tracking-tighter mt-1">Program Selesai</p>
            </div>
            <div class="p-6 bg-emerald-50 rounded-3xl text-center">
                <p class="text-3xl font-bold text-emerald-600">92%</p>
                <p class="text-xs font-bold text-emerald-400 uppercase tracking-tighter mt-1">Tingkat Kepuasan</p>
            </div>
        </div>
    </div>

    <!-- Reports Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Report 1 -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-6">
                <div class="p-3 bg-slate-50 text-emerald-600 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4h4"/></svg>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-700">Selesai</span>
            </div>
            <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-2">September 2023</p>
            <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-emerald-600 transition-colors">Laporan Pembangunan Jalan Desa (Tahap 1)</h3>
            <p class="text-slate-500 text-sm mb-6 leading-relaxed">Memperlancar akses transportasi untuk 450 KK.</p>
            <div class="space-y-2">
                <div class="flex justify-between text-xs font-bold">
                    <span class="text-slate-400">Realisasi Program</span>
                    <span class="text-emerald-600">100%</span>
                </div>
                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: 100%"></div>
                </div>
            </div>
        </div>

        <!-- Report 2 -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-6">
                <div class="p-3 bg-slate-50 text-emerald-600 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4h4"/></svg>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-emerald-100 text-emerald-700">Selesai</span>
            </div>
            <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-2">Agustus 2023</p>
            <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-emerald-600 transition-colors">Pemberdayaan Digital UMKM Gelombang II</h3>
            <p class="text-slate-500 text-sm mb-6 leading-relaxed">Melahirkan 25 pengusaha baru melek digital.</p>
            <div class="space-y-2">
                <div class="flex justify-between text-xs font-bold">
                    <span class="text-slate-400">Realisasi Program</span>
                    <span class="text-emerald-600">95%</span>
                </div>
                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: 95%"></div>
                </div>
            </div>
        </div>

        <!-- Report 3 -->
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
            <div class="flex justify-between items-start mb-6">
                <div class="p-3 bg-slate-50 text-emerald-600 rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4h4"/></svg>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase bg-amber-100 text-amber-700">On Progress</span>
            </div>
            <p class="text-xs font-bold text-emerald-600 uppercase tracking-widest mb-2">Juli 2023</p>
            <h3 class="text-xl font-bold text-slate-900 mb-4 group-hover:text-emerald-600 transition-colors">Renovasi Puskesmas Pembantu RW 05</h3>
            <p class="text-slate-500 text-sm mb-6 leading-relaxed">Peningkatan fasilitas kesehatan dasar.</p>
            <div class="space-y-2">
                <div class="flex justify-between text-xs font-bold">
                    <span class="text-slate-400">Realisasi Program</span>
                    <span class="text-emerald-600">65%</span>
                </div>
                <div class="h-2 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-500 rounded-full" style="width: 65%"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
