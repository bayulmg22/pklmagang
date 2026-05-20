<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Branding Title inside Card -->
        <div class="text-left mb-8">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                Autentikasi Pengguna
            </span>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Selamat Datang Kembali</h2>
            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Silakan masuk menggunakan akun portal magang Anda yang telah terdaftar.</p>
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" :value="__('Email')" />
            <x-text-input id="email" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3.5 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <div class="flex justify-between items-center mb-1.5">
                <x-input-label for="password" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 block" :value="__('Password')" />
            </div>
            <x-text-input id="password" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3.5 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Remember Me & Forgot Password Row -->
        <div class="flex items-center justify-between mt-6 select-none">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-slate-200 text-blue-600 shadow-sm focus:ring-blue-500 focus:ring-offset-2 w-4 h-4 cursor-pointer transition" name="remember">
                <span class="ms-2 text-xs font-bold text-slate-500 hover:text-slate-700 transition duration-300">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-xs font-bold text-slate-500 hover:text-blue-600 transition duration-300" href="{{ route('password.request') }}">
                    Lupa Kata Sandi?
                </a>
            @endif
        </div>

        <!-- Submission and Navigation Action -->
        <div class="mt-8 flex flex-col gap-4">
            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 text-white font-extrabold hover:shadow-xl hover:shadow-blue-500/25 transition-all duration-300 transform hover:-translate-y-0.5 text-center flex items-center justify-center gap-2 text-sm">
                Masuk ke Portal
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
            
            @if (Route::has('register'))
                <p class="text-center text-xs text-slate-500 mt-2">
                    Belum memiliki akun magang? 
                    <a href="{{ route('register') }}" class="font-bold text-blue-600 hover:text-blue-700 transition duration-300">Daftar Sekarang</a>
                </p>
            @endif
        </div>
    </form>
</x-guest-layout>
