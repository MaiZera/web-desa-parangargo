@extends('layouts.main')

@section('content')
    <div class="py-12 px-4 max-w-4xl mx-auto space-y-12">
        <div class="text-center space-y-4">
            <h1 class="text-4xl font-bold">Partisipasi Warga</h1>
            <p class="text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto">Punya saran, keluhan, atau ide untuk desa
                kita? Jangan ragu untuk bersuara! Partisipasi Anda sangat berarti untuk kemajuan Desa Mandiri Jaya.</p>
        </div>

        <form action="{{ route('feedback.submit') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-10 rounded-[3rem] shadow-xl border border-slate-100 space-y-6">
            @csrf
            <h3 class="text-2xl font-bold mb-4 text-center">Formulir Aspirasi</h3>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 text-emerald-700 rounded-xl mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-red-50 text-red-700 rounded-xl mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="space-y-4">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Nama Lengkap</label>
                    <input required=""
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                        placeholder="Contoh: Budi Santoso" type="text" name="nama" value="{{ old('nama') }}">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">RT</label>
                        <input required=""
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="001" type="text" name="rt" value="{{ old('rt') }}" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700">RW</label>
                        <input required=""
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="001" type="text" name="rw" value="{{ old('rw') }}" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Nomor Telepon <span
                            class="text-slate-400 font-normal">(Opsional)</span></label>
                    <input
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                        placeholder="Contoh: 08123456789" type="tel" name="telepon" value="{{ old('telepon') }}"
                        inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Kategori Aspirasi</label>
                    <select
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                        name="kategori">
                        <option {{ old('kategori') == 'Saran Pembangunan' ? 'selected' : '' }}>Saran Pembangunan</option>
                        <option {{ old('kategori') == 'Keluhan Pelayanan' ? 'selected' : '' }}>Keluhan Pelayanan</option>
                        <option {{ old('kategori') == 'Laporan Keamanan' ? 'selected' : '' }}>Laporan Keamanan</option>
                        <option {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Pesan Aspirasi</label>
                    <textarea required="" rows="5"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500 resize-none"
                        placeholder="Tuliskan detail masukan atau keluhan Anda di sini..."
                        name="deskripsi">{{ old('deskripsi') }}</textarea>
                </div>
                <!-- Added File Input -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700">Unggah Foto Pendukung <span
                            class="text-slate-400 font-normal">(Opsional)</span></label>
                    <input
                        class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100"
                        type="file" name="lampiran" accept="image/*" onchange="previewImage(event)">
                    <img id="preview" class="hidden mt-2 max-w-[200px] rounded-lg border border-slate-200"
                        alt="Preview Foto">
                </div>
            </div>
            <button type="submit"
                class="w-full bg-emerald-600 text-white py-4 rounded-2xl font-bold hover:bg-emerald-700 transition-all flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/20">
                Kirim Aspirasi
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-send w-4 h-4" aria-hidden="true">
                    <path
                        d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z">
                    </path>
                    <path d="m21.854 2.147-10.94 10.939"></path>
                </svg>
            </button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function () {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.classList.remove('hidden');
            }
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
    </script>
@endsection
