@extends('layouts.main')

@section('content')
<div class="py-12 px-4 max-w-7xl mx-auto space-y-12">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
        <div class="max-w-xl">
            <h1 class="text-4xl font-bold mb-4">Ekonomi &amp; UMKM Desa</h1>
            <p class="text-lg text-slate-600">Katalog produk dan jasa unggulan karya warga Desa Mandiri Jaya. Beli produk lokal, bantu ekonomi desa.</p>
        </div>
        <div class="flex gap-4">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 w-4 h-4" aria-hidden="true"><path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>
                <input placeholder="Cari produk..." class="pl-10 pr-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none min-w-[300px]" type="text">
            </div>
        </div>
    </div>
    
    <div class="flex gap-2 overflow-x-auto pb-4 scrollbar-hide">
        <button class="px-6 py-2 rounded-full font-semibold text-sm transition-all shrink-0 bg-emerald-600 text-white shadow-lg">Semua</button>
        <button class="px-6 py-2 rounded-full font-semibold text-sm transition-all shrink-0 bg-white text-slate-600 hover:bg-slate-50">Makanan/Minuman</button>
        <button class="px-6 py-2 rounded-full font-semibold text-sm transition-all shrink-0 bg-white text-slate-600 hover:bg-slate-50">Kerajinan</button>
        <button class="px-6 py-2 rounded-full font-semibold text-sm transition-all shrink-0 bg-white text-slate-600 hover:bg-slate-50">Pertanian</button>
        <button class="px-6 py-2 rounded-full font-semibold text-sm transition-all shrink-0 bg-white text-slate-600 hover:bg-slate-50">Jasa/Layanan</button>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
        <!-- UMKM Card 1 -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all group cursor-pointer">
            <div class="relative">
                <img alt="Kripik Tempe Renyah Ibu Ani" class="w-full h-64 object-cover" src="https://picsum.photos/seed/food1/600/400">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-emerald-600">Makanan/Minuman</div>
            </div>
            <div class="p-8 space-y-4">
                <h3 class="text-2xl font-bold group-hover:text-emerald-600 transition-colors">Kripik Tempe Renyah Ibu Ani</h3>
                <p class="text-slate-600 text-sm">Kripik tempe dengan resep turun temurun tanpa pengawet.</p>
                <div class="pt-4 border-t border-slate-100 space-y-3">
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4 text-emerald-500" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg> Pemilik: Ibu Ani
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4" aria-hidden="true"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path></svg> +62 812-3456-7890
                    </div>
                </div>
                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-bold transition-colors flex items-center justify-center gap-2">
                    Lihat Detail 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
                </button>
            </div>
        </div>
        <!-- UMKM Card 2 -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all group cursor-pointer">
            <div class="relative">
                <img alt="Anyaman Bambu Kreatif Mandiri" class="w-full h-64 object-cover" src="https://picsum.photos/seed/craft1/600/400">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-emerald-600">Kerajinan</div>
            </div>
            <div class="p-8 space-y-4">
                <h3 class="text-2xl font-bold group-hover:text-emerald-600 transition-colors">Anyaman Bambu Kreatif Mandiri</h3>
                <p class="text-slate-600 text-sm">Tas dan perabotan rumah tangga dari bambu kualitas premium.</p>
                <div class="pt-4 border-t border-slate-100 space-y-3">
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4 text-emerald-500" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg> Pemilik: Pak Slamet
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4" aria-hidden="true"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path></svg> +62 812-3456-7890
                    </div>
                </div>
                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-bold transition-colors flex items-center justify-center gap-2">
                    Lihat Detail 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
                </button>
            </div>
        </div>
        <!-- UMKM Card 3 -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl transition-all group cursor-pointer">
            <div class="relative">
                <img alt="Madu Hutan Murni Lestari" class="w-full h-64 object-cover" src="https://picsum.photos/seed/honey1/600/400">
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-emerald-600">Pertanian</div>
            </div>
            <div class="p-8 space-y-4">
                <h3 class="text-2xl font-bold group-hover:text-emerald-600 transition-colors">Madu Hutan Murni Lestari</h3>
                <p class="text-slate-600 text-sm">Madu asli dari hutan lindung sekitar desa.</p>
                <div class="pt-4 border-t border-slate-100 space-y-3">
                    <div class="flex items-center gap-2 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4 text-emerald-500" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg> Pemilik: Kelompok Tani 2
                    </div>
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone w-4 h-4" aria-hidden="true"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"></path></svg> +62 812-3456-7890
                    </div>
                </div>
                <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-bold transition-colors flex items-center justify-center gap-2">
                    Lihat Detail 
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag w-4 h-4" aria-hidden="true"><path d="M16 10a4 4 0 0 1-8 0"></path><path d="M3.103 6.034h17.794"></path><path d="M3.4 5.467a2 2 0 0 0-.4 1.2V20a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6.667a2 2 0 0 0-.4-1.2l-2-2.667A2 2 0 0 0 17 2H7a2 2 0 0 0-1.6.8z"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
