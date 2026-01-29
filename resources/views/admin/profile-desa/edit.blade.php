<x-admin-layout>
    <x-slot name="header">
        Profile Desa
    </x-slot>

    <!-- Trix Editor CSS -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>

    <style>
        trix-toolbar .trix-button-group--file-tools {
            display: none;
        }

        /* Style for lists in Trix editor */
        trix-editor ul {
            list-style-type: disc;
            padding-left: 2.5rem;
        }

        trix-editor ol {
            list-style-type: decimal;
            padding-left: 2.5rem;
        }

        trix-editor li {
            margin-bottom: 0.25rem;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.profile-desa.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Foto/Gambar
                                Desa</label>

                            @if($profile->image_path)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $profile->image_path) }}" alt="Profile Desa"
                                        class="w-48 h-32 rounded-lg object-cover">
                                    <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                                </div>
                            @endif

                            <input type="file" name="image" id="image" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-emerald-50 file:text-emerald-700
                                hover:file:bg-emerald-100" accept="image/*">
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi
                                Desa</label>
                            <input id="deskripsi" type="hidden" name="deskripsi"
                                value="{{ old('deskripsi', $profile->deskripsi) }}">
                            <trix-editor input="deskripsi"
                                class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Jelaskan tentang sejarah, lokasi, dan karakteristik
                                desa</p>
                            @error('deskripsi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">Visi Desa</label>
                            <input id="visi" type="hidden" name="visi" value="{{ old('visi', $profile->visi) }}">
                            <trix-editor input="visi" class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Visi jangka panjang pembangunan desa</p>
                            @error('visi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">Misi Desa</label>
                            <input id="misi" type="hidden" name="misi" value="{{ old('misi', $profile->misi) }}">
                            <trix-editor input="misi" class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Langkah-langkah strategis untuk mencapai visi</p>
                            @error('misi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit"
                                class="bg-emerald-600 text-white px-6 py-2 rounded-md hover:bg-emerald-700 transition-colors">Simpan
                                Perubahan</button>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
