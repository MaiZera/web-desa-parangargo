@extends('layouts.main')

@section('content')
<div class="space-y-12 pb-12">
    <!-- Hero Slider -->
    <section class="relative h-[400px] md:h-[600px] overflow-hidden rounded-3xl group mx-4 mt-8" x-data="{ active: 0 }" x-init="setInterval(() => active = (active + 1) % 2, 5000)">
        <!-- Slide 1 -->
        <div class="absolute inset-0 transition-opacity duration-1000" :class="{ 'opacity-100': active === 0, 'opacity-0': active !== 0 }">
            <img alt="Selamat Datang di Desa Mandiri Jaya" class="w-full h-full object-cover" src="https://picsum.photos/seed/slide1/1200/600">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-8 md:p-16">
                <div class="max-w-2xl text-white space-y-4">
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight">Selamat Datang di Desa Mandiri Jaya</h1>
                    <p class="text-lg md:text-xl text-slate-200">Membangun masa depan desa yang lebih cerdas dan berdikari.</p>
                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-full font-semibold flex items-center gap-2 transition-all">
                        Lihat Selengkapnya 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-5 h-5" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="absolute inset-0 transition-opacity duration-1000" :class="{ 'opacity-100': active === 1, 'opacity-0': active !== 1 }">
            <img alt="Festival Budaya 2023" class="w-full h-full object-cover" src="https://picsum.photos/seed/slide2/1200/600">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-8 md:p-16">
                <div class="max-w-2xl text-white space-y-4">
                    <h1 class="text-4xl md:text-6xl font-bold leading-tight">Festival Budaya 2023</h1>
                    <p class="text-lg md:text-xl text-slate-200">Mari lestarikan warisan leluhur kita.</p>
                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-full font-semibold flex items-center gap-2 transition-all">
                        Lihat Selengkapnya 
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-5 h-5" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Indicators -->
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
            <button class="h-3 rounded-full transition-all bg-white" :class="active === 0 ? 'w-8' : 'w-3/50 opacity-50'" @click="active = 0"></button>
            <button class="h-3 rounded-full transition-all bg-white" :class="active === 1 ? 'w-8' : 'w-3/50 opacity-50'" @click="active = 1"></button>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="grid md:grid-cols-3 gap-6 px-4 max-w-7xl mx-auto">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex items-start gap-4">
            <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users w-6 h-6" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><path d="M16 3.128a4 4 0 0 1 0 7.744"></path><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><circle cx="9" cy="7" r="4"></circle></svg>
            </div>
            <div>
                <h3 class="font-bold text-lg">Penduduk</h3>
                <p class="text-3xl font-bold text-emerald-600 mt-1">4,250</p>
                <p class="text-sm text-slate-500">Jiwa Terdata</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex items-start gap-4">
            <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase w-6 h-6" aria-hidden="true"><path d="M16 20V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path><rect width="20" height="14" x="2" y="6" rx="2"></rect></svg>
            </div>
            <div>
                <h3 class="font-bold text-lg">UMKM Aktif</h3>
                <p class="text-3xl font-bold text-blue-600 mt-1">128</p>
                <p class="text-sm text-slate-500">Unit Usaha Lokal</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex items-start gap-4">
            <div class="p-3 bg-purple-100 text-purple-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-graduation-cap w-6 h-6" aria-hidden="true"><path d="M21.42 10.922a1 1 0 0 0-.019-1.838L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.832l8.57 3.908a2 2 0 0 0 1.66 0z"></path><path d="M22 10v6"></path><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-lg">Indeks Desa</h3>
                <p class="text-3xl font-bold text-purple-600 mt-1">Sangat Maju</p>
                <p class="text-sm text-slate-500">Kategori IDM</p>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-bold">Berita Terbaru</h2>
                <p class="text-slate-500">Informasi dan kabar terkini seputar desa.</p>
            </div>
            <a href="{{ url('/berita') }}" class="text-emerald-600 font-semibold hover:underline flex items-center gap-1">
                Semua Berita 
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right w-4 h-4" aria-hidden="true"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
            </a>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- News Card 1 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group cursor-pointer">
                <div class="h-48 overflow-hidden">
                    <img alt="Pembangunan Jalan Lingkar Desa Tahap 1 Selesai" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://picsum.photos/seed/village1/600/400">
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 15 Okt 2023 • Pembangunan
                    </div>
                    <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">Pembangunan Jalan Lingkar Desa Tahap 1 Selesai</h3>
                    <p class="text-slate-600 text-sm line-clamp-2">Pemerintah desa berhasil merampungkan pembangunan jalan lingkar sepanjang 2km untuk mempermudah akses tani.</p>
                </div>
            </div>
            <!-- News Card 2 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group cursor-pointer">
                <div class="h-48 overflow-hidden">
                    <img alt="Festival Budaya Mandiri Jaya 2023 Berlangsung Meriah" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://picsum.photos/seed/village2/600/400">
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 10 Okt 2023 • Budaya
                    </div>
                    <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">Festival Budaya Mandiri Jaya 2023 Berlangsung Meriah</h3>
                    <p class="text-slate-600 text-sm line-clamp-2">Ribuan warga memadati balai desa untuk menyaksikan pertunjukan seni tradisional tahunan.</p>
                </div>
            </div>
            <!-- News Card 3 -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group cursor-pointer">
                <div class="h-48 overflow-hidden">
                    <img alt="Pelatihan Digital Marketing untuk Pelaku UMKM" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="https://picsum.photos/seed/village3/600/400">
                </div>
                <div class="p-6 space-y-3">
                    <div class="flex items-center gap-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3" aria-hidden="true"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg> 05 Okt 2023 • Ekonomi
                    </div>
                    <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">Pelatihan Digital Marketing untuk Pelaku UMKM</h3>
                    <p class="text-slate-600 text-sm line-clamp-2">Puluhan pengusaha lokal diberikan pelatihan cara berjualan online menggunakan marketplace.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- UMKM Section -->
    <section class="max-w-7xl mx-auto px-4 mt-12">
        <div class="bg-emerald-900 rounded-[3rem] p-12 text-white">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl font-bold">UMKM Unggulan Desa</h2>
                <p class="text-emerald-200 mt-4 text-lg">Dukung produk lokal desa untuk kemandirian ekonomi kita bersama.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- UMKM Card 1 -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl overflow-hidden border border-white/10 group">
                    <img alt="Kripik Tempe Renyah Ibu Ani" class="h-56 w-full object-cover" src="https://picsum.photos/seed/food1/600/400">
                    <div class="p-6">
                        <p class="text-emerald-400 text-xs font-bold uppercase mb-2">Makanan/Minuman</p>
                        <h3 class="text-xl font-bold mb-2">Kripik Tempe Renyah Ibu Ani</h3>
                        <p class="text-emerald-100/70 text-sm mb-4">Kripik tempe dengan resep turun temurun tanpa pengawet.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium">Oleh: Ibu Ani</span>
                            <button class="bg-white text-emerald-900 px-4 py-2 rounded-lg font-bold text-sm hover:bg-emerald-100 transition-colors">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                <!-- UMKM Card 2 -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl overflow-hidden border border-white/10 group">
                    <img alt="Anyaman Bambu Kreatif Mandiri" class="h-56 w-full object-cover" src="https://picsum.photos/seed/craft1/600/400">
                    <div class="p-6">
                        <p class="text-emerald-400 text-xs font-bold uppercase mb-2">Kerajinan</p>
                        <h3 class="text-xl font-bold mb-2">Anyaman Bambu Kreatif Mandiri</h3>
                        <p class="text-emerald-100/70 text-sm mb-4">Tas dan perabotan rumah tangga dari bambu kualitas premium.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium">Oleh: Pak Slamet</span>
                            <button class="bg-white text-emerald-900 px-4 py-2 rounded-lg font-bold text-sm hover:bg-emerald-100 transition-colors">Lihat Detail</button>
                        </div>
                    </div>
                </div>
                <!-- UMKM Card 3 -->
                <div class="bg-white/10 backdrop-blur-md rounded-2xl overflow-hidden border border-white/10 group">
                    <img alt="Madu Hutan Murni Lestari" class="h-56 w-full object-cover" src="https://picsum.photos/seed/honey1/600/400">
                    <div class="p-6">
                        <p class="text-emerald-400 text-xs font-bold uppercase mb-2">Pertanian</p>
                        <h3 class="text-xl font-bold mb-2">Madu Hutan Murni Lestari</h3>
                        <p class="text-emerald-100/70 text-sm mb-4">Madu asli dari hutan lindung sekitar desa.</p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm font-medium">Oleh: Kelompok Tani 2</span>
                            <button class="bg-white text-emerald-900 px-4 py-2 rounded-lg font-bold text-sm hover:bg-emerald-100 transition-colors">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
