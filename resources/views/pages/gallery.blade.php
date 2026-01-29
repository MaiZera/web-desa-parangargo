@extends('layouts.main')

@section('content')
    <div class="w-full" x-data='{
                                            activeCategory: "Semua",
                                            categories: @json($categories, JSON_HEX_APOS),
                                            items: @json($items, JSON_HEX_APOS),
                                            get filteredItems() {
                                                if (this.activeCategory === "Semua") return this.items;
                                                return this.items.filter(item => item.category === this.activeCategory);
                                            },

                                            openModal: false,
                                            modalItem: null,
                                            showImage(item) {
                                                this.modalItem = item;
                                                this.openModal = true;
                                                document.body.style.overflow = "hidden"; // Prevent scrolling
                                            },
                                            closeImage() {
                                                this.openModal = false;
                                                document.body.style.overflow = "auto"; // Restore scrolling
                                            }
                                        }'>

        <!-- Main Content Container -->
        <div class="pt-32 pb-12 px-4 max-w-7xl mx-auto space-y-12">
            <!-- Header Galeri -->
            <div class="flex flex-col md:flex-row justify-between items-end gap-6 text-center md:text-left">
                <div class="max-w-xl">
                    <h1 class="text-4xl font-bold mb-4">Galeri Desa Parangargo</h1>
                    <p class="text-lg text-slate-600">Dokumentasi momen berharga, perkembangan infrastruktur, dan keindahan
                        alam di desa kami.</p>
                </div>
                <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
                    <template x-for="cat in categories" :key="cat">
                        <button @click="activeCategory = cat"
                            class="px-5 py-2 rounded-full text-sm font-bold transition-all whitespace-nowrap border"
                            :class="activeCategory === cat ? 'bg-emerald-600 text-white border-emerald-600 shadow-lg shadow-emerald-200' : 'bg-white text-slate-500 hover:bg-slate-50 border-slate-200'"
                            x-text="cat">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Foto Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-for="item in filteredItems" :key="item.id">
                    <div @click="showImage(item)"
                        class="group relative h-64 md:h-72 rounded-[2rem] overflow-hidden cursor-pointer shadow-sm hover:shadow-xl transition-all duration-500">
                        <img :src="item.image" :alt="item.title"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div
                                class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <span
                                    class="bg-emerald-500 text-white px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider mb-2 inline-block"
                                    x-text="item.category"></span>
                                <h3 class="text-lg font-bold" x-text="item.title"></h3>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- Lightbox Modal (UMKM Style - Overlay) -->
        <div x-show="openModal" class="fixed inset-0 z-[9999] flex items-center justify-center p-4 md:p-6"
            style="display: none;" x-cloak>

            <!-- Backdrop -->
            <div x-show="openModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="closeImage()"
                class="absolute inset-0 bg-slate-900/90 backdrop-blur-sm"></div>

            <!-- Modal Content -->
            <div class="relative w-full max-w-6xl bg-white rounded-[2.5rem] overflow-hidden shadow-2xl flex flex-col md:flex-row h-[85vh] md:h-[80vh]"
                x-show="openModal" x-transition:enter="transition ease-out duration-500 transform"
                x-transition:enter-start="scale-95 translate-y-8 opacity-0"
                x-transition:enter-end="scale-100 translate-y-0 opacity-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="scale-100 translate-y-0 opacity-100"
                x-transition:leave-end="scale-95 translate-y-8 opacity-0" @click.stop>

                <!-- Image Side (Larger with Overlay) -->
                <div class="md:w-[60%] h-64 md:h-full relative shrink-0 group">
                    <img :src="modalItem?.image" :alt="modalItem?.title"
                        class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/40 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-8 md:p-10 w-full">
                        <span
                            class="inline-block px-4 py-1.5 bg-emerald-500 text-white rounded-full text-[10px] font-black uppercase tracking-widest mb-4 shadow-lg"
                            x-text="modalItem?.category"></span>
                        <h2 class="text-3xl md:text-5xl font-black text-white leading-tight tracking-tight shadow-sm"
                            x-text="modalItem?.title"></h2>
                    </div>

                    <!-- Mobile Close -->
                    <button @click="closeImage()"
                        class="md:hidden absolute top-4 right-4 bg-black/50 backdrop-blur p-2 rounded-full text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Info Side -->
                <div
                    class="md:w-[40%] flex flex-col h-full bg-white relative border-l border-slate-100 p-8 md:p-12 justify-between">

                    <div class="absolute top-0 right-0 p-6 z-10">
                        <button @click="closeImage()"
                            class="hidden md:block text-slate-300 hover:text-slate-900 transition-colors p-2 bg-slate-50 rounded-full hover:bg-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-4">
                        <h4
                            class="inline-block px-4 py-1.5 bg-emerald-600 text-white rounded-full text-[10px] font-black uppercase tracking-widest mb-4 shadow-lg shadow-emerald-200">
                            Deskripsi Galeri
                        </h4>
                        <p class="text-emerald-700/80 text-lg leading-relaxed"
                            x-text="modalItem?.description || 'Tidak ada deskripsi'"></p>

                        <div class="mt-8 p-6 bg-slate-50 rounded-2xl border border-slate-100">
                            <div class="flex items-center gap-4 text-sm text-slate-500 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                                    <line x1="16" x2="16" y1="2" y2="6" />
                                    <line x1="8" x2="8" y1="2" y2="6" />
                                    <line x1="3" x2="21" y1="10" y2="10" />
                                </svg>
                                <span
                                    x-text="modalItem?.date ? new Date(modalItem.date).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-'"></span>
                            </div>

                        </div>
                    </div>
                    <div class="space-y-3 mt-6">
                        <a :href="modalItem?.image" download
                            class="w-full py-5 rounded-2xl bg-emerald-600 text-white font-bold text-xs uppercase tracking-[0.2em] hover:bg-emerald-700 transition-all flex items-center justify-center gap-3 shadow-lg shadow-emerald-200 group">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-emerald-100 group-hover:text-white transition-colors">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                <polyline points="7 10 12 15 17 10" />
                                <line x1="12" x2="12" y1="15" y2="3" />
                            </svg>
                            Download Foto
                        </a>
                    </div>
                </div>
            </div>



        </div>
    </div>
    </div>
    </div>
@endsection