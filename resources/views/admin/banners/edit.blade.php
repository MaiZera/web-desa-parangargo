<x-admin-layout>
    <x-slot name="header">
        Edit Banner
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Banner Image</label>

                            <!-- Image Preview -->
                            <div class="mb-3">
                                @if($banner->image_path)
                                    <img id="image-preview" src="{{ asset('storage/' . $banner->image_path) }}"
                                        alt="Preview"
                                        class="max-h-48 rounded-lg shadow-md border border-gray-200 object-cover">
                                @else
                                    <img id="image-preview" src="#" alt="Preview"
                                        class="hidden max-h-48 rounded-lg shadow-md border border-gray-200 object-cover">
                                @endif
                            </div>

                            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100" accept=".jpeg,.png,.jpg" onchange="previewImage(this)">
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar.</p>
                        </div>

                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title
                                (Optional)</label>
                            <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description
                                (Optional)</label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $banner->description) }}</textarea>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="bg-emerald-600 text-white px-6 py-2 rounded-md hover:bg-emerald-700 transition-colors">Perbarui
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
                }
            }
        </script>
    @endpush
</x-admin-layout>
