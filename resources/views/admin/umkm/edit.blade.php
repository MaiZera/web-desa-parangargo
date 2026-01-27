<x-admin-layout>
    <x-slot name="header">
        Edit Data UMKM
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <label for="nama_usaha" class="block text-sm font-medium text-gray-700">Nama Usaha</label>
                                    <input type="text" name="nama_usaha" id="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Kripik Tempe Bu Ani">
                                    @error('nama_usaha') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
                                    <input type="text" name="nama_pemilik" id="nama_pemilik" value="{{ old('nama_pemilik', $umkm->nama_pemilik) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    @error('nama_pemilik') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Usaha</label>
                                    <select name="kategori" id="kategori" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        <option value="">Pilih Kategori...</option>
                                        <option value="Kuliner" {{ (old('kategori', $umkm->kategori) == 'Kuliner') ? 'selected' : '' }}>Kuliner / Makanan</option>
                                        <option value="Kerajinan" {{ (old('kategori', $umkm->kategori) == 'Kerajinan') ? 'selected' : '' }}>Kerajinan Tangan</option>
                                        <option value="Jasa" {{ (old('kategori', $umkm->kategori) == 'Jasa') ? 'selected' : '' }}>Jasa / Layanan</option>
                                        <option value="Pertanian" {{ (old('kategori', $umkm->kategori) == 'Pertanian') ? 'selected' : '' }}>Pertanian / Perkebunan</option>
                                        <option value="Perdagangan" {{ (old('kategori', $umkm->kategori) == 'Perdagangan') ? 'selected' : '' }}>Perdagangan / Toko</option>
                                        <option value="Lainnya" {{ (old('kategori', $umkm->kategori) == 'Lainnya') ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kategori') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                                    @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                                    <textarea name="alamat" id="alamat" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">{{ old('alamat', $umkm->alamat) }}</textarea>
                                    @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700">No Telepon/WhatsApp</label>
                                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $umkm->telepon) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                </div>

                                <div>
                                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram (Opsional)</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                      <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">@</span>
                                      <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $umkm->instagram) }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="username">
                                    </div>
                                </div>

                                <div>
                                    <label for="foto_produk" class="block text-sm font-medium text-gray-700">Foto Produk / Tempat Usaha</label>
                                    
                                    @if($umkm->foto_produk)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $umkm->foto_produk) }}" alt="Current Image" class="h-20 w-20 object-cover rounded-md border">
                                        </div>
                                    @endif

                                    <input type="file" name="foto_produk" id="foto_produk" accept="image/*" class="mt-1 block w-full text-sm text-slate-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-emerald-50 file:text-emerald-700
                                      hover:file:bg-emerald-100
                                    ">
                                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto.</p>
                                    @error('foto_produk') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="pt-4">
                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $umkm->is_active) ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="is_active" class="font-medium text-gray-700">Status Aktif</label>
                                            <p class="text-gray-500">Tampilkan UMKM ini di halaman publik.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-8 border-t mt-8">
                            <a href="{{ route('admin.umkm.index') }}" class="mr-4 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">Batal</a>
                            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition-colors">Perbarui UMKM</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
