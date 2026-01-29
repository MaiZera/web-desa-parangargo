@extends('layouts.main')

@section('content')
    <div x-data="homeApp()" @open-agenda.window="openAgendaDetail($event.detail)" class="space-y-12 pb-12">

        <!-- Hero Slider -->
        @if(isset($banners) && $banners->count() > 0)
            <section class="relative h-[400px] md:h-[600px] overflow-hidden rounded-3xl group mx-4 mt-8" x-data="{ active: 0 }"
                x-init="setInterval(() => active = (active + 1) % {{ $banners->count() }}, 5000)">
                @foreach($banners as $index => $banner)
                    <div class="absolute inset-0 transition-opacity duration-1000"
                        :class="{ 'opacity-100': active === {{ $index }}, 'opacity-0': active !== {{ $index }} }">
                        <img alt="{{ $banner->title ?? 'Banner' }}" class="w-full h-full object-cover"
                            src="{{ asset('storage/' . $banner->image_path) }}">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-8 md:p-16">
                            <div class="max-w-2xl text-white space-y-4">
                                @if($banner->title)
                                    <h1 class="text-4xl md:text-6xl font-bold leading-tight">{{ $banner->title }}</h1>
                                @endif
                                @if($banner->description)
                                    <p class="text-lg md:text-xl text-slate-200">{{ $banner->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
                    @foreach($banners as $index => $banner)
                        <button class="h-3 rounded-full transition-all bg-white"
                            :class="active === {{ $index }} ? 'w-8' : 'w-3 opacity-50'" @click="active = {{ $index }}"></button>
                    @endforeach
                </div>
            </section>
        @else
            <section class="relative h-[400px] md:h-[600px] overflow-hidden rounded-3xl group mx-4 mt-8" x-data="{ active: 0 }"
                x-init="setInterval(() => active = (active + 1) % 2, 5000)">
                <div class="absolute inset-0 transition-opacity duration-1000"
                    :class="{ 'opacity-100': active === 0, 'opacity-0': active !== 0 }">
                    <img alt="Selamat Datang" class="w-full h-full object-cover"
                        src="https://picsum.photos/seed/slide1/1200/600">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-8 md:p-16">
                        <div class="max-w-2xl text-white space-y-4">
                            <h1 class="text-4xl md:text-6xl font-bold leading-tight">Selamat Datang di Desa Parangargo</h1>
                            <p class="text-lg md:text-xl text-slate-200">Membangun masa depan desa yang lebih cerdas dan
                                berdikari.</p>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-0 transition-opacity duration-1000"
                    :class="{ 'opacity-100': active === 1, 'opacity-0': active !== 1 }">
                    <img alt="Festival Budaya" class="w-full h-full object-cover"
                        src="https://picsum.photos/seed/slide2/1200/600">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-8 md:p-16">
                        <div class="max-w-2xl text-white space-y-4">
                            <h1 class="text-4xl md:text-6xl font-bold leading-tight">Potensi Desa Parangargo</h1>
                            <p class="text-lg md:text-xl text-slate-200">Mari lestarikan warisan leluhur kita.</p>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2">
                    <button class="h-3 rounded-full transition-all bg-white" :class="active === 0 ? 'w-8' : 'w-3 opacity-50'"
                        @click="active = 0"></button>
                    <button class="h-3 rounded-full transition-all bg-white" :class="active === 1 ? 'w-8' : 'w-3 opacity-50'"
                        @click="active = 1"></button>
                </div>
            </section>
        @endif

        <!-- Stats Section -->
        <section class="grid md:grid-cols-3 gap-6 px-4 max-w-7xl mx-auto">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex items-start gap-4">
                <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">Penduduk</h3>
                    <p class="text-3xl font-bold text-emerald-600 mt-1">{{ number_format($pendudukCount, 0, ',', '.') }}</p>
                    <p class="text-sm text-slate-500">Jiwa Terdata</p>
                </div>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex items-start gap-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="7" rx="2" ry="2" />
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">UMKM Aktif</h3>
                    <p class="text-3xl font-bold text-blue-600 mt-1">{{ number_format($umkmCount, 0, ',', '.') }}</p>
                    <p class="text-sm text-slate-500">Unit Usaha Lokal</p>
                </div>
            </div>
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-100 flex items-start gap-4">
                <div class="p-3 bg-amber-100 text-amber-600 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
                        <path d="M10.3 22H3" />
                        <path d="M14 22h7.7" />
                        <path d="M12 2v20" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg">Komoditas Utama</h3>
                    <p class="text-3xl font-bold text-amber-600 mt-1">Padi</p>
                    <p class="text-sm text-slate-500">Hasil Bumi</p>
                </div>
            </div>
        </section>

        <!-- Calendar Section -->
        <section class="max-w-7xl mx-auto px-4">
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
                    <div>
                        <h2 class="text-3xl font-bold">Agenda Desa</h2>
                        <p class="text-slate-500">Jadwal kegiatan dan acara penting di Desa Parangargo.</p>
                    </div>
                </div>

                <div id="calendar" class="min-h-[600px]"></div>
            </div>
        </section>

        <!-- Agenda Detail Modal -->
        <template x-teleport="body">
            <div x-show="isAgendaModalOpen" class="fixed inset-0 z-[1000] flex items-center justify-center p-4 md:p-6"
                x-cloak>

                <!-- Backdrop -->
                <div x-show="isAgendaModalOpen" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @click="closeAgendaDetail()"
                    class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm"></div>

                <!-- Modal Box -->
                <div class="relative w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden shadow-2xl flex flex-col md:flex-row h-[90vh] md:h-[80vh]"
                    x-show="isAgendaModalOpen" x-transition:enter="transition ease-out duration-500 transform"
                    x-transition:enter-start="scale-95 translate-y-8 opacity-0"
                    x-transition:enter-end="scale-100 translate-y-0 opacity-100"
                    x-transition:leave="transition ease-in duration-300 transform"
                    x-transition:leave-start="scale-100 translate-y-0 opacity-100"
                    x-transition:leave-end="scale-95 translate-y-8 opacity-0">

                    <!-- Left Side: Poster Image Overlay -->
                    <div class="md:w-[45%] h-64 md:h-full relative shrink-0 bg-emerald-900">
                        <template x-if="selectedAgenda?.gambar">
                            <img :src="selectedAgenda?.gambar" class="absolute inset-0 w-full h-full object-cover">
                        </template>
                        <div x-show="!selectedAgenda?.gambar" class="absolute inset-0">
                            <img src="https://images.unsplash.com/photo-1540339832862-4745591f5d32?q=80&w=600&h=800&auto=format&fit=crop"
                                class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-60">
                        </div>
                        <!-- Gradient Overlay for Poster look -->
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/20 to-transparent">
                        </div>

                        <div class="absolute bottom-10 left-10 right-10 text-white space-y-4">
                            <span
                                class="inline-block px-4 py-1.5 bg-emerald-500 text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg"
                                x-text="selectedAgenda?.source === 'holiday' ? 'Libur Nasional' : 'Agenda Desa'"></span>
                            <h2 class="text-4xl md:text-5xl font-black leading-tight tracking-tighter"
                                x-text="selectedAgenda?.title"></h2>
                            <div class="flex items-center gap-2 text-emerald-300 font-bold text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                    <line x1="16" x2="16" y1="2" y2="6" />
                                    <line x1="8" x2="8" y1="2" y2="6" />
                                    <line x1="3" x2="21" y1="10" y2="10" />
                                </svg>
                                <span x-text="selectedAgenda?.tanggal_mulai_formatted"></span>
                            </div>
                        </div>

                        <!-- Close Button for Mobile -->
                        <button @click="closeAgendaDetail()"
                            class="md:hidden absolute top-6 right-6 bg-white/20 backdrop-blur-md p-3 rounded-full text-white border border-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Right Side: Navigation & Content -->
                    <div class="md:w-[55%] flex flex-col h-full bg-white relative overflow-hidden"
                        x-data="{ activeTab: 'detail' }">
                        <!-- Navigation Tabs -->
                        <div
                            class="flex items-center px-10 pt-10 gap-8 border-b border-slate-50 overflow-x-auto scrollbar-hide shrink-0 bg-white z-10">
                            <button @click="activeTab = 'detail'"
                                :class="activeTab === 'detail' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'"
                                class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Detail
                                Acara</button>
                            <button @click="activeTab = 'penyelenggara'" x-show="selectedAgenda?.penyelenggara"
                                :class="activeTab === 'penyelenggara' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'"
                                class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Penyelenggara</button>
                            <button @click="activeTab = 'kontak'"
                                x-show="selectedAgenda?.narahubung || selectedAgenda?.telepon"
                                :class="activeTab === 'kontak' ? 'text-emerald-600 border-b-2 border-emerald-600' : 'text-slate-400 hover:text-slate-600'"
                                class="pb-5 text-[10px] font-black uppercase tracking-[0.2em] transition-all whitespace-nowrap">Kontak</button>
                        </div>

                        <!-- Scrollable Content -->
                        <div class="flex-1 overflow-y-auto p-10 md:p-12 custom-scrollbar">

                            <!-- 1. Detail Tab Content -->
                            <div x-show="activeTab === 'detail'" x-transition class="space-y-10">
                                <div>
                                    <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest mb-4">
                                        Deskripsi Kegiatan</h4>
                                    <div class="p-8 bg-emerald-50 border border-emerald-100 rounded-[2rem] shadow-lg">
                                        <p class="text-emerald-900 leading-relaxed italic text-lg"
                                            x-text="selectedAgenda?.description || 'Tidak ada deskripsi tambahan.'"></p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-6">
                                    <div
                                        class="flex items-start gap-4 p-6 bg-emerald-50 rounded-2xl border border-emerald-100 shadow-lg">
                                        <div class="p-3 bg-white rounded-xl shadow-md text-emerald-600 shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path
                                                    d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                                <circle cx="12" cy="10" r="3" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                                Lokasi</p>
                                            <p class="text-slate-800 font-bold text-lg truncate"
                                                x-text="selectedAgenda?.location || 'Lokasi menyusul'"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 2. Penyelenggara Tab -->
                            <div x-show="activeTab === 'penyelenggara'" x-transition style="display: none;"
                                class="space-y-8">
                                <div
                                    class="flex items-center gap-8 p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 shadow-lg">
                                    <div class="w-24 h-24 bg-white rounded-3xl flex items-center justify-center text-4xl font-black text-emerald-600 shadow-xl"
                                        x-text="selectedAgenda?.penyelenggara?.charAt(0)"></div>
                                    <div>
                                        <h4 class="text-3xl font-black text-slate-900 tracking-tight"
                                            x-text="selectedAgenda?.penyelenggara"></h4>
                                        <p class="text-emerald-600 font-black text-[10px] uppercase tracking-[0.2em] mt-1">
                                            Official Organizer</p>
                                    </div>
                                </div>
                                <div
                                    class="p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 shadow-lg text-center">
                                    <p class="text-slate-500 italic text-xl leading-relaxed">Terima kasih atas partisipasi
                                        aktif seluruh elemen masyarakat dalam menyukseskan acara ini.</p>
                                </div>
                            </div>

                            <!-- 3. Kontak Tab -->
                            <div x-show="activeTab === 'kontak'" x-transition style="display: none;" class="space-y-6">
                                <div
                                    class="p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 flex items-start gap-8 shadow-lg">
                                    <div
                                        class="p-4 bg-white rounded-2xl shadow-md text-emerald-600 border border-emerald-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama
                                            Narahubung</p>
                                        <p class="text-slate-800 font-black text-2xl leading-tight"
                                            x-text="selectedAgenda?.narahubung || '-'"></p>
                                    </div>
                                </div>

                                <div class="space-y-6">
                                    <div
                                        class="p-10 bg-emerald-50 rounded-[2.5rem] border border-emerald-100 flex items-start gap-8 shadow-lg">
                                        <div
                                            class="p-4 bg-white rounded-2xl shadow-md text-emerald-600 border border-emerald-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">
                                                Nomor Telepon</p>
                                            <p class="text-slate-800 font-black text-2xl leading-tight"
                                                x-text="selectedAgenda?.telepon || '-'"></p>
                                        </div>
                                    </div>

                                    <template x-if="selectedAgenda?.telepon">
                                        <a :href="'https://wa.me/' + selectedAgenda?.telepon.replace(/\D/g,'')"
                                            target="_blank"
                                            class="block w-full bg-emerald-600 text-white text-center py-6 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-emerald-700 transition-all transform hover:scale-[1.02] shadow-2xl shadow-emerald-200">Kirim
                                            Pesan Sekarang</a>
                                    </template>
                                </div>
                            </div>

                        </div>

                        <!-- Floating Close Button (Desktop) -->
                        <button @click="closeAgendaDetail()"
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
        </template>

        <!-- News Section -->
        <section class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-bold">Berita Terbaru</h2>
                    <p class="text-slate-500">Informasi dan kabar terkini seputar desa.</p>
                </div>
                <a href="{{ url('/berita') }}"
                    class="text-emerald-600 font-semibold hover:underline flex items-center gap-1">
                    Semua Berita
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-4 h-4">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($news as $item)
                    <a href="{{ route('news.show', $item->slug) }}"
                        class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow group cursor-pointer border border-slate-100">
                        <div class="h-48 overflow-hidden bg-slate-100">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="https://placehold.co/600x400/e2e8f0/64748b?text=No+Image" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                        </div>
                        <div class="p-6 space-y-3">
                            <div
                                class="flex items-center gap-2 text-xs font-semibold text-emerald-600 uppercase tracking-wider">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="w-3 h-3">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                </svg>
                                {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                            </div>
                            <h3 class="text-xl font-bold leading-tight group-hover:text-emerald-600 transition-colors">
                                {{ $item->title }}
                            </h3>
                            <p class="text-slate-600 text-sm line-clamp-2">
                                {{ Str::limit(strip_tags($item->summary ?? $item->content), 100) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- UMKM Slider Section -->
        <section class="max-w-7xl mx-auto px-4">
            <div class="bg-emerald-900 rounded-[3rem] p-12 text-white">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold">UMKM Unggulan Desa</h2>
                    <p class="text-emerald-200 mt-4 text-lg">Dukung produk lokal desa untuk kemandirian ekonomi kita
                        bersama.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($umkms as $umkm)
                        <div class="bg-white/10 backdrop-blur-md rounded-3xl overflow-hidden border border-white/10 group">
                            <div class="h-56 bg-white/5 overflow-hidden">
                                @if($umkm->foto_produk)
                                    <img src="{{ asset('storage/' . $umkm->foto_produk) }}" alt="{{ $umkm->nama_usaha }}"
                                        class="w-full h-full object-cover opacity-80 group-hover:scale-110 group-hover:opacity-100 transition-all duration-700">
                                @else
                                    <img src="https://placehold.co/600x400/e2e8f0/64748b?text=No+Image"
                                        alt="{{ $umkm->nama_usaha }}"
                                        class="w-full h-full object-cover opacity-80 group-hover:scale-110 group-hover:opacity-100 transition-all duration-700">
                                @endif
                            </div>
                            <div class="p-8">
                                <p class="text-emerald-400 text-[10px] font-black uppercase tracking-widest mb-2">
                                    {{ $umkm->kategori }}
                                </p>
                                <h3 class="text-xl font-bold mb-3 text-white">{{ $umkm->nama_usaha }}</h3>
                                <p class="text-emerald-100/70 text-sm mb-6 line-clamp-2">{{ Str::limit($umkm->deskripsi, 100) }}
                                </p>
                                <a href="{{ url('/umkm') }}"
                                    class="inline-block w-full text-center bg-white text-emerald-900 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-emerald-100 transition-colors">Telusuri
                                    UMKM</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        function homeApp() {
            return {
                isAgendaModalOpen: false,
                selectedAgenda: null,

                openAgendaDetail(event) {
                    let title = event.title.replace('⭐ ', '');

                    this.selectedAgenda = {
                        title: title,
                        start: event.start,
                        end: event.end,
                        location: event.extendedProps.location,
                        description: event.extendedProps.description,
                        source: event.extendedProps.source,
                        gambar: event.extendedProps.gambar,
                        penyelenggara: event.extendedProps.penyelenggara,
                        narahubung: event.extendedProps.narahubung,
                        telepon: event.extendedProps.telepon,
                        tanggal_mulai_formatted: event.extendedProps.tanggal_mulai_formatted,
                        tanggal_selesai_formatted: event.extendedProps.tanggal_selesai_formatted
                    };

                    if (!this.selectedAgenda.tanggal_mulai_formatted && event.start) {
                        this.selectedAgenda.tanggal_mulai_formatted = event.start.toLocaleDateString('id-ID', {
                            weekday: 'long',
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    }

                    this.isAgendaModalOpen = true;
                    document.body.style.overflow = 'hidden';
                },

                closeAgendaDetail() {
                    this.isAgendaModalOpen = false;
                    document.body.style.overflow = 'auto';
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) return;

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listMonth'
                },
                locale: 'id',
                buttonText: {
                    today: 'Hari Ini',
                    month: 'Bulan',
                    list: 'List'
                },
                events: '/api/agendas',
                eventColor: '#059669',
                eventBorderColor: '#047857',
                displayEventTime: true,
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false
                },
                eventClick: function (info) {
                    window.dispatchEvent(new CustomEvent('open-agenda', { detail: info.event }));
                }
            });
            calendar.render();
        });
    </script>
@endpush