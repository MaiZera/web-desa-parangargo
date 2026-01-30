<x-admin-layout>
    <x-slot name="header">
        Pusat Akun
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        <!-- Informasi Profil -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Informasi Profil</h2>
                        <p class="text-sm text-slate-500">Perbarui informasi profil dan alamat email akun Anda.</p>
                    </div>
                </div>

                <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Nama Lengkap</label>
                            <input id="name" name="name" type="text" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700" value="{{ old('name', $user->name) }}" required autocomplete="name">
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Alamat Email</label>
                            <input id="email" name="email" type="email" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700" value="{{ old('email', $user->email) }}" required autocomplete="username">
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-black px-8 py-4 rounded-2xl shadow-lg shadow-emerald-100 transition-all transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                            Simpan Perubahan
                        </button>

                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-600 font-bold">
                                Berhasil disimpan.
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Perbarui Kata Sandi -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 bg-amber-100 rounded-2xl flex items-center justify-center text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Keamanan Akun</h2>
                        <p class="text-sm text-slate-500">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.</p>
                    </div>
                </div>

                <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                    @csrf
                    @method('put')

                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label for="current_password" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Kata Sandi Saat Ini</label>
                            <input id="current_password" name="current_password" type="password" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700" autocomplete="current-password">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="password" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Kata Sandi Baru</label>
                                <input id="password" name="password" type="password" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700" autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>

                            <div class="space-y-2">
                                <label for="password_confirmation" class="text-xs font-black uppercase tracking-widest text-slate-400 ml-1">Konfirmasi Kata Sandi</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700" autocomplete="new-password">
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-4">
                        <button type="submit" class="bg-slate-900 hover:bg-black text-white font-black px-8 py-4 rounded-2xl shadow-lg transition-all transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                            Perbarui Kata Sandi
                        </button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-600 font-bold">
                                Berhasil diperbarui.
                            </p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Hapus Akun -->
        <div class="bg-red-50 rounded-[2rem] border-2 border-red-100 overflow-hidden">
            <div class="p-8 md:p-12">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-red-900">Hapus Akun</h2>
                        <p class="text-sm text-red-600/80">Sekali akun Anda dihapus, semua data akan hilang secara permanen.</p>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = true" class="bg-red-600 hover:bg-red-700 text-white font-black px-8 py-4 rounded-2xl shadow-lg shadow-red-100 transition-all transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-widest text-xs">
                        Hapus Akun Permanen
                    </button>

                    <!-- Modal Konfirmasi Hapus -->
                    <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity bg-red-900/40 backdrop-blur-sm" @click="open = false"></div>

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>&#8203;

                            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block px-8 py-10 overflow-hidden text-left align-bottom transition-all transform bg-white shadow-2xl rounded-[2.5rem] sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <form method="post" action="{{ route('profile.destroy') }}">
                                    @csrf
                                    @method('delete')

                                    <h2 class="text-2xl font-black text-slate-900 mb-4">Apakah Anda yakin?</h2>
                                    <p class="text-slate-500 mb-8 font-medium">Setelah dihapus, semua sumber daya dan data akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi.</p>

                                    <div class="space-y-4">
                                        <input id="current_password" name="password" type="password" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl outline-none focus:ring-4 focus:ring-red-500/5 focus:border-red-600/50 focus:bg-white transition-all font-bold text-slate-700" placeholder="Kata Sandi Konfirmasi">
                                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                    </div>

                                    <div class="mt-8 flex gap-3">
                                        <button type="button" @click="open = false" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black py-4 rounded-2xl transition-all uppercase tracking-widest text-xs">
                                            Batal
                                        </button>
                                        <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-black py-4 rounded-2xl transition-all uppercase tracking-widest text-xs">
                                            Hapus Sekarang
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
