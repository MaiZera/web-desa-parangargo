<x-admin-layout>
    <x-slot name="header">
        Tambah Banner
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Banner Image
                                (Required)</label>

                            <!-- Image Preview -->
                            <div class="mb-3">
                                <img id="image-preview" src="#" alt="Preview"
                                    class="hidden max-h-48 rounded-lg shadow-md border border-gray-200 object-cover">
                                <p class="text-xs text-gray-500 mt-1">Preview gambar banner</p>
                            </div>

                            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" accept=".jpeg,.png,.jpg" required
                                onchange="previewImage(this)">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Recommended size: 1920x600px or 16:9 ratio.</p>
                        </div>

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title
                                (Optional)</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description
                                (Optional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="bg-emerald-600 text-white px-6 py-2 rounded-md hover:bg-emerald-700 transition-colors">Simpan
                                Banner</button>
                            <a href="{{ route('admin.banners.index') }}"
                                class="text-gray-600 hover:text-gray-900">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(input) {
                const preview = document.getElementById('image-preview');
                const file = input.files[0];

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                    preview.classList.add('hidden');
                }
            }
        </script>
    @endpush
</x-admin-layout>
