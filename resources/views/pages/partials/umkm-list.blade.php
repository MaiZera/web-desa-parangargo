@forelse($umkms as $item)
    <div onclick='openDetail(@json($item))'
        class="bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group cursor-pointer flex flex-col h-full">
        <div class="relative h-80 overflow-hidden shrink-0">
            @php
                $image = $item->foto_produk ? asset('storage/' . $item->foto_produk) : 'https://placehold.co/800x600?text=' . urlencode($item->nama_usaha);
            @endphp
            <img src="{{ $image }}" alt="{{ $item->nama_usaha }}"
                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[2s]">
            <div
                class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>
            <div
                class="absolute top-8 left-8 bg-white/90 backdrop-blur px-5 py-2 rounded-full text-[10px] font-black text-emerald-600 uppercase tracking-widest shadow-xl">
                {{ $item->kategori }}</div>
        </div>
        <div class="p-10 flex flex-col justify-between flex-1">
            <div class="space-y-4">
                <h4 class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">
                    {{ $item->nama_pemilik }}</h4>
                <h3 class="text-3xl font-black text-slate-900 leading-tight group-hover:text-emerald-600 transition-colors">
                    {{ $item->nama_usaha }}</h3>
                <p class="text-slate-500 line-clamp-2 text-sm leading-relaxed">{{ $item->deskripsi }}</p>
            </div>
            <div class="mt-10 pt-8 border-t border-slate-50 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Mulai Dari</p>
                    <p class="text-2xl font-black text-emerald-600">{{ $item->kisaran_harga ?? 'Hubungi Penjual' }}</p>
                </div>
                <button
                    class="w-14 h-14 bg-slate-900 text-white rounded-2xl flex items-center justify-center transform group-hover:rotate-[360deg] group-hover:bg-emerald-600 transition-all duration-700 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-arrow-up-right">
                        <path d="M7 7h10v10" />
                        <path d="M17 7 7 17" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
@empty
    <div class="col-span-full py-32 text-center">
        <div class="w-32 h-32 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                class="text-slate-300">
                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                <path d="M3 6h18" />
                <path d="M16 10a4 4 0 0 1-8 0" />
            </svg>
        </div>
        <p class="text-2xl font-black text-slate-900">Belum ada UMKM yang muncul</p>
        <p class="text-slate-500 mt-2 text-lg">Coba ubah filter atau kata kunci pencarian Anda.</p>
    </div>
@endforelse

@if($umkms->hasPages())
    <div class="col-span-full mt-12">
        {{ $umkms->links() }}
    </div>
@endif