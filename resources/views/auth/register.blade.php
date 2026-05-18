<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Branding Title inside Card -->
        <div class="text-left mb-8">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-50 text-blue-600 text-[10px] font-extrabold uppercase tracking-wider mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                Formulir Pendaftaran
            </span>
            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight font-sans">Daftar Akun Magang</h2>
            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Silakan lengkapi berkas dan data diri Anda di bawah ini secara teliti.</p>
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" :value="__('Name')" />
            <x-text-input id="name" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Lengkap Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Email Address -->
        <div class="mt-5">
            <x-input-label for="email" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" :value="__('Email')" />
            <x-text-input id="email" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- NIM / NISN -->
        <div class="mt-5">
            <x-input-label for="nim" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" value="NIM / NISN" />
            <x-text-input id="nim" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400" type="text" name="nim" :value="old('nim')" required placeholder="Nomor Induk Siswa / Mahasiswa" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Asal Sekolah / Universitas -->
        <div class="mt-5">
            <x-input-label for="school" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" value="Asal Sekolah / Universitas" />
            <x-text-input id="school" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400" type="text" name="school" :value="old('school')" required placeholder="Contoh: Universitas Islam Lamongan" />
            <x-input-error :messages="$errors->get('school')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Proposal Magang (PDF) -->
        <div class="mt-5">
            <x-input-label for="proposal" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" value="Upload Proposal Magang (PDF)" />
            <div class="relative mt-1 group">
                <input id="proposal" class="block w-full text-xs text-slate-600 border border-slate-200 bg-white/70 backdrop-blur-sm rounded-xl cursor-pointer focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-blue-50 file:text-blue-700 file:hover:bg-blue-100 transition-all duration-300 p-1.5" type="file" name="proposal" accept=".pdf" required />
            </div>
            <p class="text-[10px] text-slate-400 mt-1.5 leading-normal">Unggah proposal resmi dari kampus/sekolah Anda format (.pdf, maks. 5MB).</p>
            <x-input-error :messages="$errors->get('proposal')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" :value="__('Password')" />
            <x-text-input id="password" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-5">
            <x-input-label for="password_confirmation" class="text-[10px] font-extrabold uppercase tracking-wider text-slate-500 mb-1.5 block" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block w-full border-slate-200 bg-white/70 backdrop-blur-sm shadow-sm rounded-xl py-3 px-4 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all duration-300 text-sm text-slate-800 placeholder-slate-400"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs font-semibold text-rose-500" />
        </div>

        <!-- Submission and Navigation Action -->
        <div class="mt-8 flex flex-col gap-4">
            <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 text-white font-extrabold hover:shadow-xl hover:shadow-blue-500/25 transition-all duration-300 transform hover:-translate-y-0.5 text-center flex items-center justify-center gap-2 text-sm">
                Daftar Magang Sekarang
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            
            <p class="text-center text-xs text-slate-500 mt-2">
                Sudah memiliki akun magang? 
                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700 transition duration-300">Masuk Sekarang</a>
            </p>
        </div>
    </form>
</x-guest-layout>
