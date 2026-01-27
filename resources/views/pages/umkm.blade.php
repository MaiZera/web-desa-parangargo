@extends('layouts.main')

@section('content')
<div x-data="umkmApp()" class="w-full">
    <!-- Light Header Section -->
    <div class="bg-white pt-32 pb-24 border-b border-slate-100 relative overflow-hidden">
        <!-- Subtle floating shapes -->
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div class="max-w-xl">
                    <div class="inline-block px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-widest mb-6 border border-emerald-100">Directory Lokal</div>
                    <h1 class="text-5xl md:text-7xl font-black leading-tight mb-4 tracking-tighter text-slate-900">Ekonomi &amp; UMKM Desa</h1>
                    <p class="text-xl text-slate-500 leading-relaxed max-w-lg">Temukan beragam produk unggulan karya warga Desa Parangargo. Bersama kembangkan ekonomi desa.</p>
                </div>
                <div class="flex gap-4">
                    <div class="relative group">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5 group-focus-within:text-emerald-500 transition-colors" aria-hidden="true"><path d="m21 21-4.34-4.34"></path><circle cx="11" cy="11" r="8"></circle></svg>
                        <input 
                            placeholder="Cari UMKM atau produk..." 
                            x-model="search" 
                            @input.debounce.500ms="fetchUmkms()"
                            class="pl-12 pr-6 py-5 bg-slate-50 border border-slate-200 rounded-[2rem] focus:ring-2 focus:ring-emerald-500 outline-none min-w-[320px] text-slate-900 transition-all shadow-sm" 
                            type="text">
                    </div>
                </div>
            </div>
            
            <!-- Category Filter -->
            <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide mt-16 border-t border-slate-100 pt-10">
                <template x-for="cat in categories" :key="cat">
                    <button 
                        @click="setCategory(cat)"
                        class="px-8 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shrink-0 whitespace-nowrap border"
                        :class="category === cat ? 'bg-emerald-600 text-white border-emerald-500 shadow-xl shadow-emerald-500/20' : 'bg-slate-50 text-slate-500 hover:text-slate-900 border-slate-200 hover:bg-slate-100'"
                        x-text="cat">
                    </button>
                </template>
            </div>
        </div>
    </div>

    <!-- Results Grid -->
    <div class="max-w-7xl mx-auto px-4 py-24">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Loading Indicator -->
            <template x-if="loading">
                <template x-for="i in 6" :key="i">
                    <div class="bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm animate-pulse h-[500px]"></div>
                </template>
            </template>

            <!-- No Results message -->
            <template x-if="!loading && items.length === 0">
                <div class="col-span-full py-32 text-center">
                    <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                    <p class="text-2xl font-black text-slate-900">Belum ada UMKM yang muncul</p>
                    <p class="text-slate-500 mt-2 text-lg">Coba ubah filter atau kata kunci pencarian Anda.</p>
                </div>
            </template>

            <!-- Cards -->
            <template x-for="item in items" :key="item.id">
                <div 
                    @click="openDetail(item)"
                    class="bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group cursor-pointer flex flex-col">
                    <div class="relative h-80 overflow-hidden shrink-0">
                        <img :src="item.foto_produk" :alt="item.nama_usaha" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s]">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute top-8 left-8 bg-white/90 backdrop-blur px-5 py-2 rounded-full text-[10px] font-black text-emerald-600 uppercase tracking-widest shadow-xl" x-text="item.kategori"></div>
                    </div>
                    <div class="p-10 flex flex-col justify-between flex-1">
                        <div class="space-y-4">
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none" x-text="item.nama_pemilik"></h4>
                            <h3 class="text-3xl font-black text-slate-900 leading-tight group-hover:text-emerald-600 transition-colors" x-text="item.nama_usaha"></h3>
                            <p class="text-slate-500 line-clamp-2 text-sm leading-relaxed" x-text="item.deskripsi"></p>
                        </div>
                        <div class="mt-10 pt-8 border-t border-slate-50 flex items-center justify-between">
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Mulai Dari</p>
                                <p class="text-2xl font-black text-emerald-600" x-text="item.kisaran_harga"></p>
                            </div>
                            <button class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center transform group-hover:rotate-[360deg] group-hover:bg-emerald-600 transition-all duration-700 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right"><path d="M7 7h10v10"/><path d="M17 7 7 17"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- Custom Floating Detail Modal (Recreated from Image) -->
    <div 
        x-show="isDetailOpen" 
        class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-6"
        x-cloak
        style="display: none;">
        
        <!-- Backdrop -->
        <div 
            x-show="isDetailOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="closeDetail()"
            class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

        <!-- Modal Box -->
        <div 
            class="relative w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden shadow-2xl flex flex-col md:flex-row h-[90vh] md:h-[80vh]"
            x-show="isDetailOpen"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="scale-95 translate-y-8 opacity-0"
            x-transition:enter-end="scale-100 translate-y-0 opacity-100"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="scale-100 translate-y-0 opacity-100"
            x-transition:leave-end="scale-95 translate-y-8 opacity-0">
            
            <!-- Left Side: Image & Business Info Overlay -->
            <div class="md:w-[45%] h-64 md:h-full relative shrink-0">
                <img :src="selectedItem?.foto_produk" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/30 to-transparent"></div>
                
                <div class="absolute bottom-10 left-10 right-10 text-white space-y-4">
                    <span class="inline-block px-4 py-1.5 bg-emerald-500 text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg" x-text="selectedItem?.kategori"></span>
                    <h2 class="text-4xl md:text-5xl font-black leading-tight tracking-tighter" x-text="selectedItem?.nama_usaha"></h2>
                </div>

                <!-- Close Button for Mobile -->
                <button @click="closeDetail()" class="md:hidden absolute top-6 right-6 bg-white/20 backdrop-blur-md p-3 rounded-full text-white border border-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>

            <!-- Right Side: Navigation & Content -->
            <div class="md:w-[55%] flex flex-col h-full bg-white relative overflow-hidden">
                <!-- Navigation Tabs -->
                <div class="flex items-center px-10 pt-10 gap-8 border-b border-slate-50 overflow-x-auto scrollbar-hide shrink-0 bg-white z-10">
                    <button @click="activeTab = 'produk'" :class="activeTab === 'produk' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Produk</button>
                    <button @click="activeTab = 'pemilik'" :class="activeTab === 'pemilik' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Pemilik</button>
                    <button @click="activeTab = 'kontak'" :class="activeTab === 'kontak' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Kontak</button>
                    <!-- <button @click="activeTab = 'ulasan'" :class="activeTab === 'ulasan' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Ulasan</button> -->
                    <button @click="activeTab = 'jadwal'" :class="activeTab === 'jadwal' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Jadwal</button>
                </div>

                <!-- Scrollable Content -->
                <div class="flex-1 overflow-y-auto p-10 md:p-12 custom-scrollbar">
                    
                    <!-- 1. Produk Tab Content -->
                    <div x-show="activeTab === 'produk'" x-transition class="space-y-10">
                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-4">Tentang Produk</h4>
                            <div class="p-8 bg-slate-50 border border-slate-100 rounded-[2rem]">
                                <p class="text-slate-700 leading-relaxed italic text-lg" x-text="selectedItem?.deskripsi"></p>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-4">Produk & Layanan</h4>
                            <div class="flex flex-wrap gap-3">
                                <template x-for="p in (selectedItem?.produk_layanan || '').split(',')" :key="p">
                                    <span class="bg-emerald-50 text-emerald-700 px-6 py-3 rounded-2xl text-sm font-black border border-emerald-100 shadow-sm" x-text="p.trim()"></span>
                                </template>
                            </div>
                        </div>

                        <!-- Price Section (Signature Emerald Box) -->
                        <div class="bg-emerald-700 p-10 rounded-[2.5rem] text-white shadow-2xl shadow-emerald-200/50">
                            <p class="opacity-70 text-[10px] font-black uppercase tracking-widest mb-2">Estimasi Harga</p>
                            <p class="text-5xl font-black tracking-tighter" x-text="selectedItem?.kisaran_harga"></p>
                            <p class="text-[10px] mt-6 opacity-40 italic font-medium">* Harga dasar dapat berubah sesuai volume pesanan atau kustomisasi.</p>
                        </div>
                    </div>

                    <!-- 2. Pemilik Tab -->
                    <div x-show="activeTab === 'pemilik'" x-transition style="display: none;" class="space-y-8">
                        <div class="flex items-center gap-8 p-10 bg-slate-50 rounded-[2.5rem] border border-slate-100">
                            <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center text-4xl font-black text-emerald-600 shadow-xl" x-text="selectedItem?.nama_pemilik?.charAt(0)"></div>
                            <div>
                                <h4 class="text-3xl font-black text-slate-900 tracking-tight" x-text="selectedItem?.nama_pemilik"></h4>
                                <p class="text-emerald-600 font-black text-[10px] uppercase tracking-[0.2em] mt-1">Social Partner Desa</p>
                            </div>
                        </div>
                        <div class="p-10 bg-emerald-50/30 rounded-[2.5rem] border border-emerald-100/50 text-center">
                            <p class="text-slate-500 italic text-xl leading-relaxed">"Melayani sepenuh hati untuk kemajuan ekonomi warga Desa Parangargo."</p>
                        </div>
                    </div>

                    <!-- 3. Kontak Tab -->
                    <div x-show="activeTab === 'kontak'" x-transition style="display: none;" class="space-y-6">
                        <div class="p-10 bg-slate-50 rounded-[2.5rem] border border-slate-100 flex items-start gap-8">
                            <div class="p-4 bg-white rounded-2xl shadow-md text-emerald-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg></div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Titik Lokasi</p>
                                <p class="text-slate-800 font-black text-xl leading-tight" x-text="selectedItem?.alamat"></p>
                            </div>
                        </div>
                        <div class="p-10 bg-slate-50 rounded-[2.5rem] border border-slate-100 flex items-start gap-8">
                            <div class="p-4 bg-white rounded-2xl shadow-md text-emerald-600"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg></div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">WhatsApp Fast Response</p>
                                <p class="text-slate-800 font-black text-xl leading-tight" x-text="selectedItem?.whatsapp"></p>
                            </div>
                        </div>
                        <a :href="'https://wa.me/' + (selectedItem?.whatsapp || '').replace(/\D/g,'')" target="_blank" class="block w-full bg-emerald-600 text-white text-center py-6 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-emerald-700 transition-all transform hover:scale-[1.02] shadow-2xl shadow-emerald-200">Kirim Pesan Sekarang</a>
                    </div>

                    <!-- 4. Ulasan (Dummy) -->
                    <!-- <div x-show="activeTab === 'ulasan'" x-transition style="display: none;" class="text-center py-20 flex flex-col items-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-slate-300"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
                        </div>
                        <p class="text-slate-400 font-bold uppercase text-[10px] tracking-widest">Belum ada ulasan publik</p>
                    </div> -->

                    <!-- 5. Jadwal (Dummy) -->
                    <div x-show="activeTab === 'jadwal'" x-transition style="display: none;" class="space-y-4">
                        <div class="flex justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 text-sm"><span class="font-black text-slate-900 uppercase text-xs tracking-widest">Senin - Jumat</span> <span class="text-emerald-600 font-black">08:00 - 17:00</span></div>
                        <div class="flex justify-between p-6 bg-slate-50 rounded-2xl border border-slate-100 text-sm"><span class="font-black text-slate-900 uppercase text-xs tracking-widest">Sabtu</span> <span class="text-emerald-600 font-black">09:00 - 15:00</span></div>
                        <div class="flex justify-between p-6 bg-red-50 rounded-2xl border border-red-100 text-sm"><span class="font-black text-red-900 uppercase text-xs tracking-widest">Minggu</span> <span class="text-red-500 font-black">Tutup</span></div>
                    </div>

                </div>

                <!-- Floating Close Button (Desktop) -->
                <button @click="closeDetail()" class="hidden md:flex absolute top-10 right-10 z-50 bg-slate-50 hover:bg-white text-slate-400 hover:text-slate-900 p-4 rounded-full transition-all border border-slate-100 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function umkmApp() {
        return {
            items: [],
            loading: true,
            category: 'Semua',
            search: '',
            categories: ['Semua', 'Makanan/Minuman', 'Kerajinan', 'Pertanian', 'Jasa/Layanan'],
            isDetailOpen: false,
            selectedItem: null,
            activeTab: 'produk',

            async init() {
                await this.fetchUmkms();
            },

            async fetchUmkms() {
                this.loading = true;
                try {
                    const url = new URL(window.location.origin + '/api/umkms');
                    if (this.category !== 'Semua') url.searchParams.append('kategori', this.category);
                    if (this.search) url.searchParams.append('search', this.search);
                    
                    const response = await fetch(url);
                    const result = await response.json();
                    this.items = result.data;
                } catch (error) {
                    console.error('Error fetching UMKM:', error);
                    // Standard Fallback data
                    this.items = [
                        { id: 1, nama_usaha: 'Kripik Tempe Renyah Ibu Ani', nama_pemilik: 'Ibu Ani', kategori: 'Makanan/Minuman', deskripsi: 'Kripik tempe dengan resep turun temurun tanpa pengawet.', produk_layanan: 'Kripik Tempe Original, Kripik Tempe Balado', alamat: 'Dusun Utara RT 01 RW 02', whatsapp: '6281234567890', foto_produk: 'https://picsum.photos/seed/food1/800/600', kisaran_harga: 'Rp 5.000 - Rp 25.000' },
                        { id: 2, nama_usaha: 'Anyaman Bambu Kreatif Mandiri', nama_pemilik: 'Pak Slamet', kategori: 'Kerajinan', deskripsi: 'Tas dan perabotan rumah tangga dari bambu kualitas premium.', produk_layanan: 'Tas Bambu, Tampah, Keranjang Buah', alamat: 'Dusun Selatan RT 04 RW 01', whatsapp: '6281234567891', foto_produk: 'https://picsum.photos/seed/craft1/800/600', kisaran_harga: 'Rp 15.000 - Rp 150.000' },
                        { id: 3, nama_usaha: 'Madu Hutan Murni Lestari', nama_pemilik: 'Kelompok Tani 2', kategori: 'Pertanian', deskripsi: 'Madu asli dari hutan lindung sekitar desa.', produk_layanan: 'Madu Randu, Madu Kaliandra', alamat: 'Lereng Gunung Parangargo', whatsapp: '6281234567892', foto_produk: 'https://picsum.photos/seed/honey1/800/600', kisaran_harga: 'Rp 45.000 - Rp 200.000' }
                    ];
                } finally {
                    this.loading = false;
                }
            },

            setCategory(cat) {
                this.category = cat;
                this.fetchUmkms();
            },

            openDetail(item) {
                this.selectedItem = item;
                this.activeTab = 'produk';
                this.isDetailOpen = true;
                document.body.style.overflow = 'hidden';
            },

            closeDetail() {
                this.isDetailOpen = false;
                document.body.style.overflow = 'auto';
            }
        }
    }
</script>
@endpush
@endsection
