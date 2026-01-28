<x-admin-layout>
    <x-slot name="header">
        Edit Agenda
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                            <p class="font-bold">Terjadi kesalahan:</p>
                            <ul class="mt-2 text-sm list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.agendas.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="space-y-6">
                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Agenda</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul', $agenda->judul) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Rapat Koordinasi Desa">
                                @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Gambar -->
                            <div>
                                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar Agenda (Opsional)</label>
                                @if($agenda->gambar)
                                    <div class="mt-2 mb-4">
                                        <img src="{{ asset('storage/' . $agenda->gambar) }}" class="w-32 h-20 object-cover rounded-lg border">
                                        <p class="text-xs text-gray-500 mt-1 italic">Gambar saat ini</p>
                                    </div>
                                @endif
                                <input type="file" name="gambar" id="gambar" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                <p class="text-[10px] text-gray-500 mt-1 italic">Maksimal ukuran gambar: 4MB (Kosongkan jika tidak ingin mengubah)</p>
                                @error('gambar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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
                                    <label for="narahubung" class="block text-sm font-medium text-gray-700">Nama Narahubung (CP)</label>
                                    <input type="text" name="narahubung" id="narahubung" value="{{ old('narahubung', $agenda->narahubung) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: Pak Budi">
                                </div>

                                <!-- No HP -->
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700">No HP / WhatsApp</label>
                                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $agenda->telepon) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" placeholder="Contoh: 08123456789">
                                    <p class="text-[10px] text-gray-500 mt-1">Gunakan format 08xx atau 628xx</p>
                                </div>
                            </div>

                            <!-- Auto Status Display -->
                            <div class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Status Saat Ini</label>
                                <div class="flex items-center gap-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase 
                                        @if($agenda->status == 'scheduled') bg-blue-100 text-blue-700 
                                        @elseif($agenda->status == 'ongoing') bg-amber-100 text-amber-700 
                                        @elseif($agenda->status == 'completed') bg-emerald-100 text-emerald-700 
                                        @else bg-gray-100 text-gray-700 @endif">
                                        {{ ucfirst($agenda->status) }}
                                    </span>
                                    <span class="text-xs text-slate-500 italic">Auto-status: sistem akan menyesuaikan status secara otomatis berdasarkan waktu mulai/selesai saat disimpan.</span>
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
