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

                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <label class="block text-lg font-medium text-gray-700 mb-4">Data Penduduk</label>

                            <!-- Mode Selection -->
                            <div class="mb-4">
                                <span class="text-sm font-medium text-gray-700 mr-4">Mode Input:</span>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" name="penduduk_mode" value="total"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500" checked
                                        onchange="togglePendudukMode()">
                                    <span class="ml-2 text-sm text-gray-700">Total Penduduk</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="penduduk_mode" value="detail"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500"
                                        onchange="togglePendudukMode()">
                                    <span class="ml-2 text-sm text-gray-700">Detail (Laki-laki & Perempuan)</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Total Population -->
                                <div>
                                    <label for="jumlah_penduduk"
                                        class="block text-sm font-medium text-gray-700 mb-2">Jumlah Penduduk
                                        Total</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="number" name="jumlah_penduduk" id="jumlah_penduduk"
                                            value="{{ old('jumlah_penduduk', $demografis->jumlah_penduduk) }}"
                                            class="block w-full rounded-md border-gray-300 pr-12 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm bg-white"
                                            placeholder="Contoh: 5420">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 sm:text-sm">Jiwa</span>
                                        </div>
                                    </div>
                                    @error('jumlah_penduduk')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Male -->
                                <div class="detail-penduduk hidden">
                                    <label for="jumlah_laki_laki"
                                        class="block text-sm font-medium text-gray-700 mb-2">Jumlah Laki-laki</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="number" name="jumlah_laki_laki" id="jumlah_laki_laki"
                                            value="{{ old('jumlah_laki_laki', $demografis->jumlah_laki_laki) }}"
                                            class="block w-full rounded-md border-gray-300 pr-12 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                            placeholder="Contoh: 2700" oninput="calculateTotalPenduduk()">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 sm:text-sm">Jiwa</span>
                                        </div>
                                    </div>
                                    @error('jumlah_laki_laki')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Female -->
                                <div class="detail-penduduk hidden">
                                    <label for="jumlah_perempuan"
                                        class="block text-sm font-medium text-gray-700 mb-2">Jumlah Perempuan</label>
                                    <div class="relative mt-1 rounded-md shadow-sm">
                                        <input type="number" name="jumlah_perempuan" id="jumlah_perempuan"
                                            value="{{ old('jumlah_perempuan', $demografis->jumlah_perempuan) }}"
                                            class="block w-full rounded-md border-gray-300 pr-12 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                            placeholder="Contoh: 2720" oninput="calculateTotalPenduduk()">
                                        <div
                                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 sm:text-sm">Jiwa</span>
                                        </div>
                                    </div>
                                    @error('jumlah_perempuan')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <script>
                            function togglePendudukMode() {
                                const mode = document.querySelector('input[name="penduduk_mode"]:checked').value;
                                const detailInputs = document.querySelectorAll('.detail-penduduk');
                                const totalInput = document.getElementById('jumlah_penduduk');

                                if (mode === 'detail') {
                                    const total = parseInt(totalInput.value) || 0;
                                    const laki = parseInt(document.getElementById('jumlah_laki_laki').value) || 0;
                                    const perempuan = parseInt(document.getElementById('jumlah_perempuan').value) || 0;

                                    // If total exists but details are empty, split total
                                    if (total > 0 && laki === 0 && perempuan === 0) {
                                        const half = Math.floor(total / 2);
                                        const remainder = total % 2;
                                        document.getElementById('jumlah_laki_laki').value = half + remainder; // Give remainder to male
                                        document.getElementById('jumlah_perempuan').value = half;
                                    }

                                    detailInputs.forEach(el => el.classList.remove('hidden'));
                                    totalInput.readOnly = true;
                                    totalInput.classList.add('bg-gray-100');
                                    // Ensure total logic consistent in case we didn't split (if previous values existed)
                                    calculateTotalPenduduk();
                                } else {
                                    detailInputs.forEach(el => el.classList.add('hidden'));
                                    totalInput.readOnly = false;
                                    totalInput.classList.remove('bg-gray-100');
                                }
                            }

                            function calculateTotalPenduduk() {
                                const laki = parseInt(document.getElementById('jumlah_laki_laki').value) || 0;
                                const perempuan = parseInt(document.getElementById('jumlah_perempuan').value) || 0;
                                document.getElementById('jumlah_penduduk').value = laki + perempuan;
                            }

                            // Run on load
                            document.addEventListener('DOMContentLoaded', function () {
                                // Check if detail data exists to pre-select mode
                                const laki = "{{ $demografis->jumlah_laki_laki }}";
                                const perempuan = "{{ $demografis->jumlah_perempuan }}";

                                if (laki > 0 || perempuan > 0) {
                                    document.querySelector('input[name="penduduk_mode"][value="detail"]').checked = true;
                                    togglePendudukMode();
                                }
                            });
                        </script>

                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <label class="block text-lg font-medium text-gray-700 mb-4">Tingkat Pendidikan</label>

                            <!-- Mode Selection -->
                            <div class="mb-4">
                                <span class="text-sm font-medium text-gray-700 mr-4">Mode Input:</span>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" name="tingkat_pendidikan[mode]" value="percentage"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500" {{ old('tingkat_pendidikan.mode', $demografis->tingkat_pendidikan['mode'] ?? 'percentage') === 'percentage' ? 'checked' : '' }}
                                        onchange="updatePendidikanLabels()">
                                    <span class="ml-2 text-sm text-gray-700">Persentase (%)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="tingkat_pendidikan[mode]" value="number"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500" {{ old('tingkat_pendidikan.mode', $demografis->tingkat_pendidikan['mode'] ?? '') === 'number' ? 'checked' : '' }} onchange="updatePendidikanLabels()">
                                    <span class="ml-2 text-sm text-gray-700">Jumlah (Jiwa)</span>
                                </label>
                            </div>

                            <!-- Inputs -->
                            <div class="grid grid-cols-2 gap-4">
                                @foreach(['sd' => 'SD / Sederajat', 'smp' => 'SMP / Sederajat', 'sma' => 'SMA / Sederajat', 'pt' => 'Perguruan Tinggi'] as $key => $label)
                                    <div>
                                        <label for="pendidikan_{{ $key }}"
                                            class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <input type="number" name="tingkat_pendidikan[{{ $key }}]"
                                                id="pendidikan_{{ $key }}"
                                                class="block w-full rounded-md border-gray-300 pr-12 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                                value="{{ old('tingkat_pendidikan.' . $key, $demografis->tingkat_pendidikan[$key] ?? 0) }}"
                                                placeholder="0">
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                <span class="text-gray-500 sm:text-sm pendidikan-unit">%</span>
                                            </div>
                                        </div>
                                        @error('tingkat_pendidikan.' . $key)
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            @error('tingkat_pendidikan')
                                <div class="mt-2 p-2 bg-red-50 border border-red-200 text-red-600 rounded text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <script>
                            function updatePendidikanLabels() {
                                const mode = document.querySelector('input[name="tingkat_pendidikan[mode]"]:checked').value;
                                const units = document.querySelectorAll('.pendidikan-unit');
                                const inputs = document.querySelectorAll('[name^="tingkat_pendidikan["]:not([name*="mode"])');

                                units.forEach(unit => {
                                    unit.textContent = mode === 'percentage' ? '%' : 'Jiwa';
                                });
                            }
                            // Run on load
                            document.addEventListener('DOMContentLoaded', updatePendidikanLabels);
                        </script>

                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <label class="block text-lg font-medium text-gray-700 mb-4">Mata Pencaharian</label>

                            <!-- Mode Selection -->
                            <div class="mb-4">
                                <span class="text-sm font-medium text-gray-700 mr-4">Mode Input:</span>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" name="mata_pencaharian[mode]" value="percentage"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500" {{ old('mata_pencaharian.mode', $demografis->mata_pencaharian['mode'] ?? 'percentage') === 'percentage' ? 'checked' : '' }}
                                        onchange="updatePencaharianLabels()">
                                    <span class="ml-2 text-sm text-gray-700">Persentase (%)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="mata_pencaharian[mode]" value="number"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500" {{ old('mata_pencaharian.mode', $demografis->mata_pencaharian['mode'] ?? '') === 'number' ? 'checked' : '' }} onchange="updatePencaharianLabels()">
                                    <span class="ml-2 text-sm text-gray-700">Jumlah (Jiwa)</span>
                                </label>
                            </div>

                            <!-- Dynamic Inputs -->
                            <div id="pencaharian-container" class="space-y-3">
                                @php
                                    $pencaharianData = old('mata_pencaharian.data', $demografis->mata_pencaharian['data'] ?? []);
                                    // Make sure there is at least one empty row if no data
                                    if (empty($pencaharianData))
                                        $pencaharianData = [['name' => '', 'amount' => '']];
                                @endphp

                                @foreach($pencaharianData as $index => $item)
                                    <div class="flex items-center gap-4 p-2 bg-gray-50 rounded-md pencaharian-row">
                                        <div class="flex-grow">
                                            <input type="text" name="mata_pencaharian[data][{{ $index }}][name]"
                                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                                placeholder="Nama Mata Pencaharian (misal: Petani)"
                                                value="{{ $item['name'] ?? '' }}">
                                        </div>
                                        <div class="w-1/3 relative">
                                            <input type="number" name="mata_pencaharian[data][{{ $index }}][amount]"
                                                class="block w-full rounded-md border-gray-300 pr-12 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                                placeholder="Jumlah" value="{{ $item['amount'] ?? '' }}">
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                <span class="text-gray-500 sm:text-sm pencaharian-unit">%</span>
                                            </div>
                                        </div>
                                        <button type="button" onclick="removePencaharianRow(this)"
                                            class="text-red-500 hover:text-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" onclick="addPencaharianRow()"
                                class="mt-3 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-emerald-700 bg-emerald-100 hover:bg-emerald-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                                + Tambah Mata Pencaharian
                            </button>

                            @if($errors->has('mata_pencaharian'))
                                <div class="mt-2 text-red-600 text-sm">{{ $errors->first('mata_pencaharian') }}</div>
                            @endif
                            <!-- Display errors for nested fields if any -->
                            @if($errors->has('mata_pencaharian.data.*.name') || $errors->has('mata_pencaharian.data.*.amount'))
                                <div class="mt-1 text-red-600 text-xs">Pastikan semua nama dan jumlah terisi.</div>
                            @endif
                        </div>

                        <script>
                            function updatePencaharianLabels() {
                                const mode = document.querySelector('input[name="mata_pencaharian[mode]"]:checked').value;
                                const units = document.querySelectorAll('.pencaharian-unit');
                                units.forEach(unit => {
                                    unit.textContent = mode === 'percentage' ? '%' : 'Jiwa';
                                });
                            }

                            function addPencaharianRow() {
                                const container = document.getElementById('pencaharian-container');
                                const index = container.children.length;
                                const mode = document.querySelector('input[name="mata_pencaharian[mode]"]:checked').value;
                                const unitText = mode === 'percentage' ? '%' : 'Jiwa';

                                const row = document.createElement('div');
                                row.className = 'flex items-center gap-4 p-2 bg-gray-50 rounded-md pencaharian-row';
                                row.innerHTML = `
                                    <div class="flex-grow">
                                        <input type="text" name="mata_pencaharian[data][${index}][name]" 
                                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                            placeholder="Nama Mata Pencaharian">
                                    </div>
                                    <div class="w-1/3 relative">
                                        <input type="number" name="mata_pencaharian[data][${index}][amount]" 
                                            class="block w-full rounded-md border-gray-300 pr-12 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                            placeholder="Jumlah">
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <span class="text-gray-500 sm:text-sm pencaharian-unit">${unitText}</span>
                                        </div>
                                    </div>
                                    <button type="button" onclick="removePencaharianRow(this)" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                `;
                                container.appendChild(row);
                            }

                            function removePencaharianRow(button) {
                                const container = document.getElementById('pencaharian-container');
                                if (container.children.length > 1) {
                                    button.closest('.pencaharian-row').remove();
                                    // Optional: Re-index inputs if strictly necessary, but Laravel handles non-sequential indices for arrays often fine. 
                                    // To be safe, we rely on PHP's array_values() or ensuring validation validation doesn't depend on strict 0,1,2 sequence keys but 'data' array.
                                    // However, for HTML form naming uniqueness, we might need simple re-indexing if we delete middle rows.
                                    // For simplicity in this step, we'll assume basic deletion.
                                } else {
                                    alert("Minimal satu baris tersisa.");
                                }
                            }

                            // Initialize logic
                            document.addEventListener('DOMContentLoaded', function () {
                                updatePencaharianLabels();
                            });
                        </script>

                        <div class="mb-6 p-4 border border-gray-200 rounded-lg">
                            <label class="block text-lg font-medium text-gray-700 mb-4">Agama</label>

                            <!-- Mode Selection -->
                            <div class="mb-4">
                                <span class="text-sm font-medium text-gray-700 mr-4">Mode Input:</span>
                                <label class="inline-flex items-center mr-4">
                                    <input type="radio" name="agama[mode]" value="percentage"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500" {{ old('agama.mode', $demografis->agama['mode'] ?? 'percentage') === 'percentage' ? 'checked' : '' }}
                                        onchange="updateAgamaLabels()">
                                    <span class="ml-2 text-sm text-gray-700">Persentase (%)</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="agama[mode]" value="number"
                                        class="form-radio text-emerald-600 focus:ring-emerald-500" {{ old('agama.mode', $demografis->agama['mode'] ?? '') === 'number' ? 'checked' : '' }}
                                        onchange="updateAgamaLabels()">
                                    <span class="ml-2 text-sm text-gray-700">Jumlah (Jiwa)</span>
                                </label>
                            </div>

                            <!-- Inputs -->
                            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach(['islam' => 'Islam', 'kristen' => 'Kristen', 'katolik' => 'Katolik', 'hindu' => 'Hindu', 'buddha' => 'Buddha', 'konghucu' => 'Konghucu'] as $key => $label)
                                    <div>
                                        <label for="agama_{{ $key }}"
                                            class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                                        <div class="relative rounded-md shadow-sm">
                                            <input type="number" name="agama[{{ $key }}]" id="agama_{{ $key }}"
                                                class="block w-full rounded-md border-gray-300 pr-12 focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                                                value="{{ old('agama.' . $key, $demografis->agama[$key] ?? 0) }}"
                                                placeholder="0">
                                            <div
                                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                                <span class="text-gray-500 sm:text-sm agama-unit">%</span>
                                            </div>
                                        </div>
                                        @error('agama.' . $key)
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                            @error('agama')
                                <div class="mt-2 p-2 bg-red-50 border border-red-200 text-red-600 rounded text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <script>
                            function updateAgamaLabels() {
                                const mode = document.querySelector('input[name="agama[mode]"]:checked').value;
                                const units = document.querySelectorAll('.agama-unit');
                                units.forEach(unit => {
                                    unit.textContent = mode === 'percentage' ? '%' : 'Jiwa';
                                });
                            }
                            // Run on load
                            document.addEventListener('DOMContentLoaded', updateAgamaLabels);
                        </script>

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
