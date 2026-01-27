<x-admin-layout>
    <x-slot name="header">
        Edit Agenda
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.agendas.update', $agenda->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Agenda</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul', $agenda->judul) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Rapat Koordinasi Desa">
                                @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Agenda</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                                @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Tanggal Mulai -->
                                <div>
                                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                    <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('Y-m-d\TH:i') : '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    @error('tanggal_mulai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Tanggal Selesai -->
                                <div>
                                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai (Opsional)</label>
                                    <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d\TH:i') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika hanya berlangsung sebentar.</p>
                                    @error('tanggal_selesai') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi Kegiatan</label>
                                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi', $agenda->lokasi) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Balai Desa Parangargo">
                                @error('lokasi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Penyelenggara -->
                                <div>
                                    <label for="penyelenggara" class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                                    <input type="text" name="penyelenggara" id="penyelenggara" value="{{ old('penyelenggara', $agenda->penyelenggara) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Karang Taruna">
                                </div>

                                <!-- Narahubung -->
                                <div>
                                    <label for="narahubung" class="block text-sm font-medium text-gray-700">Narahubung (CP)</label>
                                    <input type="text" name="narahubung" id="narahubung" value="{{ old('narahubung', $agenda->narahubung) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Budi (0812...)">
                                </div>
                            </div>
                            
                            <!-- Featured Toggle -->
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $agenda->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                                <label for="is_featured" class="text-sm font-medium text-gray-700">Tampilkan di Highlight Website (Featured)</label>
                            </div>

                            <div class="flex justify-end pt-6">
                                <a href="{{ route('admin.agendas.index') }}" class="mr-4 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">Batal</a>
                                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition-colors">Perbarui Agenda</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
