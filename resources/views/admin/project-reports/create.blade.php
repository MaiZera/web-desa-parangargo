<x-admin-layout>
    <x-slot name="header">
        Tambah Laporan Proyek
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('admin.project-reports.store') }}" method="POST"
                        enctype="multipart/form-data" id="reportForm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul
                                    Proyek</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                    required>
                                @error('title')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="location"
                                    class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                <input type="text" name="location" id="location" value="{{ old('location') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                    required>
                                @error('location')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="rt" class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                                <input type="text" name="rt" id="rt" value="{{ old('rt') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                    placeholder="01">
                                @error('rt')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="rw" class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                                <input type="text" name="rw" id="rw" value="{{ old('rw') }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                    placeholder="01">
                                @error('rw')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                                Singkat</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="percentage" class="block text-sm font-medium text-gray-700 mb-1">Persentase
                                    (%)</label>
                                <input type="number" name="percentage" id="percentage" min="0" max="100"
                                    value="{{ old('percentage', 0) }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                    required>
                                @error('percentage')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                    required>
                                    <option value="Pending" {{ old('status') == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="On Progress" {{ old('status') == 'On Progress' ? 'selected' : '' }}>On
                                        Progress</option>
                                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                </select>
                                @error('status')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @else
                                    <p class="text-xs text-gray-500 mt-1" id="statusHint">Status "Selesai" hanya tersedia
                                        jika progress 100%</p>
                                @enderror
                            </div>
                            <div>
                                <label for="fund_usage" class="block text-sm font-medium text-gray-700 mb-1">Penggunaan
                                    Dana (Rp)</label>
                                <input type="number" name="fund_usage" id="fund_usage"
                                    value="{{ old('fund_usage', 0) }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200"
                                    required>
                                @error('fund_usage')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Foto Proyek</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                            <p id="fileSizeError" class="text-red-600 text-xs mt-1 hidden">Ukuran file terlalu besar! Maksimal 5MB.</p>
                            @error('image')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @else
                                <p class="text-xs text-gray-500 mt-1">Maksimal ukuran file: 5MB</p>
                            @enderror

                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <img id="previewImg" src="" alt="Preview"
                                    class="h-40 w-auto rounded-lg border border-gray-300">
                            </div>
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.project-reports.index') }}"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-emerald-600 rounded-md hover:bg-emerald-700">
                                Simpan Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image Preview
            document.getElementById('image').addEventListener('change', function(e) {
                const file = e.target.files[0];
                const fileSizeError = document.getElementById('fileSizeError');
                
                if (file) {
                    // Check file size (5MB = 5 * 1024 * 1024 bytes)
                    if (file.size > 5 * 1024 * 1024) {
                        fileSizeError.classList.remove('hidden');
                        e.target.value = '';
                        document.getElementById('imagePreview').classList.add('hidden');
                        return;
                    } else {
                        fileSizeError.classList.add('hidden');
                    }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('previewImg').src = e.target.result;
                        document.getElementById('imagePreview').classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    fileSizeError.classList.add('hidden');
                    document.getElementById('imagePreview').classList.add('hidden');
                }
            });

            // Status validation based on percentage
            const percentageInput = document.getElementById('percentage');
            const statusSelect = document.getElementById('status');
            const selesaiOption = statusSelect.querySelector('option[value="Selesai"]');

            function updateStatusAvailability() {
                const percentage = parseInt(percentageInput.value) || 0;

                if (percentage < 100) {
                    selesaiOption.disabled = true;
                    if (statusSelect.value === 'Selesai') {
                        statusSelect.value = 'On Progress';
                    }
                } else {
                    selesaiOption.disabled = false;
                }
            }

            percentageInput.addEventListener('input', updateStatusAvailability);
            updateStatusAvailability(); // Run on page load
        </script>
    @endpush
</x-admin-layout>