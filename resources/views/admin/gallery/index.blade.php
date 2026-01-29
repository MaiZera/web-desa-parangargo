<x-admin-layout>
    <x-slot name="header">
        Kelola Galeri
    </x-slot>

    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col items-center justify-center gap-4 text-center">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Kelola Galeri</h1>
                <p class="text-slate-500 mt-1">Atur foto-foto kegiatan dan galeri desa</p>
            </div>
            <a href="{{ route('admin.galeri.create') }}"
                class="inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl text-sm font-medium hover:bg-emerald-700 transition-colors shadow-sm shadow-emerald-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Foto
            </a>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
            <form action="{{ route('admin.galeri.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari judul atau deskripsi..."
                            class="w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-emerald-500">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <select name="kategori"
                        class="w-full rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 py-2"
                        onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($galeri as $item)
                <div
                    class="group bg-white rounded-2xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-md transition-all">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-2 right-2">
                            <form action="{{ route('admin.galeri.toggle-featured', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="p-2 rounded-full backdrop-blur-sm transition-colors {{ $item->is_featured ? 'bg-yellow-400 text-white' : 'bg-black/30 text-white hover:bg-yellow-400' }}"
                                    title="Toggle Featured">
                                    <svg class="w-4 h-4" fill="{{ $item->is_featured ? 'currentColor' : 'none' }}"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-xs font-medium rounded-lg">
                                {{ $item->kategori ?? 'Umum' }}
                            </span>
                            <span class="text-xs text-slate-400">
                                {{ $item->created_at->format('d M Y') }}
                            </span>
                        </div>
                        <h3 class="font-bold text-slate-800 line-clamp-1 mb-1">{{ $item->judul }}</h3>
                        <p class="text-sm text-slate-500 line-clamp-2 mb-4">{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                            <div class="flex items-center gap-2 text-xs text-slate-400">
                                <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center">
                                    {{ substr($item->uploader->name ?? 'A', 0, 1) }}
                                </span>
                                {{ $item->uploader->name ?? 'Admin' }}
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.galeri.edit', $item->id) }}"
                                    class="text-slate-400 hover:text-emerald-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-1">Belum ada foto</h3>
                    <p class="text-slate-500 mb-4">Mulai tambahkan dokumentasi kegiatan desa</p>
                    <a href="{{ route('admin.galeri.create') }}" class="text-emerald-600 font-medium hover:underline">Tambah
                        Foto Pertama</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $galeri->links() }}
        </div>
    </div>
</x-admin-layout>