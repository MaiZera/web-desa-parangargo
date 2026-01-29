<x-admin-layout>
    <x-slot name="header">
        Edit Pengumuman
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST"
                        enctype="multipart/form-data" x-data="{ tipe: '{{ old('tipe', $announcement->tipe) }}' }">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="col-span-2">
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul
                                    Pengumuman</label>
                                <input type="text" name="judul" id="judul"
                                    value="{{ old('judul', $announcement->judul) }}"
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
                                    <option value="umum" {{ old('tipe', $announcement->tipe) == 'umum' ? 'selected' : '' }}>Umum</option>
                                    <option value="layanan" {{ old('tipe', $announcement->tipe) == 'layanan' ? 'selected' : '' }}>Layanan</option>
                                    <option value="darurat" {{ old('tipe', $announcement->tipe) == 'darurat' ? 'selected' : '' }}>Darurat</option>
                                    <!-- <option value="berita" {{ old('tipe', $announcement->tipe) == 'berita' ? 'selected' : '' }}>Berita</option> -->
                                </select>
                                @error('tipe')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                    <option value="draft" {{ old('status', $announcement->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $announcement->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status', $announcement->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Agenda dates removed -->

                            <div class="col-span-2" x-data="{
                                file: null,
                                previewUrl: '{{ $announcement->file_lampiran && in_array(pathinfo($announcement->file_lampiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']) ? asset('storage/' . $announcement->file_lampiran) : '' }}',
                                isImage: {{ $announcement->file_lampiran && in_array(pathinfo($announcement->file_lampiran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']) ? 'true' : 'false' }},
                                existingFile: '{{ $announcement->file_lampiran }}',
                                handleFile(event) {
                                    const file = event.target.files[0];
                                    if (!file) return;
                                    this.file = file;
                                    this.existingFile = null; // Clear existing file display when new one is picked
                                    this.isImage = file.type.startsWith('image/');
                                    if (this.isImage) {
                                        const reader = new FileReader();
                                        reader.onload = (e) => this.previewUrl = e.target.result;
                                        reader.readAsDataURL(file);
                                    } else {
                                        this.previewUrl = null;
                                    }
                                }
                            }">
                                <label for="file_lampiran" class="block text-sm font-medium text-gray-700 mb-1">File
                                    Lampiran (Optional)</label>

                                <input type="file" name="file_lampiran" id="file_lampiran" @change="handleFile"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX, JPG, PNG (Max 5MB)</p>

                                <!-- Existing File Display (if not replaced) -->
                                <template x-if="existingFile && !file">
                                    <div class="mt-3">
                                        <p class="text-xs text-gray-500 mb-1">Lampiran saat ini:</p>
                                        <template x-if="isImage">
                                            <div class="relative w-full max-w-xs">
                                                <img :src="previewUrl" alt="Current Attachment"
                                                    class="rounded-lg border border-gray-200 shadow-sm">
                                            </div>
                                        </template>
                                        <template x-if="!isImage">
                                            <div
                                                class="flex items-center gap-2 p-3 bg-gray-50 rounded-lg border border-gray-200 max-w-sm">
                                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                    </path>
                                                </svg>
                                                <div class="text-sm overflow-hidden">
                                                    <a :href="'{{ asset('storage') }}/' + existingFile" target="_blank"
                                                        class="font-medium text-indigo-600 hover:text-indigo-800 truncate block">
                                                        Lihat Lampiran
                                                    </a>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </template>

                                <!-- New File Preview -->
                                <div class="mt-3" x-show="file" x-transition>
                                    <template x-if="isImage && previewUrl">
                                        <div class="relative w-full max-w-xs">
                                            <img :src="previewUrl" alt="Preview"
                                                class="rounded-lg border border-gray-200 shadow-sm">
                                        </div>
                                    </template>
                                    <template x-if="!isImage && file">
                                        <div
                                            class="flex items-center gap-2 p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <div class="text-sm">
                                                <p class="font-medium text-gray-900" x-text="file.name"></p>
                                                <p class="text-gray-500" x-text="(file.size / 1024).toFixed(1) + ' KB'">
                                                </p>
                                            </div>
                                        </div>
                                    </template>
                                </div>

                                @error('file_lampiran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label for="konten" class="block text-sm font-medium text-gray-700 mb-1">Konten</label>
                                <textarea name="konten" id="konten" rows="6"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                    required>{{ old('konten', $announcement->konten) }}</textarea>
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
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>