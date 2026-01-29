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
            <!-- Back to Login -->
            <div class="mb-8 flex justify-center">
                <a href="{{ route('login') }}" class="group inline-flex items-center gap-2 text-slate-400 hover:text-emerald-600 transition-all font-black uppercase tracking-widest text-[10px]">
                    <div class="p-2 rounded-full bg-white shadow-sm border border-slate-100 group-hover:border-emerald-100 group-hover:bg-emerald-50 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    </div>
                    <span>Kembali Ke Halaman Login</span>
                </a>
            </div>

            <div class="bg-white rounded-[3.5rem] shadow-[0_32px_100px_-20px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden">
                <div class="p-10 md:p-14">
                    <!-- Brand & Header -->
                    <div class="text-center mb-10">
                        <div class="inline-flex items-center justify-center p-6 bg-white rounded-[2.5rem] shadow-2xl shadow-emerald-100 mb-8 rotate-3 transition-transform hover:rotate-0 cursor-default border border-slate-50">
                             <img src="{{ asset('images/logo.png') }}" alt="Logo Kabupaten Malang" class="w-16 h-16 object-contain">
                        </div>
                        <h1 class="text-3xl font-black text-slate-900 tracking-tighter sm:text-4xl">Lupa Kata Sandi?</h1>
                        <p class="text-slate-400 font-bold mt-4 text-sm leading-relaxed italic">
                            Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                        </p>
                    </div>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-6 text-center" :status="session('status')" />

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-3 ml-2">Alamat Email Terdaftar</label>
                            <div class="relative group">
                                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                                    class="w-full px-8 py-6 bg-slate-50/50 border-2 border-slate-100 rounded-[2rem] outline-none focus:ring-8 focus:ring-emerald-500/5 focus:border-emerald-600/50 focus:bg-white transition-all font-bold text-slate-700 placeholder:text-slate-300 shadow-sm"
                                    placeholder="contoh@parangargo.desa.id">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 ml-2" />
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black py-6 rounded-[2.5rem] shadow-2xl shadow-emerald-200 transition-all transform hover:scale-[1.02] active:scale-[0.98] uppercase tracking-[0.2em] text-[11px] flex items-center justify-center gap-3 group">
                                <span>Kirim Tautan Atur Ulang</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:translate-x-1"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Footer Branding -->
                <div class="px-10 py-8 bg-slate-50/50 border-t border-slate-100 text-center">
                    <p class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-300">2026 Pemerintah Desa Parangargo. KKN 14 UNMER 2026</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
