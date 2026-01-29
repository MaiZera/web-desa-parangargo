@extends('layouts.main')

@section('content')
    <div class="py-12 px-4 max-w-7xl mx-auto space-y-16">
        <div class="text-center space-y-4 max-w-2xl mx-auto">
            <h1 class="text-4xl font-bold">Transparansi Anggaran</h1>
            <p class="text-slate-600 text-lg">Wujud komitmen desa dalam pengelolaan APBDes yang jujur, terbuka, dan
                akuntabel.</p>
        </div>

        <!-- APBD Banners Section -->
        <div class="space-y-8">
            <h2 class="text-3xl font-bold text-center">Infografis APBDes</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($transparency as $item)
                    <div onclick="openModal('{{ asset('storage/' . $item->image) }}')"
                        class="bg-white rounded-[2rem] overflow-hidden shadow-sm border border-slate-100 group hover:shadow-md transition-all cursor-pointer">
                        <div class="h-64 overflow-hidden bg-slate-100 relative">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div
                                class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-zoom-in text-white">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" x2="16.65" y1="21" y2="16.65" />
                                    <line x1="11" x2="11" y1="8" y2="14" />
                                    <line x1="8" x2="14" y1="11" y2="11" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-slate-800 line-clamp-2">{{ $item->title }}</h3>
                            <p class="text-slate-500 text-sm mt-2">Diunggah pada {{ $item->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-slate-500 bg-slate-50 rounded-[2rem]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-image-off mx-auto mb-4 text-slate-300">
                            <line x1="2" x2="22" y1="2" y2="22" />
                            <path d="M10.41 6.26l2.83 4.25 1.15-1.72" />
                            <path d="M13.88 10.42l3.41 5.12" />
                            <path d="M21 21H3V3" />
                            <path d="M21 3v13.51l-4.2-6.3" />
                            <path d="M3 15.5l5.24-7.86 1.15 1.73" />
                        </svg>
                        <p>Belum ada data transparansi yang diunggah.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 space-y-6">
                            <h3 class="text-xl font-bold flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hard-hat w-6 h-6 text-emerald-600"><path d="M2 13.381a15 15 0 0 0 7.378 1.44H15a15 15 0 0 0 7-1.5"/><path d="M12 18v3"/><path d="M2 10.134V15a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4.866a8 8 0 0 0-16 0"/><path d="M22 10v-.53a3 3 0 0 0-1.85-2.77 10 10 0 0 0-11-2.203"/></svg>
                                Proyek Pembangunan 2023
                            </h3>
                            <div class="space-y-6"> -->
        <!-- Project 1 -->
        <!-- <div>
                                    <div class="flex justify-between mb-2">
                                        <h4 class="font-bold text-sm">Jalan Lingkar Desa</h4>
                                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded">100% Selesai</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2">
                                         <div class="bg-emerald-500 h-2 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div> -->
        <!-- Project 2 -->
        <!-- <div>
                                    <div class="flex justify-between mb-2">
                                        <h4 class="font-bold text-sm">Renovasi Balai Warga</h4>
                                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded">75% Berjalan</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2">
                                         <div class="bg-blue-500 h-2 rounded-full" style="width: 75%"></div>
                                    </div>
                                </div> -->
        <!-- Project 3 -->
        <!-- <div>
                                    <div class="flex justify-between mb-2">
                                        <h4 class="font-bold text-sm">Saluran Irigasi</h4>
                                        <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded">30% Berjalan</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-2">
                                         <div class="bg-orange-500 h-2 rounded-full" style="width: 30%"></div>
                                    </div>
                                </div> -->
        <!-- </div>
                        </div> -->

        <!-- <div class="bg-slate-900 text-white p-8 rounded-3xl space-y-6">
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
                    </div> -->
    </div>

    <!-- Image Modal -->
    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black/95 backdrop-blur-sm transition-opacity duration-300">
        <!-- Close Button -->
        <div class="absolute top-4 right-4 z-[60]">
            <button onclick="closeModal()"
                class="bg-white/10 hover:bg-white/20 text-white rounded-full p-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-x">
                    <path d="M18 6 6 18" />
                    <path d="m6 6 12 12" />
                </svg>
            </button>
        </div>

        <!-- Zoom Controls -->
        <div
            class="absolute bottom-8 left-1/2 -translate-x-1/2 z-[60] flex items-center gap-4 bg-white/10 backdrop-blur-md rounded-full px-6 py-3 border border-white/20">
            <button onclick="zoomOut()" class="text-white hover:text-emerald-400 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-minus">
                    <path d="M5 12h14" />
                </svg>
            </button>
            <span id="zoomLevel" class="text-white font-mono text-sm min-w-[3ch] text-center">100%</span>
            <button onclick="zoomIn()" class="text-white hover:text-emerald-400 p-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
            </button>
            <div class="w-px h-6 bg-white/20 mx-2"></div>
            <button onclick="resetZoom()"
                class="text-white hover:text-emerald-400 text-sm font-bold uppercase tracking-wider">
                Reset
            </button>
        </div>

        <div class="w-full h-full overflow-hidden flex items-center justify-center cursor-grab active:cursor-grabbing"
            id="imageContainer">
            <img id="modalImage" src="" alt="Full Preview"
                class="max-h-none max-w-none transition-transform duration-200 ease-out origin-center" draggable="false">
        </div>
    </div>

    <script>
        let currentScale = 1;
        let isDragging = false;
        let startX, startY, translateX = 0, translateY = 0;

        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        const imageContainer = document.getElementById('imageContainer');
        const zoomDisplay = document.getElementById('zoomLevel');

        function updateImageTransform() {
            modalImg.style.transform = `translate(${translateX}px, ${translateY}px) scale(${currentScale})`;
            zoomDisplay.textContent = Math.round(currentScale * 100) + '%';

            // Cursor update
            imageContainer.style.cursor = isDragging ? 'grabbing' : 'grab';
        }

        function zoomIn() {
            if (currentScale < 5) {
                currentScale += 0.25;
                updateImageTransform();
            }
        }

        function zoomOut() {
            if (currentScale > 0.1) {
                currentScale -= 0.25;
                updateImageTransform();
            }
        }

        function resetZoom() {
            currentScale = 1;
            translateX = 0;
            translateY = 0;
            updateImageTransform();
        }

        function openModal(imageSrc) {
            modalImg.src = imageSrc;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            resetZoom();
        }

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Panning Logic
        imageContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.clientX - translateX;
            startY = e.clientY - translateY;
            imageContainer.style.cursor = 'grabbing';
        });

        window.addEventListener('mousemove', (e) => {
            if (isDragging) {
                e.preventDefault();
                translateX = e.clientX - startX;
                translateY = e.clientY - startY;
                updateImageTransform();
            }
        });

        window.addEventListener('mouseup', () => {
            isDragging = false;
            imageContainer.style.cursor = 'grab';
        });

        // Wheel Zoom
        imageContainer.addEventListener('wheel', (e) => {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        });

        // Key Events
        document.addEventListener('keydown', function (event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });
    </script>
@endsection
