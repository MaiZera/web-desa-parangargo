<x-admin-layout>
    <x-slot name="header">
        Tambah Pengumuman
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data"
                        x-data="{ tipe: '{{ old('tipe', 'umum') }}' }">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="col-span-2">
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul
                                    Pengumuman</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>
                                @error('judul')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tipe" class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                                <select name="tipe" id="tipe" x-model="tipe"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    <option value="umum" {{ old('tipe') == 'umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="agenda" {{ old('tipe') == 'agenda' ? 'selected' : '' }}>Agenda</option>
                                    <option value="layanan" {{ old('tipe') == 'layanan' ? 'selected' : '' }}>Layanan
                                    </option>
                                    <option value="darurat" {{ old('tipe') == 'darurat' ? 'selected' : '' }}>Darurat
                                    </option>
                                    <option value="berita" {{ old('tipe') == 'berita' ? 'selected' : '' }}>Berita</option>
                                </select>
                                @error('tipe')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                    Mulai</label>
                                <input type="date" name="tanggal_mulai" id="tanggal_mulai"
                                    value="{{ old('tanggal_mulai') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                @error('tanggal_mulai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tanggal_selesai"
                                    class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                                    value="{{ old('tanggal_selesai') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                @error('tanggal_selesai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label for="file_lampiran" class="block text-sm font-medium text-gray-700 mb-1">File
                                    Lampiran (Optional)</label>
                                <input type="file" name="file_lampiran" id="file_lampiran"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, JPG, PNG (Max 5MB)</p>
                                @error('file_lampiran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label for="konten" class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                                <!-- Using Trix Editor or simple textarea. Using textarea for now as requested 'like news' might imply rich text but I'll stick to simple first unless asked -->
                                <textarea name="konten" id="konten" rows="6"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>{{ old('konten') }}</textarea>
                                @error('konten')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.announcements.index') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>