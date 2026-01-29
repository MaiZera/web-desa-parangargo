<x-admin-layout>
    <x-slot name="header">
        Tambah Akun Administrator
    </x-slot>

    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('admin.accounts.index') }}" class="group inline-flex items-center gap-2 text-slate-400 hover:text-emerald-600 transition-all font-black uppercase tracking-widest text-[10px]">
                <div class="p-2 rounded-full bg-white shadow-sm border border-slate-100 group-hover:border-emerald-100 group-hover:bg-emerald-50 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </div>
                <span>Kembali Ke Daftar Akun</span>
            </a>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-[0_32px_100px_-20px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">
            <div class="p-10 md:p-14">
                <!-- Header -->
                <div class="mb-40">
                    <div class="inline-flex items-center justify-center p-4 bg-emerald-50 rounded-2xl text-emerald-600 mb-6 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="16" y1="11" x2="22" y2="11"/></svg>
                    </div>
                    <h1 class="text-3xl font-black text-slate-900 tracking-tighter">Buat Akun Baru</h1>
                    <p class="text-slate-400 font-bold mt-2 text-sm italic">Berikan otorisasi akses dashboard kepada staf resmi desa.</p>
                </div>

                <form method="POST" action="{{ route('admin.accounts.store') }}" class="space-y-8 mt-10">
                    @csrf

                    <div class="grid md:grid-cols-5 gap-8">
                        <!-- Username -->
                        <div class="space-y-3">
                            <label for="username" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-2">Username</label>
                            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-[2rem] outline-none focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700 placeholder:text-slate-300 shadow-sm"
                                placeholder="Contoh: budismart">
                            <x-input-error :messages="$errors->get('username')" class="mt-2 ml-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="space-y-3">
                            <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-2">Alamat Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-[2rem] outline-none focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700 placeholder:text-slate-300 shadow-sm"
                                placeholder="email@parangargo.desa.id">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Access Level (Role) -->
                        <div class="space-y-3">
                            <label for="access_level" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-2">Role Akses</label>
                            <div class="relative">
                                <select id="access_level" name="access_level" required
                                    class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-[2rem] outline-none focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700 appearance-none shadow-sm cursor-not-allowed">
                                    <option value="editor" selected>Editor Desa (Akses Konten)</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('access_level')" class="mt-2 ml-2" />
                        </div>

                        <!-- Password -->
                        <div class="space-y-3" x-data="{ show: false }">
                            <label for="password" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 ml-2">Kata Sandi</label>
                            <div class="relative">
                                <input id="password" :type="show ? 'text' : 'password'" name="password" required
                                    class="w-full px-8 py-5 bg-slate-50 border-2 border-slate-100 rounded-[2rem] outline-none focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700 placeholder:text-slate-300 shadow-sm"
                                    placeholder="••••••••">
                                <button type="button" @click="show = !show" 
                                    class="absolute right-6 top-1/2 -translate-y-1/2 flex items-center justify-center text-slate-400 hover:text-emerald-600 transition-colors focus:outline-none p-2 rounded-xl hover:bg-slate-100/50">
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-2" />
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-6 rounded-[2.5rem] shadow-2xl shadow-emerald-200 transition-all transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-[0.2em] text-[11px] flex items-center justify-center gap-3">
                            <span>Simpan Akun Administrator</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Information Footer -->
            <div class="px-10 py-8 bg-slate-50 border-t border-slate-100 flex items-center gap-6">
                <div class="w-12 h-12 bg-white rounded-2xl border border-slate-200 flex items-center justify-center text-amber-500 shrink-0 shadow-sm text-2xl font-black">
                    !
                </div>
                <p class="text-[11px] font-bold text-slate-500 leading-relaxed uppercase tracking-wider">
                    Pastikan informasi yang dimasukkan sudah benar. Akun baru akan mendapatkan akses penuh ke dashboard admin desa.
                </p>
            </div>
        </div>
    </div>
</x-admin-layout>
