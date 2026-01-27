<x-admin-layout>
    <x-slot name="header">
        Tambah UMKM Baru
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-6">
                                <div>
                                    <label for="nama_usaha" class="block text-sm font-medium text-gray-700">Nama
                                        Usaha</label>
                                    <input type="text" name="nama_usaha" id="nama_usaha" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Contoh: Kripik Tempe Bu Ani">
                                    @error('nama_usaha') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="nama_pemilik" class="block text-sm font-medium text-gray-700">Nama
                                        Pemilik</label>
                                    <input type="text" name="nama_pemilik" id="nama_pemilik" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                    @error('nama_pemilik') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori
                                        Usaha</label>
                                    <select name="kategori" id="kategori" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        <option value="">Pilih Kategori...</option>
                                        <option value="Kuliner">Kuliner / Makanan</option>
                                        <option value="Kerajinan">Kerajinan Tangan</option>
                                        <option value="Jasa">Jasa / Layanan</option>
                                        <option value="Pertanian">Pertanian / Perkebunan</option>
                                        <option value="Perdagangan">Perdagangan / Toko</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                    @error('kategori') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi
                                        Singkat</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"></textarea>
                                    @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Produk & Layanan</label>
                                    <div id="produk-container" class="space-y-2">
                                        @php
                                            $produkList = old('produk_layanan', ['']);
                                        @endphp
                                        @foreach($produkList as $index => $item)
                                            <div class="flex items-center gap-2 produk-row">
                                                <input type="text" name="produk_layanan[]" value="{{ $item }}"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                                    placeholder="Nama Produk atau Layanan">

                                                <button type="button" onclick="removeProdukRow(this)"
                                                    class="text-red-500 hover:text-red-700 focus:outline-none p-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="button" onclick="addProdukRow()"
                                        class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                        + Tambah Produk/Layanan
                                    </button>
                                    @error('produk_layanan') <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                    @error('produk_layanan.*') <div class="text-red-500 text-sm mt-1">{{ $message }}
                                    </div> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Kisaran Harga (Rp)</label>
                                    <div class="grid grid-cols-2 gap-4 mt-1">
                                        <div>
                                            <input type="number" name="kisaran_harga_min" placeholder="Min"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>
                                        <div>
                                            <input type="number" name="kisaran_harga_max" placeholder="Max"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                        </div>
                                    </div>
                                    @error('kisaran_harga_min') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                    @error('kisaran_harga_max') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jadwal Buka</label>

                                    <!-- Schedule Mode Toggle -->
                                    <div class="flex items-center gap-4 mb-3">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="schedule_mode" value="simple" checked
                                                onchange="toggleScheduleMode()"
                                                class="text-emerald-600 focus:ring-emerald-500">
                                            <span class="ml-2 text-sm text-gray-700">Setiap Hari Sama</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="schedule_mode" value="detail"
                                                onchange="toggleScheduleMode()"
                                                class="text-emerald-600 focus:ring-emerald-500">
                                            <span class="ml-2 text-sm text-gray-700">Berbeda Setiap Hari</span>
                                        </label>
                                    </div>

                                    <!-- Simple Mode Input -->
                                    <div id="schedule-simple"
                                        class="p-3 bg-gray-50 rounded-md border border-gray-200 mb-2">
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1">Jam
                                                    Buka</label>
                                                <input type="time" id="simple-buka" onchange="syncSimpleSchedule()"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-xs font-medium text-gray-500 mb-1">Jam
                                                    Tutup</label>
                                                <input type="time" id="simple-tutup" onchange="syncSimpleSchedule()"
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm">
                                            </div>
                                        </div>
                                        <div class="mt-2 flex items-center">
                                            <input type="checkbox" id="simple-libur" onchange="syncSimpleSchedule()"
                                                class="rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 h-4 w-4">
                                            <label for="simple-libur" class="ml-2 text-sm text-gray-600">Libur /
                                                Tutup</label>
                                        </div>
                                    </div>

                                    <!-- Detailed Mode Input (Hidden by default if simple) -->
                                    <div id="schedule-detail" class="space-y-2 hidden">
                                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                            <div class="flex items-center space-x-2 schedule-row" data-day="{{ $day }}">
                                                <div class="w-16 text-sm text-gray-600 font-medium">{{ $day }}</div>
                                                <div class="flex-1 grid grid-cols-2 gap-2">
                                                    <input type="time" name="jam_buka[{{ $day }}][buka]"
                                                        class="schedule-buka rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-xs">
                                                    <input type="time" name="jam_buka[{{ $day }}][tutup]"
                                                        class="schedule-tutup rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 text-xs">
                                                </div>
                                                <div class="flex items-center">
                                                    <input type="checkbox" name="jam_buka[{{ $day }}][libur]" value="1"
                                                        class="schedule-libur rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 h-4 w-4">
                                                    <label class="ml-1 text-xs text-xs text-gray-500">Libur</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-6">
                                <div>
                                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat
                                        Lengkap</label>
                                    <textarea name="alamat" id="alamat" rows="2" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"></textarea>
                                    @error('alamat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700">No
                                        Telepon/WhatsApp</label>
                                    <input type="text" name="telepon" id="telepon"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                        placeholder="Contoh: 081234567890">
                                </div>

                                <div>
                                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram
                                        (Opsional)</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">@</span>
                                        <input type="text" name="instagram" id="instagram"
                                            class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                            placeholder="username">
                                    </div>
                                </div>

                                <div>
                                    <label for="foto_produk" class="block text-sm font-medium text-gray-700">Foto Produk
                                        / Tempat Usaha</label>
                                    <input type="file" name="foto_produk" id="foto_produk" accept="image/*" class="mt-1 block w-full text-sm text-slate-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-full file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-emerald-50 file:text-emerald-700
                                      hover:file:bg-emerald-100
                                    ">
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Max: 2MB.</p>
                                    @error('foto_produk') <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="pt-4">
                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input id="is_active" name="is_active" type="checkbox" value="1" checked
                                                class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="is_active" class="font-medium text-gray-700">Status
                                                Aktif</label>
                                            <p class="text-gray-500">Tampilkan UMKM ini di halaman publik.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-8 border-t mt-8">
                            <a href="{{ route('admin.umkm.index') }}"
                                class="mr-4 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">Batal</a>
                            <button type="submit"
                                class="px-6 py-2 bg-emerald-600 text-white rounded-lg text-sm font-bold hover:bg-emerald-700 transition-colors">Simpan
                                UMKM</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Produk Script
            function addProdukRow() {
                const container = document.getElementById('produk-container');
                const row = document.createElement('div');
                row.className = 'flex items-center gap-2 produk-row';
                row.innerHTML = `
                    <input type="text" name="produk_layanan[]" 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm" 
                        placeholder="Nama Produk atau Layanan">

                    <button type="button" onclick="removeProdukRow(this)" class="text-red-500 hover:text-red-700 focus:outline-none p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                `;
                container.appendChild(row);
            }

            function removeProdukRow(btn) {
                const container = document.getElementById('produk-container');
                if (container.children.length > 1) {
                    btn.closest('.produk-row').remove();
                } else {
                    btn.closest('.produk-row').querySelector('input').value = '';
                }
            }

            // Schedule Script
            function toggleScheduleMode() {
                const mode = document.querySelector('input[name="schedule_mode"]:checked').value;
                const simpleDiv = document.getElementById('schedule-simple');
                const detailDiv = document.getElementById('schedule-detail');

                if (mode === 'simple') {
                    simpleDiv.classList.remove('hidden');
                    detailDiv.classList.add('hidden');
                    syncSimpleSchedule();
                } else {
                    simpleDiv.classList.add('hidden');
                    detailDiv.classList.remove('hidden');
                }
            }

            function syncSimpleSchedule() {
                const buka = document.getElementById('simple-buka').value;
                const tutup = document.getElementById('simple-tutup').value;
                const libur = document.getElementById('simple-libur').checked;

                const rows = document.querySelectorAll('.schedule-row');
                rows.forEach(row => {
                    const bukaInput = row.querySelector('.schedule-buka');
                    const tutupInput = row.querySelector('.schedule-tutup');
                    const liburInput = row.querySelector('.schedule-libur');

                    bukaInput.value = buka;
                    tutupInput.value = tutup;
                    liburInput.checked = libur;
                });
            }

            document.addEventListener('DOMContentLoaded', function () {
                toggleScheduleMode();
            });
        </script>
    @endpush
</x-admin-layout>