<x-admin-layout>
    <x-slot name="header">
        Demografis Desa
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

                    <form action="{{ route('admin.demografis.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="jumlah_penduduk" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Penduduk</label>
                                <input type="number" name="jumlah_penduduk" id="jumlah_penduduk" value="{{ old('jumlah_penduduk', $demografis->jumlah_penduduk) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Contoh: 5420">
                                @error('jumlah_penduduk')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="kepadatan" class="block text-sm font-medium text-gray-700 mb-2">Kepadatan Penduduk</label>
                                <input type="text" name="kepadatan" id="kepadatan" value="{{ old('kepadatan', $demografis->kepadatan) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Contoh: 250 jiwa/km²">
                                @error('kepadatan')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="struktur_umur" class="block text-sm font-medium text-gray-700 mb-2">Struktur Umur</label>
                            <input id="struktur_umur" type="hidden" name="struktur_umur" value="{{ old('struktur_umur', $demografis->struktur_umur) }}">
                            <trix-editor input="struktur_umur" class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Contoh: 0-14 tahun: 25%, 15-64 tahun: 65%, 65+ tahun: 10%</p>
                        </div>

                        <div class="mb-6">
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin</label>
                            <input id="jenis_kelamin" type="hidden" name="jenis_kelamin" value="{{ old('jenis_kelamin', $demografis->jenis_kelamin) }}">
                            <trix-editor input="jenis_kelamin" class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Contoh: Laki-laki: 2,700 jiwa, Perempuan: 2,720 jiwa</p>
                        </div>

                        <div class="mb-6">
                            <label for="tingkat_pendidikan" class="block text-sm font-medium text-gray-700 mb-2">Tingkat Pendidikan</label>
                            <input id="tingkat_pendidikan" type="hidden" name="tingkat_pendidikan" value="{{ old('tingkat_pendidikan', $demografis->tingkat_pendidikan) }}">
                            <trix-editor input="tingkat_pendidikan" class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Contoh: SD: 30%, SMP: 25%, SMA: 30%, Perguruan Tinggi: 15%</p>
                        </div>

                        <div class="mb-6">
                            <label for="mata_pencaharian" class="block text-sm font-medium text-gray-700 mb-2">Mata Pencaharian</label>
                            <input id="mata_pencaharian" type="hidden" name="mata_pencaharian" value="{{ old('mata_pencaharian', $demografis->mata_pencaharian) }}">
                            <trix-editor input="mata_pencaharian" class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Contoh: Petani: 40%, Pedagang: 25%, PNS: 15%, Wiraswasta: 20%</p>
                        </div>

                        <div class="mb-6">
                            <label for="agama" class="block text-sm font-medium text-gray-700 mb-2">Agama</label>
                            <input id="agama" type="hidden" name="agama" value="{{ old('agama', $demografis->agama) }}">
                            <trix-editor input="agama" class="trix-content border-gray-300 rounded-md"></trix-editor>
                            <p class="text-xs text-gray-500 mt-1">Contoh: Islam: 85%, Kristen: 10%, Hindu: 3%, Buddha: 2%</p>
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-emerald-600 text-white px-6 py-2 rounded-md hover:bg-emerald-700 transition-colors">Simpan Perubahan</button>
                            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
