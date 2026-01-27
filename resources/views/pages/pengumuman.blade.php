@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-5xl mx-auto space-y-12">
    <div class="text-center space-y-4">
        <div class="inline-flex p-3 bg-emerald-100 text-emerald-600 rounded-2xl mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-megaphone"><path d="m3 11 18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
        </div>
        <h1 class="text-4xl font-bold">Pengumuman Resmi</h1>
        <p class="text-lg text-slate-600">Informasi resmi dari Pemerintah Desa Mandiri Jaya untuk seluruh warga.</p>
    </div>

    <div class="space-y-6">
        <!-- Message 1 -->
        <div class="bg-white border border-slate-100 rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start cursor-pointer group">
            <div class="p-4 rounded-2xl shrink-0 bg-amber-50 text-amber-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
            </div>
            <div class="flex-1 space-y-3">
                <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider">
                    <span class="px-2 py-1 rounded bg-slate-100 text-slate-600">Himbauan</span>
                    <span class="text-slate-400 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg> 20 Okt 2023
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">Pemberitahuan Kerja Bakti Massal Kebersihan Lingkungan</h3>
                <p class="text-slate-600 leading-relaxed">Diharapkan seluruh warga desa untuk berpartisipasi dalam agenda bersih desa rutin menyambut musim hujan.</p>
            </div>
            <div class="shrink-0 flex md:flex-col gap-2 w-full md:w-auto">
                <button class="flex-1 md:flex-none bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg> Download PDF
                </button>
                <button class="flex-1 md:flex-none bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold text-sm hover:bg-slate-50 transition-colors">Detail</button>
            </div>
        </div>

        <!-- Message 2 -->
        <div class="bg-white border border-slate-100 rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start cursor-pointer group">
            <div class="p-4 rounded-2xl shrink-0 bg-red-50 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            </div>
            <div class="flex-1 space-y-3">
                <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider">
                    <span class="px-2 py-1 rounded bg-red-100 text-red-700">Penting</span>
                    <span class="text-slate-400 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg> 18 Okt 2023
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">Perubahan Jam Pelayanan Kantor Desa Selama Libur Nasional</h3>
                <p class="text-slate-600 leading-relaxed">Kantor desa akan beroperasi hingga pukul 12:00 WIB selama tanggal 24-25 Oktober mendatang.</p>
            </div>
            <div class="shrink-0 flex md:flex-col gap-2 w-full md:w-auto">
                <button class="flex-1 md:flex-none bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg> Download PDF
                </button>
                <button class="flex-1 md:flex-none bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold text-sm hover:bg-slate-50 transition-colors">Detail</button>
            </div>
        </div>

        <!-- Message 3 -->
        <div class="bg-white border border-slate-100 rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start cursor-pointer group">
            <div class="p-4 rounded-2xl shrink-0 bg-red-50 text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-circle"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
            </div>
            <div class="flex-1 space-y-3">
                <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider">
                    <span class="px-2 py-1 rounded bg-slate-100 text-slate-600">Kebijakan</span>
                    <span class="text-slate-400 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg> 15 Okt 2023
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">Sosialisasi Bantuan Langsung Tunai (BLT) Dana Desa</h3>
                <p class="text-slate-600 leading-relaxed">Pemerintah desa merilis daftar penerima bantuan tahap III tahun 2023. Silahkan cek dokumen terlampir.</p>
            </div>
            <div class="shrink-0 flex md:flex-col gap-2 w-full md:w-auto">
                <button class="flex-1 md:flex-none bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg> Download PDF
                </button>
                <button class="flex-1 md:flex-none bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold text-sm hover:bg-slate-50 transition-colors">Detail</button>
            </div>
        </div>

        <!-- Message 4 -->
        <div class="bg-white border border-slate-100 rounded-[2rem] p-8 shadow-sm hover:shadow-md transition-shadow flex flex-col md:flex-row gap-6 items-start cursor-pointer group">
            <div class="p-4 rounded-2xl shrink-0 bg-blue-50 text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
            </div>
            <div class="flex-1 space-y-3">
                <div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-wider">
                    <span class="px-2 py-1 rounded bg-slate-100 text-slate-600">Kesehatan</span>
                    <span class="text-slate-400 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg> 10 Okt 2023
                    </span>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition-colors">Vaksinasi Rabies untuk Hewan Peliharaan Gratis</h3>
                <p class="text-slate-600 leading-relaxed">Program kerja sama dengan Dinas Pertanian dan Peternakan akan dilaksanakan di Balai Desa.</p>
            </div>
            <div class="shrink-0 flex md:flex-col gap-2 w-full md:w-auto">
                <button class="flex-1 md:flex-none bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg> Download PDF
                </button>
                <button class="flex-1 md:flex-none bg-white border border-slate-200 text-slate-600 px-6 py-3 rounded-xl font-bold text-sm hover:bg-slate-50 transition-colors">Detail</button>
            </div>
        </div>
    </div>
</div>
@endsection
