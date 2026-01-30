@extends('layouts.main')

@section('content')
<div x-data="umkmDetailData()" 
     @open-detail.window="open( $event.detail )" 
     @close-detail.window="close()"
     class="w-full">
        <!-- Light Header Section -->
        <div class="bg-white pt-32 pb-24 border-b border-slate-100 relative overflow-hidden">
            <!-- Subtle floating shapes -->
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/5 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl"></div>

            <div class="max-w-7xl mx-auto px-4 relative z-10">
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                    <div class="max-w-xl">
                        <div
                            class="inline-block px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-widest mb-6 border border-emerald-100">
                            Directory Lokal</div>
                        <h1 class="text-5xl md:text-7xl font-black leading-tight mb-4 tracking-tighter text-slate-900">
                            Ekonomi &amp; UMKM Desa</h1>
                        <p class="text-xl text-slate-500 leading-relaxed max-w-lg">Temukan beragam produk unggulan karya
                            warga Desa Parangargo. Bersama kembangkan ekonomi desa.</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 w-5 h-5 group-focus-within:text-emerald-500 transition-colors"
                                aria-hidden="true">
                                <path d="m21 21-4.34-4.34"></path>
                                <circle cx="11" cy="11" r="8"></circle>
                            </svg>
                            <input id="search-input" placeholder="Cari UMKM atau produk..."
                                class="pl-12 pr-6 py-5 bg-slate-50 border border-slate-200 rounded-[2rem] focus:ring-2 focus:ring-emerald-500 outline-none min-w-[320px] text-slate-900 transition-all shadow-sm"
                                type="text">
                        </div>
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="flex gap-3 overflow-x-auto pb-4 scrollbar-hide mt-16 border-t border-slate-100 pt-10">
                    <button onclick="filterUmkm('Semua')"
                        class="filter-btn active px-8 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shrink-0 whitespace-nowrap border bg-emerald-600 text-white border-emerald-500 shadow-xl shadow-emerald-500/20"
                        data-category="Semua">
                        Semua
                    </button>
                    @foreach($categories as $cat)
                        <button onclick="filterUmkm('{{ $cat }}')"
                            class="filter-btn px-8 py-3.5 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all shrink-0 whitespace-nowrap border bg-slate-50 text-slate-500 hover:text-slate-900 border-slate-200 hover:bg-slate-100"
                            data-category="{{ $cat }}">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Results Grid -->
        <div class="max-w-7xl mx-auto px-4 py-24">
            <div id="umkm-container" class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @include('pages.partials.umkm-list', ['umkms' => $umkms])
            </div>
        </div>

        <!-- Custom Floating Detail Modal (Recreated from Image) -->
        <div x-show="isDetailOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 md:p-6" x-cloak
            style="display: none;">

            <!-- Backdrop -->
            <div x-show="isDetailOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="closeDetail()"
                class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

            <!-- Modal Box -->
            <div class="relative w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden shadow-2xl flex flex-col md:flex-row h-[90vh] md:h-[80vh]"
                x-show="isDetailOpen" x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="scale-95 translate-y-8 opacity-0"
                x-transition:enter-end="scale-100 translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="scale-100 translate-y-0 opacity-100"
                x-transition:leave-end="scale-95 translate-y-8 opacity-0">

                <!-- Left Side: Image & Business Info Overlay -->
                <div class="md:w-[45%] h-64 md:h-full relative shrink-0">
                    <img :src="selectedItem?.image_url" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/30 to-transparent"></div>

                    <div class="absolute bottom-10 left-10 right-10 text-white space-y-4">
                        <span
                            class="inline-block px-4 py-1.5 bg-emerald-500 text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg"
                            x-text="selectedItem?.kategori"></span>
                        <h2 class="text-4xl md:text-5xl font-black leading-tight tracking-tighter"
                            x-text="selectedItem?.nama_usaha"></h2>
                    </div>

                    <!-- Close Button for Mobile -->
                    <button @click="isDetailOpen = false"
                        class="md:hidden absolute top-6 right-6 bg-white/20 backdrop-blur-md p-3 rounded-full text-white border border-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Right Side: Navigation & Content -->
                <div class="md:w-[55%] flex flex-col h-full bg-white relative overflow-hidden">
                    <!-- Navigation Tabs -->
                    <div
                        class="flex items-center px-10 pt-10 gap-8 border-b border-slate-50 overflow-x-auto scrollbar-hide shrink-0 bg-white z-10">
                        <button @click="activeTab = 'produk'"
                            :class="activeTab === 'produk' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'"
                            class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Produk</button>
                        <button @click="activeTab = 'pemilik'"
                            :class="activeTab === 'pemilik' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'"
                            class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Pemilik</button>
                        <button @click="activeTab = 'kontak'"
                            :class="activeTab === 'kontak' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'"
                            class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Kontak</button>
                        <!-- <button @click="activeTab = 'ulasan'" :class="activeTab === 'ulasan' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'" class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Ulasan</button> -->
                        <button @click="activeTab = 'jadwal'"
                            :class="activeTab === 'jadwal' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'"
                            class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Jadwal</button>
                    </div>

                    <!-- Scrollable Content -->
                    <div class="flex-1 overflow-y-auto p-10 md:p-12 custom-scrollbar">

                        <!-- 1. Produk Tab Content -->
                        <div x-show="activeTab === 'produk'" x-transition class="space-y-10">
                            <div>
                                <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-4">Tentang
                                    Produk</h4>
                                <div class="p-8 bg-emerald-50 border border-emerald-100 rounded-[2rem] shadow-lg">
                                    <p class="text-emerald-800 leading-relaxed italic text-lg"
                                        x-text="selectedItem?.deskripsi"></p>
                                </div>
                            </div>

                            <div>
                                <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-4">Produk &
                                    Layanan</h4>
                                <div class="flex flex-wrap gap-3">
                                    <template
                                        x-for="p in (Array.isArray(selectedItem?.produk_layanan) ? selectedItem?.produk_layanan : (selectedItem?.produk_layanan || '').split(','))"
                                        :key="p">
                                        <span
                                            class="bg-emerald-50 text-emerald-700 px-6 py-3 rounded-2xl text-sm font-black border border-emerald-100 shadow-sm"
                                            x-text="p"></span>
                                    </template>
                                </div>
                            </div>

                            <!-- Price Section (Signature Emerald Box) -->
                            <div class="bg-emerald-700 p-10 rounded-[2.5rem] text-white shadow-2xl shadow-emerald-200/50">
                                <p class="opacity-70 text-[10px] font-black uppercase tracking-widest mb-2">Estimasi Harga
                                </p>
                                <!-- Use the accessor value if available, or format manually if needed. Model accessor is 'kisaran_harga' -->
                                <p class="text-5xl font-black tracking-tighter"
                                    x-text="selectedItem?.kisaran_harga || 'Hubungi Penjual'"></p>
                                <p class="text-[10px] mt-6 opacity-40 italic font-medium">* Harga dasar dapat berubah sesuai
                                    volume pesanan atau kustomisasi.</p>
                            </div>
                        </div>

                        <!-- 2. Pemilik Tab -->
                        <div x-show="activeTab === 'pemilik'" x-transition style="display: none;" class="space-y-8">
                            <div class="flex items-center gap-8 p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 shadow-lg">
                                <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center text-4xl font-black text-emerald-600 shadow-xl"
                                    x-text="selectedItem?.nama_pemilik?.charAt(0)"></div>
                                <div>
                                    <h4 class="text-3xl font-black text-slate-900 tracking-tight"
                                        x-text="selectedItem?.nama_pemilik"></h4>
                                    <p class="text-emerald-600 font-black text-[10px] uppercase tracking-[0.2em] mt-1">
                                        Social Partner Desa</p>
                                </div>
                            </div>
                            <div class="p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 shadow-lg text-center">
                                <p class="text-slate-500 italic text-xl leading-relaxed">"Melayani sepenuh hati untuk
                                    kemajuan ekonomi warga Desa Parangargo."</p>
                            </div>
                        </div>

                        <!-- 3. Kontak Tab -->
                        <div x-show="activeTab === 'kontak'" x-transition style="display: none;" class="space-y-6">
                            <div class="p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 flex items-start gap-8 shadow-lg">
                                <div class="p-4 bg-white rounded-2xl shadow-md text-emerald-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg></div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Titik
                                        Lokasi</p>
                                    <p class="text-slate-800 font-black text-xl leading-tight"
                                        x-text="selectedItem?.alamat"></p>
                                </div>
                            </div>
                            <div class="p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 flex items-start gap-8 shadow-lg">
                                <div class="p-4 bg-white rounded-2xl shadow-md text-emerald-600"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" />
                                    </svg></div>
                                <div>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">WhatsApp
                                        Fast Response</p>
                                    <p class="text-slate-800 font-black text-xl leading-tight"
                                        x-text="selectedItem?.whatsapp"></p>
                                </div>
                            </div>
                            <a :href="'https://wa.me/' + (selectedItem?.whatsapp || '').replace(/\D/g,'')" target="_blank"
                                class="block w-full bg-emerald-600 text-white text-center py-6 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-emerald-700 transition-all transform hover:scale-[1.02] shadow-2xl shadow-emerald-200">Kirim
                                Pesan Sekarang</a>
                        </div>

                        <!-- 5. Jadwal (Dynamic) -->
                        <div x-show="activeTab === 'jadwal'" x-transition style="display: none;" class="space-y-4">
                            <template x-if="groupedSchedule.length > 0">
                                <template x-for="group in groupedSchedule" :key="group.days">
                                    <div class="flex justify-between p-6 bg-emerald-50 rounded-2xl border border-emerald-100 text-sm shadow-lg">
                                        <span class="font-black text-slate-900 uppercase text-xs tracking-widest" x-text="group.days"></span>
                                        <span class="text-emerald-600 font-black" x-text="group.time"></span>
                                    </div>
                                </template>
                            </template>
                            <template x-if="groupedSchedule.length === 0">
                                <div class="text-center py-10 text-slate-400 italic">Jadwal operasional belum tersedia</div>
                            </template>
                        </div>

                    </div>

                    <!-- Floating Close Button (Desktop) -->
                    <button @click="isDetailOpen = false"
                        class="hidden md:flex absolute top-10 right-10 z-50 bg-slate-50 hover:bg-white text-slate-400 hover:text-slate-900 p-4 rounded-full transition-all border border-slate-100 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        @push('scripts')
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                function umkmDetailData() {
                    return {
                        isDetailOpen: false,
                        selectedItem: null,
                        activeTab: 'produk',
                        
                        open(item) {
                            this.selectedItem = item;
                            this.activeTab = 'produk';
                            this.isDetailOpen = true;
                            document.body.style.overflow = 'hidden';
                        },

                        close() {
                            this.isDetailOpen = false;
                            document.body.style.overflow = 'auto';
                        },

                        get groupedSchedule() {
                            if (!this.selectedItem?.jam_buka) return [];
                            
                            // Ensure selectedItem.jam_buka is treated as an object to order keys
                            let schedule = this.selectedItem.jam_buka;
                            
                            // Standard day order
                            const days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
                            let groups = [];
                            let currentGroup = null;

                            const formatTime = (val) => {
                                if (!val) return 'Tutup';
                                if (typeof val === 'string') return val;
                                if (!val.buka && !val.tutup) return 'Tutup';
                                return (val.buka || '00:00') + ' - ' + (val.tutup || '00:00');
                            };

                            days.forEach(day => {
                                // If day exists in schedule
                                if (schedule[day]) {
                                    const timeStr = formatTime(schedule[day]);
                                    
                                    if (currentGroup && currentGroup.time === timeStr) {
                                        // Extend current group
                                        currentGroup.endDay = day;
                                    } else {
                                        // Push previous group and start new
                                        if (currentGroup) groups.push(currentGroup);
                                        currentGroup = { startDay: day, endDay: day, time: timeStr };
                                    }
                                }
                            });
                            
                            if (currentGroup) groups.push(currentGroup);
                            
                            return groups.map(g => ({
                                days: g.startDay === g.endDay ? g.startDay : g.startDay + ' - ' + g.endDay,
                                time: g.time
                            }));
                        }
                    }
                }

                // Global function used by partial view onclick
                window.openDetail = function (item) {
                    // Dispatch event to Alpine component
                    window.dispatchEvent(new CustomEvent('open-detail', { detail: item }));
                    document.body.style.overflow = 'hidden';
                }

                function closeDetail() {
                    // Alpine handles the closing state via x-data binding, but we need to reset body scroll
                    // However, since close is handled inside Alpine scope usually, we can dispatch a close event or handy helper
                    // Actually, the button inside Alpine scope calls `closeDetail()`.
                    // We can expose a global closeDetail? No, better to define it inside Alpine or just use $dispatch.
                    // But the HTML above uses `@click="closeDetail()"`.
                    // Since we removed `umkmApp()`, `closeDetail()` is not defined in the Alpine scope unless we add it to x-data.
                    // I'll update the x-data in the main div to include `closeDetail`.
                    // Wait, I updated `x-data` in the previous step but only added `isDetailOpen`, `selectedItem`.
                    // I need to update the HTML to use `isDetailOpen = false` directly or add the function to x-data.
                    // Replacing `closeDetail()` with direct assignment in HTML is verbose.
                    // I will add `window.closeDetail` to handle body scroll and dispatch event? Use Alpine direct assignment in view is better.
                    // But I can't change the HTML I just wrote in previous step easily without another replace.
                    // I'll define `closeDetail` globally and make it find the alpine data?
                    document.body.style.overflow = 'auto';
                    window.dispatchEvent(new CustomEvent('close-detail')); // We need to add listener for this
                }

                // Filter Logic
                function filterUmkm(category) {
                    // Update UI
                    $('.filter-btn').removeClass('bg-emerald-600 text-white border-emerald-500 shadow-xl shadow-emerald-500/20 active').addClass('bg-slate-50 text-slate-500 hover:text-slate-900 border-slate-200 hover:bg-slate-100');
                    $(`.filter-btn[data-category="${category}"]`).removeClass('bg-slate-50 text-slate-500 hover:text-slate-900 border-slate-200 hover:bg-slate-100').addClass('bg-emerald-600 text-white border-emerald-500 shadow-xl shadow-emerald-500/20 active');

                    fetchData({ kategori: category, search: $('#search-input').val() });
                }

                // Live Search
                let debounceTimer;
                $('#search-input').on('input', function () {
                    clearTimeout(debounceTimer);
                    let query = $(this).val();
                    let activeCategory = $('.filter-btn.active').data('category');

                    debounceTimer = setTimeout(function () {
                        fetchData({ search: query, kategori: activeCategory });
                    }, 500);
                });

                // Fetch Data
                function fetchData(params) {
                    $.ajax({
                        url: "{{ route('umkm') }}",
                        type: "GET",
                        data: params,
                        success: function (response) {
                            $('#umkm-container').html(response);
                        },
                        error: function (xhr) {
                            console.error('Error:', xhr);
                        }
                    });
                }

                // Pagination
                $(document).on('click', '.pagination a', function (event) {
                    event.preventDefault();
                    let page = $(this).attr('href').split('page=')[1];
                    let activeCategory = $('.filter-btn.active').data('category');
                    let query = $('#search-input').val();

                    fetchData({ page: page, kategori: activeCategory, search: query });
                });
            </script>
        @endpush
@endsection
