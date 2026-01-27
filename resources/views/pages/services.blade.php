@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto space-y-12">
    <div class="max-w-3xl">
        <h1 class="text-4xl font-bold mb-4">Layanan Publik Online</h1>
        <p class="text-lg text-slate-600">Urus berbagai dokumen kependudukan dan perizinan lebih cepat secara online atau unduh formulir untuk pengurusan di kantor desa.</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Service Card: Surat Domisili -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:border-emerald-500 transition-all flex flex-col group">
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl w-fit mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-6 h-6"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Surat Domisili</h3>
            <div class="flex-1 space-y-3 mb-6">
                <p class="text-xs font-bold text-slate-400 uppercase">Persyaratan:</p>
                <ul class="text-sm text-slate-600 space-y-2">
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>KTP &amp; KK Asli</li>
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>Surat Pengantar RT/RW</li>
                </ul>
            </div>
            <div class="flex gap-3">
                <button class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-slate-800 transition-colors">Formulir</button>
                <button class="flex-1 border-2 border-emerald-600 text-emerald-600 py-3 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-colors">Proses Online</button>
            </div>
        </div>

        <!-- Service Card: SKTM -->
        <!-- <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:border-emerald-500 transition-all flex flex-col group">
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl w-fit mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-6 h-6"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Surat Keterangan Tidak Mampu</h3>
            <div class="flex-1 space-y-3 mb-6">
                <p class="text-xs font-bold text-slate-400 uppercase">Persyaratan:</p>
                <ul class="text-sm text-slate-600 space-y-2">
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>Foto Rumah (Depan, Samping)</li>
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>Surat Pengantar RT/RW</li>
                </ul>
            </div>
            <div class="flex gap-3">
                <button class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-slate-800 transition-colors">Formulir</button>
                <button class="flex-1 border-2 border-emerald-600 text-emerald-600 py-3 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-colors">Proses Online</button>
            </div>
        </div> -->

        <!-- Service Card: Izin Usaha -->
        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:border-emerald-500 transition-all flex flex-col group">
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl w-fit mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-6 h-6"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Surat Keterangan Usaha</h3>
            <div class="flex-1 space-y-3 mb-6">
                <p class="text-xs font-bold text-slate-400 uppercase">Persyaratan:</p>
                <ul class="text-sm text-slate-600 space-y-2">
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>KTP Pemilik Usaha</li>
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>Bukti Kepemilikan Tempat</li>
                </ul>
            </div>
            <div class="flex gap-3">
                <button class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-slate-800 transition-colors">Formulir</button>
                <button class="flex-1 border-2 border-emerald-600 text-emerald-600 py-3 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-colors">Proses Online</button>
            </div>
        </div>
        
         <!-- Service Card: SKCK -->
        <!-- <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:border-emerald-500 transition-all flex flex-col group">
             <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl w-fit mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text w-6 h-6"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><path d="M16 13H8"/><path d="M16 17H8"/><path d="M10 9H8"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Pengantar SKCK</h3>
            <div class="flex-1 space-y-3 mb-6">
                 <p class="text-xs font-bold text-slate-400 uppercase">Persyaratan:</p>
                <ul class="text-sm text-slate-600 space-y-2">
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>KTP &amp; KK Asli</li>
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>Pas Foto 4x6 (2 lembar)</li>
                </ul>
            </div>
            <div class="flex gap-3">
                <button class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-slate-800 transition-colors">Formulir</button>
                <button class="flex-1 border-2 border-emerald-600 text-emerald-600 py-3 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-colors">Proses Online</button>
            </div>
        </div> -->

         <!-- Service Card: Akta Kelahiran -->
        <!-- <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:border-emerald-500 transition-all flex flex-col group">
             <div class="p-4 bg-emerald-50 text-emerald-600 rounded-2xl w-fit mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-baby w-6 h-6"><path d="M9 12h.01"/><path d="M15 12h.01"/><path d="M10 16c.5.3 1.2.5 2 .5s1.5-.2 2-.5"/><path d="M19 6.3a9 9 0 0 1 1.8 3.9 2 2 0 0 1 0 3.6 9 9 0 0 1-17.6 0 2 2 0 0 1 0-3.6A9 9 0 0 1 12 3c2 0 3.5 1.1 3.5 2.5s-.9 2.5-2 2.5c-.8 0-1.5-.4-1.5-1"/></svg>
            </div>
            <h3 class="text-xl font-bold mb-4">Akta Kelahiran</h3>
            <div class="flex-1 space-y-3 mb-6">
                 <p class="text-xs font-bold text-slate-400 uppercase">Persyaratan:</p>
                <ul class="text-sm text-slate-600 space-y-2">
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>Surat Keterangan Lahir (RS/Bidan)</li>
                    <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mt-1.5 shrink-0"></span>KTP Orang Tua &amp; KK</li>
                </ul>
            </div>
            <div class="flex gap-3">
                <button class="flex-1 bg-slate-900 text-white py-3 rounded-xl font-bold text-sm hover:bg-slate-800 transition-colors">Formulir</button>
                <button class="flex-1 border-2 border-emerald-600 text-emerald-600 py-3 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-colors">Proses Online</button>
            </div>
        </div> -->
    </div>
    
    <!-- <div class="bg-emerald-50 border border-emerald-100 p-8 rounded-3xl flex items-start gap-6">
        <div class="p-4 bg-emerald-600 text-white rounded-full shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info w-8 h-8"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
        </div>
        <div>
            <h3 class="text-xl font-bold text-emerald-900 mb-2">Informasi Tarif Pelayanan</h3>
            <p class="text-emerald-700 leading-relaxed">Sesuai Peraturan Desa (Perdes) No. 3 Tahun 2022, seluruh layanan administrasi kependudukan di Desa Mandiri Jaya bersifat <strong>GRATIS (Rp 0,-)</strong>.</p>
        </div>
    </div> -->
</div>
@endsection
