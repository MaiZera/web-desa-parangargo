@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto space-y-16">
    <div class="text-center space-y-4 max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold">Transparansi Anggaran</h1>
        <p class="text-slate-600 text-lg">Wujud komitmen desa dalam pengelolaan APBDes yang jujur, terbuka, dan akuntabel.</p>
    </div>
    
    <section class="bg-white p-8 rounded-[3rem] shadow-sm border border-slate-100">
        <div class="flex justify-between items-center mb-12">
            <h3 class="text-2xl font-bold">Laporan Realisasi APBDes 2023</h3>
            <div class="flex gap-4">
                <div class="flex items-center gap-2 text-sm"><div class="w-3 h-3 bg-blue-500 rounded"></div> Anggaran</div>
                <div class="flex items-center gap-2 text-sm"><div class="w-3 h-3 bg-emerald-500 rounded"></div> Realisasi</div>
            </div>
        </div>
        <div class="h-[400px] flex items-end justify-around gap-4 pb-4 border-b border-slate-100 px-4">
            <!-- Mock Bar Chart -->
             <div class="flex flex-col items-center gap-2 flex-1 group">
                <div class="w-full h-full flex items-end justify-center gap-2">
                     <div class="w-full max-w-[40px] bg-blue-500 rounded-t-lg h-[80%] hover:brightness-110 transition-all relative group-hover:shadow-lg">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Rp 1.2M</div>
                     </div>
                     <div class="w-full max-w-[40px] bg-emerald-500 rounded-t-lg h-[75%] hover:brightness-110 transition-all relative group-hover:shadow-lg">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Rp 1.1M</div>
                     </div>
                </div>
                <span class="text-xs font-bold text-slate-500 mt-2">PAD</span>
            </div>
             <div class="flex flex-col items-center gap-2 flex-1 group">
                <div class="w-full h-full flex items-end justify-center gap-2">
                     <div class="w-full max-w-[40px] bg-blue-500 rounded-t-lg h-[90%] hover:brightness-110 transition-all relative group-hover:shadow-lg">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Rp 800jt</div>
                     </div>
                     <div class="w-full max-w-[40px] bg-emerald-500 rounded-t-lg h-[90%] hover:brightness-110 transition-all relative group-hover:shadow-lg">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Rp 800jt</div>
                     </div>
                </div>
                <span class="text-xs font-bold text-slate-500 mt-2">DANA DESA</span>
            </div>
            <div class="flex flex-col items-center gap-2 flex-1 group">
                <div class="w-full h-full flex items-end justify-center gap-2">
                     <div class="w-full max-w-[40px] bg-blue-500 rounded-t-lg h-[60%] hover:brightness-110 transition-all relative group-hover:shadow-lg">
                        <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Rp 450jt</div>
                     </div>
                     <div class="w-full max-w-[40px] bg-emerald-500 rounded-t-lg h-[55%] hover:brightness-110 transition-all relative group-hover:shadow-lg">
                         <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[10px] py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">Rp 400jt</div>
                     </div>
                </div>
                <span class="text-xs font-bold text-slate-500 mt-2">LAINNYA</span>
            </div>
        </div>
    </section>

    <div class="grid md:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 space-y-6">
            <h3 class="text-xl font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hard-hat w-6 h-6 text-emerald-600"><path d="M2 13.381a15 15 0 0 0 7.378 1.44H15a15 15 0 0 0 7-1.5"/><path d="M12 18v3"/><path d="M2 10.134V15a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4.866a8 8 0 0 0-16 0"/><path d="M22 10v-.53a3 3 0 0 0-1.85-2.77 10 10 0 0 0-11-2.203"/></svg>
                Proyek Pembangunan 2023
            </h3>
            <div class="space-y-6">
                <!-- Project 1 -->
                <div>
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold text-sm">Jalan Lingkar Desa</h4>
                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">100% Selesai</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                         <div class="bg-emerald-500 h-2 rounded-full" style="width: 100%"></div>
                    </div>
                </div>
                <!-- Project 2 -->
                 <div>
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold text-sm">Renovasi Balai Warga</h4>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">75% Berjalan</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                         <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                    </div>
                </div>
                <!-- Project 3 -->
                 <div>
                    <div class="flex justify-between mb-2">
                        <h4 class="font-bold text-sm">Saluran Irigasi</h4>
                        <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded">30% Berjalan</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                         <div class="bg-orange-500 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 text-white p-8 rounded-3xl space-y-6">
            <h3 class="text-xl font-bold flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-stack w-6 h-6 text-emerald-400"><path d="M21 7h-3a2 2 0 0 1-2-2V2"/><path d="M21 6v6.5c0 .8-.7 1.5-1.5 1.5h-7c-.8 0-1.5-.7-1.5-1.5v-9c0-.8.7-1.5 1.5-1.5H12L21 6Z"/><path d="M7 8v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H15"/><path d="M3 12v8.8c0 .3.2.6.4.8.2.2.5.4.8.4H11"/></svg>
                Dokumen Regulasi Desa
            </h3>
            <ul class="space-y-4">
                <li class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 transition-colors">
                    <div class="flex items-center gap-3">
                         <div class="p-2 bg-red-500/20 text-red-400 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-5 h-5"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg></div>
                         <div>
                             <h4 class="font-bold text-sm">RPJM Desa 2020-2026</h4>
                             <p class="text-xs text-slate-400">PDF • 2.4 MB</p>
                         </div>
                    </div>
                    <button class="p-2 text-slate-400 hover:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-5 h-5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg></button>
                </li>
                 <li class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 transition-colors">
                    <div class="flex items-center gap-3">
                         <div class="p-2 bg-red-500/20 text-red-400 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-5 h-5"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg></div>
                         <div>
                             <h4 class="font-bold text-sm">APBDes Tahun 2023</h4>
                             <p class="text-xs text-slate-400">PDF • 1.8 MB</p>
                         </div>
                    </div>
                    <button class="p-2 text-slate-400 hover:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-5 h-5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg></button>
                </li>
                 <li class="flex items-center justify-between p-4 bg-white/5 border border-white/10 rounded-2xl hover:bg-white/10 transition-colors">
                    <div class="flex items-center gap-3">
                         <div class="p-2 bg-red-500/20 text-red-400 rounded-lg"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-5 h-5"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg></div>
                         <div>
                             <h4 class="font-bold text-sm">Perdes Ketertiban Umum</h4>
                             <p class="text-xs text-slate-400">PDF • 0.5 MB</p>
                         </div>
                    </div>
                    <button class="p-2 text-slate-400 hover:text-white transition-colors"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-download w-5 h-5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg></button>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
