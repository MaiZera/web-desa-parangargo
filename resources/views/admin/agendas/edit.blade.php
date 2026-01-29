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

                    <form action="{{ route('admin.agendas.update', $agenda->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Judul -->
                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Agenda</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul', $agenda->judul) }}"
                                    required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                    placeholder="Contoh: Rapat Koordinasi Desa">
                                @error('judul') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>



                            <!-- Deskripsi -->
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi
                                    Agenda</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                                @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Gambar -->


                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Tanggal Mulai -->
                                <div>
                                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Waktu
                                        Mulai</label>
                                    <input type="datetime-local" name="tanggal_mulai" id="tanggal_mulai"
                                        value="{{ old('tanggal_mulai', $agenda->tanggal_mulai ? $agenda->tanggal_mulai->format('Y-m-d\TH:i') : '') }}"
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    @error('tanggal_mulai') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Tanggal Selesai -->
                                <div>
                                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Waktu
                                        Selesai (Opsional)</label>
                                    <input type="datetime-local" name="tanggal_selesai" id="tanggal_selesai"
                                        value="{{ old('tanggal_selesai', $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d\TH:i') : '') }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    <p class="text-xs text-gray-500 mt-1">Kosongkan jika hanya berlangsung sebentar.</p>
                                    @error('tanggal_selesai') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi
                                    Kegiatan</label>
                                <input type="text" name="lokasi" id="lokasi"
                                    value="{{ old('lokasi', $agenda->lokasi) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                    placeholder="Contoh: Balai Desa Parangargo">
                                @error('lokasi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Penyelenggara -->
                                <div>
                                    <label for="penyelenggara"
                                        class="block text-sm font-medium text-gray-700">Penyelenggara</label>
                                    <input type="text" name="penyelenggara" id="penyelenggara"
                                        value="{{ old('penyelenggara', $agenda->penyelenggara) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Contoh: Karang Taruna">
                                </div>

                                <!-- Narahubung -->
                                <div>
                                    <label for="narahubung" class="block text-sm font-medium text-gray-700">Nama
                                        Narahubung</label>
                                    <input type="text" name="narahubung" id="narahubung"
                                        value="{{ old('narahubung', $agenda->narahubung) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Contoh: Budi">
                                </div>

                                <!-- No HP Narahubung -->
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700">No HP
                                        Narahubung</label>
                                    <input type="text" name="telepon" id="telepon"
                                        value="{{ old('telepon', $agenda->telepon) }}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Contoh: 08123456789">
                                </div>
                            </div>



                            <!-- Gambar -->
                            <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">Poster / Gambar
                                    (Opsional)</label>

                                <!-- Existing Image Display -->
                                @if($agenda->gambar)
                                    <div class="mb-4">
                                        <p class="text-xs text-gray-500 mb-2">Gambar saat ini:</p>
                                        <div class="inline-block relative group">
                                            <img src="{{ asset('storage/' . $agenda->gambar) }}"
                                                class="h-32 w-auto rounded-lg border border-slate-200 object-cover">
                                        </div>
                                    </div>
                                @endif

                                <!-- Image Preview -->
                                <div id="gambar-preview" class="hidden mb-3">
                                    <p class="text-xs text-gray-500 mb-2">Preview gambar baru:</p>
                                    <img src="" alt="Preview Gambar"
                                        class="max-w-[200px] h-auto rounded-lg object-cover shadow-sm border border-slate-200">
                                </div>

                                <input type="file" name="gambar" id="gambar" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-emerald-50 file:text-emerald-700
                                    hover:file:bg-emerald-100" accept="image/*" onchange="previewImage(this)">
                                <p class="text-xs text-gray-500 mt-1 italic">Format: JPG, PNG. Maks: 2MB. Biarkan kosong
                                    jika tidak ingin mengubah.</p>
                                @error('gambar')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="status_publikasi" class="block text-sm font-medium text-gray-700">Status
                                        Postingan</label>
                                    <select name="status_publikasi" id="status_publikasi"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        <option value="draft" {{ old('status_publikasi', $agenda->status_publikasi ?? 'draft') == 'draft' ? 'selected' : '' }}>Draft (Konsep)</option>
                                        <option value="published" {{ old('status_publikasi', $agenda->status_publikasi ?? 'published') == 'published' ? 'selected' : '' }}>Published (Terbit)
                                        </option>
                                    </select>
                                </div>
                                <div>
                                    <label for="status_kegiatan" class="block text-sm font-medium text-gray-700">Status
                                        Kegiatan</label>
                                    <select name="status_kegiatan" id="status_kegiatan"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        <option value="scheduled" {{ old('status_kegiatan', $agenda->status_kegiatan ?? 'scheduled') == 'scheduled' ? 'selected' : '' }}>Scheduled (Terjadwal)
                                        </option>
                                        <option value="ongoing" {{ old('status_kegiatan', $agenda->status_kegiatan ?? '') == 'ongoing' ? 'selected' : '' }}>Ongoing (Sedang Berlangsung)</option>
                                        <option value="completed" {{ old('status_kegiatan', $agenda->status_kegiatan ?? '') == 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                                        <option value="cancelled" {{ old('status_kegiatan', $agenda->status_kegiatan ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Featured Toggle -->
                            <div class="flex items-center gap-2 p-4 border border-slate-200 rounded-lg">
                                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $agenda->is_featured) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500">
                                <label for="is_featured" class="text-sm font-medium text-gray-700">Tampilkan di
                                    Highlight Website (Featured)</label>
                            </div>

                            <div class="flex justify-end pt-6">
                                <a href="{{ route('admin.agendas.index') }}"
                                    class="mr-4 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">Batal</a>
                                <button type="submit"
                                    class="px-6 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition-colors">Perbarui
                                    Agenda</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

@push('scripts')
    <script>
        function previewImage(input) {
            const previewContainer = document.getElementById('gambar-preview');
            const previewImage = previewContainer.querySelector('img');
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        }
    </script>
@endpush