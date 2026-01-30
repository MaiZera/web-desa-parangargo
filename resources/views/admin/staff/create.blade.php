<x-admin-layout>
    <x-slot name="header">
        Tambah Staff Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.staff.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">Foto</label>
                            <input type="file" name="foto" id="foto" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-emerald-50 file:text-emerald-700
                                hover:file:bg-emerald-100" accept="image/*">
                            @error('foto')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                @error('nama')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">NIP</label>
                                <input type="text" name="nip" id="nip" value="{{ old('nip') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan *</label>
                            <select name="jabatan" id="jabatan" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="" disabled selected>Pilih Jabatan</option>
                                <option value="Kepala Desa" {{ old('jabatan') == 'Kepala Desa' ? 'selected' : '' }}>Kepala Desa</option>
                                <option value="Sekretaris Desa" {{ old('jabatan') == 'Sekretaris Desa' ? 'selected' : '' }}>Sekretaris Desa</option>
                                <option value="KAUR. Tata Usaha & Umum" {{ old('jabatan') == 'KAUR. Tata Usaha & Umum' ? 'selected' : '' }}>KAUR. Tata Usaha & Umum</option>
                                <option value="KAUR. Keuangan" {{ old('jabatan') == 'KAUR. Keuangan' ? 'selected' : '' }}>KAUR. Keuangan</option>
                                <option value="KAUR. Perencanaan" {{ old('jabatan') == 'KAUR. Perencanaan' ? 'selected' : '' }}>KAUR. Perencanaan</option>
                                <option value="KASI. Pemerintahan" {{ old('jabatan') == 'KASI. Pemerintahan' ? 'selected' : '' }}>KASI. Pemerintahan</option>
                                <option value="KASI. Kesejahteraan" {{ old('jabatan') == 'KASI. Kesejahteraan' ? 'selected' : '' }}>KASI. Kesejahteraan</option>
                                <option value="KASI. Pelayanan" {{ old('jabatan') == 'KASI. Pelayanan' ? 'selected' : '' }}>KASI. Pelayanan</option>
                                <option value="KASUN. Wagir" {{ old('jabatan') == 'KASUN. Wagir' ? 'selected' : '' }}>KASUN. Wagir</option>
                                <option value="KASUN. Genengan" {{ old('jabatan') == 'KASUN. Genengan' ? 'selected' : '' }}>KASUN. Genengan</option>
                                <option value="KASUN. Durenan" {{ old('jabatan') == 'KASUN. Durenan' ? 'selected' : '' }}>KASUN. Durenan</option>
                                <option value="KASUN. Juwetmanting" {{ old('jabatan') == 'KASUN. Juwetmanting' ? 'selected' : '' }}>KASUN. Juwetmanting</option>
                            </select>
                            @error('jabatan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                                <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="2" class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-md hover:bg-emerald-700 transition-colors">Simpan Staff</button>
                            <a href="{{ route('admin.staff.index') }}" class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
