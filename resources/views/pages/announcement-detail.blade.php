@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-5xl mx-auto space-y-12">
    <!-- Breadcrumb -->
    <nav class="flex text-sm font-medium text-slate-400 gap-2 mb-8">
        <a href="{{ route('home') }}" class="hover:text-emerald-600">Home</a>
        <span>/</span>
        <a href="{{ route('news') }}" class="hover:text-emerald-600">Berita</a>
        <span>/</span>
        <a href="{{ route('news.pengumuman') }}" class="hover:text-emerald-600">Pengumuman</a>
        <span>/</span>
        <span class="text-slate-900 line-clamp-1">Detail Pengumuman</span>
    </nav>

    <!-- Post Header -->
    <div class="space-y-6">
        <div class="flex items-center gap-4">
            <div class="p-3 bg-red-100 text-red-600 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
            </div>
            <div class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-bold uppercase tracking-wider">
                Penting / Himbauan
            </div>
        </div>
        
        <h1 class="text-3xl md:text-5xl font-black text-slate-900 leading-tight tracking-tight">Pemberitahuan Kerja Bakti Massal Kebersihan Lingkungan</h1>
        
        <div class="flex flex-wrap items-center gap-6 text-sm text-slate-500 border-y border-slate-100 py-6 font-medium">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span>Diterbitkan: 20 Oktober 2023</span>
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <span>Oleh: Sekretariat Desa</span>
            </div>
        </div>
    </div>

    <!-- Announcement Content -->
    <div class="grid lg:grid-cols-3 gap-16">
        <div class="lg:col-span-2 space-y-12">
            <div class="prose prose-lg prose-slate max-w-none prose-headings:text-slate-900 prose-headings:font-black prose-p:leading-relaxed prose-p:text-slate-600">
                <p>Kepada seluruh warga Desa Parangargo,</p>
                
                <p>Dalam rangka menyambut datangnya musim penghujan dan sebagai upaya pencegahan dini terhadap penyakit yang disebabkan oleh genangan air serta menjaga keasrian desa kita, Pemerintah Desa Parangargo mengimbau kepada seluruh lapisan masyarakat untuk berpartisipasi dalam kegiatan:</p>
                
                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-8 space-y-4">
                    <div class="flex items-start gap-4">
                        <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900">Nama Kegiatan:</span>
                            <span class="text-slate-600 ml-1">Kerja Bakti Massal Kebersihan Lingkungan</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900">Hari/Tanggal:</span>
                            <span class="text-slate-600 ml-1">Minggu, 29 Oktober 2023</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900">Waktu:</span>
                            <span class="text-slate-600 ml-1">07.00 WIB s/d Selesai</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-6 h-6 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center shrink-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div>
                            <span class="font-bold text-slate-900">Lokasi:</span>
                            <span class="text-slate-600 ml-1">Seluruh wilayah RT/RW masing-masing</span>
                        </div>
                    </div>
                </div>

                <p>Fokus utama kegiatan ini adalah pembersihan saluran air (drainase), pemotongan rumput yang mengganggu akses jalan, serta pengumpulan sampah plastik di area publik.</p>

                <p>Diharapkan setiap kepala keluarga dapat mendelegasikan perwakilannya dengan membawa peralatan kebersihan masing-masing. Mari kita wujudkan Desa Parangargo yang Bersih, Sehat, dan Nyaman.</p>

                <p class="font-bold">Hormat Kami,<br>Kepala Desa Parangargo</p>
            </div>

            <!-- Download PDF Section -->
            <div class="bg-emerald-50 rounded-[2rem] p-8 border border-emerald-100 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-6 text-center md:text-left">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm border border-emerald-100">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-black text-slate-900 leading-tight">Salinan Resmi Pengumuman</h4>
                        <p class="text-emerald-700 font-medium text-sm">PDF (1.2 MB) - Unduhan resmi untuk diarsipkan.</p>
                    </div>
                </div>
                <button class="w-full md:w-auto bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-lg shadow-emerald-200 transition-all flex items-center justify-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg> Unduh File
                </button>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-12">
            <!-- Information Box -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-6">
                <h3 class="text-xl font-black text-slate-900 italic uppercase">Status Info</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kategori</span>
                        <span class="text-xs font-black text-emerald-600 uppercase">Wajib Hadir</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 rounded-2xl">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Prioritas</span>
                        <div class="flex gap-1">
                            <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-red-500"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-slate-200"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Share -->
            <div class="p-8 bg-slate-900 rounded-[2.5rem] text-white space-y-6">
                <h3 class="text-xl font-black italic uppercase tracking-wider">Bagikan Info</h3>
                <div class="grid grid-cols-3 gap-3">
                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-2xl flex items-center justify-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                    </button>
                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-2xl flex items-center justify-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                    </button>
                    <button class="aspect-square bg-white/10 hover:bg-white/20 rounded-2xl flex items-center justify-center transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
