@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-5xl mx-auto space-y-12">
    <!-- Breadcrumb -->
    <nav class="flex text-sm font-medium text-slate-400 gap-2 mb-8">
        <a href="{{ route('home') }}" class="hover:text-emerald-600">Home</a>
        <span>/</span>
        <a href="{{ route('news') }}" class="hover:text-emerald-600">Berita</a>
        <span>/</span>
        <span class="text-slate-900 line-clamp-1">Detail Berita</span>
    </nav>

    <!-- Post Header -->
    <div class="space-y-6">
        <div class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold uppercase tracking-wider">
            Kabar Desa
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-slate-900 leading-tight tracking-tight">Pembangunan Jalan Lingkar Desa Tahap 1 Selesai</h1>
        
        <div class="flex flex-wrap items-center gap-6 text-sm text-slate-500 border-y border-slate-100 py-6 font-medium">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <span>Admin Desa</span>
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                <span>28 Januari 2026</span>
            </div>
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-slate-400"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0z"/><circle cx="12" cy="12" r="3"/></svg>
                <span>1,2k Dilihat</span>
            </div>
        </div>
    </div>

    <!-- Featured Image -->
    <div class="aspect-video rounded-[2.5rem] overflow-hidden shadow-2xl border border-slate-100 relative group">
        <img src="https://picsum.photos/seed/news_detail/1200/800" alt="News Image" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
    </div>

    <!-- Article Content -->
    <div class="grid lg:grid-cols-3 gap-16">
        <div class="lg:col-span-2">
            <div class="prose prose-lg prose-slate max-w-none prose-headings:text-slate-900 prose-headings:font-black prose-p:leading-relaxed prose-p:text-slate-600">
                <p class="text-xl font-medium text-slate-700 italic border-l-4 border-emerald-500 pl-6 my-10 bg-slate-50 py-8 rounded-r-2xl">
                    "Pembangunan infrastruktur yang merata menjadi kunci utama dalam mempercepat roda perekonomian warga Desa Parangargo."
                </p>
                
                <p>Desa Parangargo kembali mencatat tonggak sejarah baru dalam pembangunan infrastruktur. Pembangunan jalan lingkar desa tahap pertama yang menghubungkan berbagai dusun akhirnya resmi diselesaikan tepat waktu. Jalan sepanjang kurang lebih 2,5 kilometer ini kini sudah bisa dilalui oleh kendaraan roda dua maupun roda empat.</p>
                
                <h3>Dampak Positif Bagi Petani</h3>
                <p>Sebelum adanya jalan lingkar ini, para petani harus memutar jauh untuk membawa hasil bumi mereka ke pasar. Dengan adanya akses baru ini, waktu tempuh dapat dipangkas hingga 50%, yang secara langsung berdampak pada efisiensi biaya logistik pertanian di desa kita.</p>
                
                <div class="grid grid-cols-2 gap-4 my-12">
                    <img src="https://picsum.photos/seed/news1/600/400" class="rounded-3xl shadow-lg border border-slate-100" alt="Dokumentasi 1">
                    <img src="https://picsum.photos/seed/news2/600/400" class="rounded-3xl shadow-lg border border-slate-100" alt="Dokumentasi 2">
                </div>

                <p>Kepala Desa Parangargo menyatakan bahwa proyek ini merupakan hasil dari musyawarah perencanaan pembangunan desa (Musrenbangdes) tahun lalu. Sumber dana yang digunakan berasal dari Dana Desa TA 2025 yang dikelola secara transparan dan melibatkan tenaga kerja lokal melalui sistem Padat Karya Tunai Desa (PKTD).</p>

                <h3>Rencana Tahap Kedua</h3>
                <p>Pemerintah desa berencana untuk melanjutkan pembangunan tahap kedua pada pertengahan tahun ini. Tahap selanjutnya akan difokuskan pada pengerasan jalan (hotmix) dan pembangunan drainase di sisi kiri dan kanan jalan untuk menjaga keawetan infrastruktur dari genangan air hujan.</p>
            </div>

            <!-- Share & Navigation -->
            <div class="mt-20 pt-10 border-t border-slate-100 space-y-12">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-6">
                    <p class="text-xs font-black text-slate-400 uppercase tracking-[0.2em]">Bagikan Berita Ini</p>
                    <div class="flex gap-4">
                        <button class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </button>
                        <button class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                        </button>
                        <button class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400 hover:bg-emerald-600 hover:text-white transition-all shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/></svg>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <a href="#" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 hover:bg-white hover:shadow-xl transition-all group">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Sebelumnya</span>
                        <h4 class="font-bold text-slate-900 line-clamp-1 group-hover:text-emerald-600">Pelatihan Digital Marketing UMKM</h4>
                    </a>
                    <a href="#" class="p-8 bg-slate-50 rounded-[2rem] border border-slate-100 hover:bg-white hover:shadow-xl transition-all group text-right">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Selanjutnya</span>
                        <h4 class="font-bold text-slate-900 line-clamp-1 group-hover:text-emerald-600">Hasil Rapat Pleno Musyawarah Desa</h4>
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-12">
            <!-- Latest Posts -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-xl font-black text-slate-900 italic uppercase">Kabar Terkini</h3>
                <div class="space-y-8">
                    @for($i=1; $i<=3; $i++)
                    <a href="#" class="flex gap-4 group">
                        <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden bg-slate-100">
                            <img src="https://picsum.photos/seed/side{{$i}}/200/200" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-sm font-bold text-slate-900 leading-tight group-hover:text-emerald-600 line-clamp-2">Update Pembangunan Posyandu Terintegrasi Tahap {{ $i }}</h4>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">25 Jan 2026</p>
                        </div>
                    </a>
                    @endfor
                </div>
                <a href="{{ route('news') }}" class="block w-full text-center py-4 rounded-2xl bg-slate-900 text-white font-black text-[10px] uppercase tracking-widest hover:bg-slate-800 shadow-lg shadow-slate-900/20 transition-all">Lihat Semua Berita</a>
            </div>

            <!-- Mini CTA -->
            <div class="bg-emerald-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full translate-x-10 -translate-y-10 group-hover:scale-150 transition-all duration-1000"></div>
                <div class="relative z-10 space-y-6">
                    <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                    </div>
                    <div>
                        <h4 class="text-xl font-black">Layanan Mandiri</h4>
                        <p class="text-emerald-200/80 text-sm mt-2 leading-relaxed">Urus surat menyurat lebih cepat melalui portal online kami.</p>
                    </div>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 bg-white text-emerald-900 px-6 py-3 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-emerald-50 transition-colors">Buka Portal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
