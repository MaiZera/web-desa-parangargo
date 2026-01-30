<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-50 overflow-hidden">
        
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[10%] -right-[10%] w-[40%] h-[40%] bg-emerald-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute -bottom-[10%] -left-[10%] w-[40%] h-[40%] bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
            
            <!-- Pattern -->
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
        </div>

        <div class="relative z-10 w-full max-w-lg">
            <!-- Back to Home -->
            <div class="mb-8 flex justify-center">
                <a href="/" class="group inline-flex items-center gap-2 text-slate-400 hover:text-emerald-600 transition-all font-black uppercase tracking-widest text-[10px]">
                    <div class="p-2 rounded-full bg-white shadow-sm border border-slate-100 group-hover:border-emerald-100 group-hover:bg-emerald-50 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    </div>
                    <span>Kembali Ke Beranda</span>
                </a>
            </div>

            <div class="bg-white rounded-[3.5rem] shadow-[0_32px_100px_-20px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">
                <div class="p-10 md:p-14">
                    <!-- Brand -->
                    <div class="text-center mb-12">
                        <div class="inline-flex items-center justify-center p-6 bg-white rounded-[2.5rem] shadow-2xl shadow-emerald-100 mb-8 rotate-3 transition-transform hover:rotate-0 cursor-default border border-slate-50">
                             <img src="{{ asset('images/logo.png') }}" alt="Logo Kabupaten Malang" class="w-16 h-16 object-contain">
                        </div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tighter sm:text-4xl">Selamat Datang</h1>
                        <p class="text-slate-400 font-bold mt-3 text-sm italic">Silakan masuk ke Dashboard Desa Parangargo</p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6 text-center" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-8">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-2">Alamat Email</label>
                            <div class="relative group">
                                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                                    class="w-full px-8 py-6 bg-slate-50/50 border-2 border-slate-100 rounded-[2rem] outline-none focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700 placeholder:text-slate-300"
                                    placeholder="Masukkan email anda">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-2" />
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-3 px-2">
                                <label for="password" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Kata Sandi</label>
                                @if (Route::has('password.request'))
                                    <a class="text-[10px] font-black uppercase tracking-widest text-emerald-600 hover:text-emerald-700 transition-colors" href="{{ route('password.request') }}">
                                        Lupa Sandi?
                                    </a>
                                @endif
                            </div>
                            <div class="relative group" x-data="{ show: false }">
                                <input id="password" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password"
                                    class="w-full px-8 py-6 bg-slate-50/50 border-2 border-slate-100 rounded-[2rem] outline-none focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700 placeholder:text-slate-300"
                                    placeholder="Masukkan kata sandi anda">
                                
                                <button type="button" @click="show = !show" 
                                    class="absolute right-6 top-1/2 -translate-y-1/2 flex items-center justify-center text-slate-400 hover:text-emerald-600 transition-colors focus:outline-none p-2 rounded-xl hover:bg-slate-100/50">
                                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display: none;"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.52 13.52 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 ml-2" />
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-6 rounded-[2.5rem] shadow-2xl shadow-emerald-200 transition-all transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-[0.2em] text-[11px] flex items-center justify-center gap-3 group">
                                <span>Autentikasi Sekarang</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Footer Branding -->
                <div class="px-10 py-8 bg-slate-50/50 border-t border-slate-100 text-center">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-300">2026 Pemerintah Desa Parangargo. KKN 14 UNMER 2026</p>
                </div>
            </div>
            
            <!-- Side notes -->
            <p class="mt-10 text-center text-slate-400 text-[10px] font-black uppercase tracking-widest leading-loose">
                Website Resmi Desa Parangargo <br>
                Kecamatan Wagir, Kabupaten Malang
            </p>
        </div>
    </div>
</x-guest-layout>
