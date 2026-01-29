<x-admin-layout>
    <x-slot name="header">
        Kontak Desa
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.contact-info.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Contact Info Section -->
                        <div class="mb-8">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Kontak</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                        Telepon</label>
                                    <input type="text" name="telepon" id="telepon"
                                        value="{{ old('telepon', $profile->telepon) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    @error('telepon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $profile->email) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                        Lengkap</label>
                                    <textarea name="alamat" id="alamat" rows="2"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('alamat', $profile->alamat) }}</textarea>
                                    @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Social Media Section -->
                        <div class="mb-8 border-t border-gray-100 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Media Sosial</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="facebook" class="block text-sm font-medium text-gray-700 mb-2">Facebook
                                        URL</label>
                                    <input type="text" name="facebook" id="facebook"
                                        value="{{ old('facebook', $profile->facebook) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="https://facebook.com/...">
                                </div>

                                <div>
                                    <label for="instagram"
                                        class="block text-sm font-medium text-gray-700 mb-2">Instagram URL</label>
                                    <input type="text" name="instagram" id="instagram"
                                        value="{{ old('instagram', $profile->instagram) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="https://instagram.com/...">
                                </div>

                                <div>
                                    <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter/X
                                        URL</label>
                                    <input type="text" name="twitter" id="twitter"
                                        value="{{ old('twitter', $profile->twitter) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="https://twitter.com/...">
                                </div>

                                <div>
                                    <label for="youtube" class="block text-sm font-medium text-gray-700 mb-2">YouTube
                                        URL</label>
                                    <input type="text" name="youtube" id="youtube"
                                        value="{{ old('youtube', $profile->youtube) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="https://youtube.com/...">
                                </div>

                                <div>
                                    <label for="tiktok" class="block text-sm font-medium text-gray-700 mb-2">TikTok
                                        URL</label>
                                    <input type="text" name="tiktok" id="tiktok"
                                        value="{{ old('tiktok', $profile->tiktok) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="https://tiktok.com/...">
                                </div>
                            </div>
                        </div>

                        <!-- Operational Hours Section -->
                        <div class="mb-8 border-t border-gray-100 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Jam Pelayanan</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="jam_kerja_senin_kamis"
                                        class="block text-sm font-medium text-gray-700 mb-2">Senin - Kamis</label>
                                    <input type="text" name="jam_kerja_senin_kamis" id="jam_kerja_senin_kamis"
                                        value="{{ old('jam_kerja_senin_kamis', $profile->jam_kerja_senin_kamis) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Contoh: 08:00 - 15:00">
                                </div>

                                <div>
                                    <label for="jam_kerja_jumat"
                                        class="block text-sm font-medium text-gray-700 mb-2">Jumat</label>
                                    <input type="text" name="jam_kerja_jumat" id="jam_kerja_jumat"
                                        value="{{ old('jam_kerja_jumat', $profile->jam_kerja_jumat) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Contoh: 08:00 - 11:30">
                                </div>

                                <div>
                                    <label for="jam_kerja_sabtu_minggu"
                                        class="block text-sm font-medium text-gray-700 mb-2">Sabtu - Minggu</label>
                                    <input type="text" name="jam_kerja_sabtu_minggu" id="jam_kerja_sabtu_minggu"
                                        value="{{ old('jam_kerja_sabtu_minggu', $profile->jam_kerja_sabtu_minggu) }}"
                                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                                        placeholder="Contoh: Libur">
                                </div>
                            </div>
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