<x-admin-layout>
    <x-slot name="header">
        Tambah Banner APBD
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-6 flex items-center justify-between">
                        <h2 class="text-xl font-bold">Upload Banner</h2>
                    </div>

                    <form action="{{ route('admin.transparency.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <!-- Title Field -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Banner</label>
                            <input type="text" name="title" id="title" required
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                placeholder="Contoh: Realisasi APBD Tahun 2025">
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image Upload with Preview -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">File Gambar (Banner)</label>

                            <!-- Dropzone Style Area -->
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative hover:bg-gray-50 transition overflow-hidden min-h-[16rem]"
                                id="drop-area">
                                <div class="space-y-1 text-center" id="empty-state">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="image-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-emerald-600 hover:text-emerald-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-emerald-500">
                                            <span>Upload a file</span>
                                            <input id="image-upload" name="image" type="file" class="sr-only"
                                                accept="image/*" onchange="previewImage(this)">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 5MB
                                    </p>
                                </div>

                                <!-- Preview Container -->
                                <div id="preview-container"
                                    class="hidden w-full flex flex-col items-center justify-center p-4">
                                    <img id="image-preview" src="#" alt="Preview"
                                        class="max-w-full h-auto object-contain shadow-md rounded-lg mb-4 max-h-[80vh]">

                                    <!-- Controls: Change & Remove -->
                                    <div class="flex gap-3 bg-white p-1 rounded-full shadow-sm border border-slate-100">
                                        <!-- Change Button -->
                                        <button type="button" onclick="document.getElementById('image-upload').click()"
                                            class="flex items-center gap-2 px-4 py-2 bg-amber-50 text-amber-700 rounded-full hover:bg-amber-100 transition-colors font-medium text-sm border border-amber-200"
                                            title="Ganti Gambar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                                </path>
                                            </svg>
                                            Ganti
                                        </button>

                                        <!-- Remove Button -->
                                        <button type="button" onclick="resetFile()"
                                            class="flex items-center gap-2 px-4 py-2 bg-red-50 text-red-700 rounded-full hover:bg-red-100 transition-colors font-medium text-sm border border-red-200"
                                            title="Hapus Gambar">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.transparency.index') }}"
                                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                                Kembali
                            </a>
                            <button type="submit"
                                class="bg-emerald-600 text-white px-6 py-2 rounded-md hover:bg-emerald-700 transition shadow-sm">
                                Simpan Banner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const emptyState = document.getElementById('empty-state');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    emptyState.classList.add('hidden'); // Hide empty state completely
                    previewContainer.classList.remove('hidden'); 
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetFile() {
            const input = document.getElementById('image-upload');
            input.value = '';
            document.getElementById('image-preview').src = '#';
            document.getElementById('empty-state').classList.remove('hidden');
            document.getElementById('preview-container').classList.add('hidden');
        }
    </script>
</x-admin-layout>
