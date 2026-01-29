<x-admin-layout>
    <x-slot name="header">
        Edit Foto Galeri
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.galeri.index') }}"
                class="p-2 rounded-xl border border-slate-200 hover:bg-slate-50 transition-colors">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit Foto</h1>
                <p class="text-slate-500">Perbarui informasi foto dokumentasi</p>
            </div>
        </div>

        <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 md:p-8 space-y-6">
            @csrf
            @method('PUT')

            <!-- Upload Area -->
            <div x-data="{ preview: '{{ asset('storage/' . $galeri->gambar) }}' }" class="space-y-4">
                <label class="block text-sm font-medium text-slate-700 mb-1">Foto Kegiatan</label>
                <div class="flex flex-col items-center justify-center w-full">
                    <label for="gambar"
                        class="flex flex-col items-center justify-center w-full min-h-[16rem] border-2 border-slate-300 border-dashed rounded-2xl cursor-pointer bg-slate-50 hover:bg-slate-100 transition-colors relative overflow-hidden group">

                        <!-- Preview State (Always exists in Edit) -->
                        <div class="w-full relative">
                            <img :src="preview" class="w-full h-auto object-contain">

                            <div
                                class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-10 h-10 mb-2 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <p class="text-white font-medium">Klik untuk ganti foto</p>
                            </div>
                        </div>

                        <input id="gambar" name="gambar" type="file" class="hidden" accept="image/*"
                            @change="preview = URL.createObjectURL($event.target.files[0])" />
                    </label>
                </div>
                <p class="text-xs text-slate-500 text-center">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                @error('gambar')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Judul -->
                <div class="col-span-full">
                    <label for="judul" class="block text-sm font-medium text-slate-700 mb-1">Judul Foto <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $galeri->judul) }}" required
                        class="w-full rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 transition-shadow"
                        placeholder="Contoh: Musyawarah Perencanaan Pembangunan">
                    @error('judul')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                    <select name="kategori" id="kategori"
                        class="w-full rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 bg-white">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('kategori', $galeri->kategori) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal_foto" class="block text-sm font-medium text-slate-700 mb-1">Tanggal Foto</label>
                    <input type="date" name="tanggal_foto" id="tanggal_foto"
                        value="{{ old('tanggal_foto', $galeri->tanggal_foto) }}"
                        class="w-full rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5">
                    @error('tanggal_foto')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lokasi -->
                <div class="col-span-full">
                    <label for="lokasi" class="block text-sm font-medium text-slate-700 mb-1">Lokasi (Opsional)</label>
                    <div class="relative">
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $galeri->lokasi) }}"
                            class="w-full rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 pl-10 pr-4 py-2.5"
                            placeholder="Contoh: Balai Desa Parangargo">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    @error('lokasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="col-span-full">
                    <label for="deskripsi" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi
                        Singkat</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                        class="w-full rounded-xl border border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 placeholder:text-slate-400"
                        placeholder="Jelaskan sedikit tentang momen ini...">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Featured Checkbox -->
                <div class="col-span-full">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_featured" name="is_featured" value="1" type="checkbox" {{ old('is_featured', $galeri->is_featured) ? 'checked' : '' }}
                                class="focus:ring-emerald-500 h-4 w-4 text-emerald-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_featured" class="font-medium text-gray-700">Tampilkan di Unggulan?</label>
                            <p class="text-gray-500">Foto akan muncul di bagian atas atau slider jika tersedia.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-slate-100">
                <button type="submit"
                    class="px-6 py-2.5 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>