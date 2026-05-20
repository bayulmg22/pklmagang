<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Portal Magang - Dinas Sosial Kab. Lamongan</title>

        <!-- Fonts: Plus Jakarta Sans for headings & Inter for body -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50/50 text-slate-800 overflow-x-hidden selection:bg-blue-600 selection:text-white">
        
        <!-- Ambient Glowing Background Blobs -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10 select-none">
            <div class="absolute top-[8%] left-[-5%] w-[400px] h-[400px] rounded-full bg-blue-400/15 blur-[100px] animate-blob-1"></div>
            <div class="absolute top-[28%] right-[-5%] w-[500px] h-[500px] rounded-full bg-emerald-400/12 blur-[120px] animate-blob-2"></div>
            <div class="absolute bottom-[25%] left-[10%] w-[450px] h-[450px] rounded-full bg-indigo-400/12 blur-[110px] animate-blob-1"></div>
        </div>

        <!-- Sticky Glassmorphic Navbar -->
        <nav x-data="{ mobileMenuOpen: false }" class="glass-nav sticky top-0 z-50 shadow-sm transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <!-- Brand Info -->
                    <a href="#" class="flex items-center gap-3 group">
                        <div class="h-11 w-11 rounded-xl overflow-hidden bg-white shadow-sm border border-gray-100 flex items-center justify-center p-1 transition-all duration-300 group-hover:scale-105 group-hover:shadow-md">
                            <img src="{{ asset('logo-dinsos.jpg') }}" class="h-full w-full object-contain" alt="Logo Lamongan">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-lg text-slate-900 tracking-tight leading-none group-hover:text-blue-600 transition duration-300">Dinsos Lamongan</span>
                            <span class="text-[10px] text-gray-500 font-semibold tracking-wider uppercase mt-1">Portal Magang Digital</span>
                        </div>
                    </a>

                    <!-- Desktop Links -->
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="#tentang" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition duration-300">Keunggulan</a>
                        <a href="#alur" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition duration-300">Alur</a>
                        <a href="#divisi" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition duration-300">Pilihan Divisi</a>
                        <a href="#faq" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition duration-300">Tanya Jawab</a>
                    </div>

                    <!-- Desktop Actions -->
                    <div class="hidden md:flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-sm font-semibold hover:shadow-lg hover:shadow-blue-500/25 hover:-translate-y-0.5 transition-all duration-300">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-700 hover:text-blue-600 px-4 py-2.5 rounded-xl hover:bg-gray-100/50 transition duration-300">Masuk</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 text-white text-sm font-semibold hover:shadow-lg hover:shadow-blue-600/25 hover:-translate-y-0.5 transition-all duration-300">Daftar Magang</a>
                                @endif
                            @endauth
                        @endif
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="flex items-center md:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-500 hover:text-slate-900 focus:outline-none p-2 rounded-xl hover:bg-gray-100/50 transition duration-300">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Drawer -->
            <div x-show="mobileMenuOpen" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="md:hidden border-t border-gray-100 bg-white/95 backdrop-blur-md">
                <div class="px-2 pt-3 pb-6 space-y-2">
                    <a href="#tentang" @click="mobileMenuOpen = false" class="block px-4 py-2.5 rounded-xl text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition">Keunggulan</a>
                    <a href="#alur" @click="mobileMenuOpen = false" class="block px-4 py-2.5 rounded-xl text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition">Alur Pendaftaran</a>
                    <a href="#divisi" @click="mobileMenuOpen = false" class="block px-4 py-2.5 rounded-xl text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition">Pilihan Divisi</a>
                    <a href="#faq" @click="mobileMenuOpen = false" class="block px-4 py-2.5 rounded-xl text-base font-medium text-slate-700 hover:bg-blue-50 hover:text-blue-600 transition">Tanya Jawab (FAQ)</a>
                    <div class="pt-4 border-t border-gray-100 flex flex-col gap-2 px-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" @click="mobileMenuOpen = false" class="text-center px-4 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow-md">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" @click="mobileMenuOpen = false" class="text-center px-4 py-3 rounded-xl border border-gray-200 text-slate-700 font-semibold hover:bg-gray-50 transition">Masuk</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" @click="mobileMenuOpen = false" class="text-center px-4 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold shadow-md">Daftar Magang</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Majestic Hero Section -->
        <header class="relative pt-8 pb-20 lg:pt-16 lg:pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                    
                    <!-- Left Hero Content -->
                    <div class="lg:col-span-7 flex flex-col items-start text-left">
                        <!-- Glowing Badge -->
                        <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-blue-50/80 border border-blue-100 text-blue-700 text-xs font-semibold mb-8 hover:bg-blue-100/50 transition duration-300">
                            <span class="flex w-2.5 h-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                            </span>
                            Pendaftaran Magang Periode 2026/2027 Dibuka
                        </div>
                        
                        <!-- Main Title -->
                        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 leading-[1.12] font-sans">
                            Portal Magang Digital <br>
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-indigo-600 to-emerald-500">
                                Dinas Sosial Kab. Lamongan
                            </span>
                        </h1>
                        
                        <!-- Description -->
                        <p class="text-slate-600 text-base sm:text-lg lg:text-xl leading-relaxed mb-10 max-w-2xl">
                            Sistem informasi manajemen magang terpadu untuk Mahasiswa dan Siswa/i. Hubungkan keilmuan akademis Anda dengan pengabdian sosial nyata di lingkungan Dinas Sosial Kabupaten Lamongan.
                        </p>
                        
                        <!-- CTAs -->
                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto items-stretch sm:items-center">
                            <a href="{{ route('register') }}" class="group px-8 py-4 rounded-2xl bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-600 text-white font-bold hover:shadow-xl hover:shadow-blue-600/25 transition-all duration-300 transform hover:-translate-y-0.5 text-center flex items-center justify-center gap-2">
                                Mulai Pendaftaran
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </a>
                            <a href="#tentang" class="px-8 py-4 rounded-2xl bg-white/80 border border-slate-200 text-slate-700 font-bold hover:bg-slate-50/80 transition-all duration-300 hover:shadow-md text-center">
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                        
                        <!-- Social Trust Footer -->
                        <div class="mt-12 flex items-center gap-4 text-xs text-gray-500 border-t border-gray-200/50 pt-6 w-full">
                            <div class="flex -space-x-2">
                                <span class="w-8 h-8 rounded-full bg-blue-500 border-2 border-white flex items-center justify-center text-[10px] text-white font-bold">U</span>
                                <span class="w-8 h-8 rounded-full bg-emerald-500 border-2 border-white flex items-center justify-center text-[10px] text-white font-bold">N</span>
                                <span class="w-8 h-8 rounded-full bg-indigo-500 border-2 border-white flex items-center justify-center text-[10px] text-white font-bold">I</span>
                                <span class="w-8 h-8 rounded-full bg-slate-500 border-2 border-white flex items-center justify-center text-[10px] text-white font-bold">S</span>
                            </div>
                            <span>Telah dipercaya oleh mahasiswa <strong>UNISLA</strong>, <strong>UNESA</strong>, dan berbagai sekolah & universitas nasional.</span>
                        </div>
                    </div>

                    <!-- Right Graphic Content -->
                    <div class="lg:col-span-5 relative flex items-center justify-center mt-8 lg:mt-0">
                        <!-- Background glow effect -->
                        <div class="absolute -inset-2 rounded-[2.5rem] bg-gradient-to-r from-blue-500 to-emerald-500 opacity-20 blur-2xl animate-pulse-glow"></div>
                        
                        <!-- Main Graphic Frame -->
                        <div class="relative w-full max-w-md rounded-[2rem] overflow-hidden glass-card p-3 shadow-2xl border border-white/60 animate-float">
                            <img src="{{ asset('hero-illustration.png') }}" class="w-full h-auto rounded-[1.5rem] shadow-inner border border-slate-100/50" alt="Sistem Magang Digital Illustration">
                        </div>

                        <!-- Floating Badge 1 -->
                        <div class="absolute top-[10%] -left-6 glass-card px-4 py-3 rounded-2xl shadow-xl border border-white/80 flex items-center gap-3 animate-float-delayed">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-lg shadow-inner">
                                💻
                            </div>
                            <div>
                                <p class="text-[9px] uppercase tracking-wider text-gray-400 font-bold">Sistem Portal</p>
                                <p class="text-xs font-extrabold text-slate-800">100% Digital</p>
                            </div>
                        </div>

                        <!-- Floating Badge 2 -->
                        <div class="absolute bottom-[15%] -right-4 glass-card px-4 py-3 rounded-2xl shadow-xl border border-white/80 flex items-center gap-3 animate-float">
                            <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 font-bold text-lg shadow-inner">
                                📜
                            </div>
                            <div>
                                <p class="text-[9px] uppercase tracking-wider text-gray-400 font-bold">Sertifikasi</p>
                                <p class="text-xs font-extrabold text-slate-800">Resmi & Sah</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- Grid animated Metrics Section -->
        <section class="relative z-10 py-10 border-y border-gray-200 bg-white/50 backdrop-blur-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                    <!-- Metric 1 -->
                    <div class="flex flex-col items-center text-center p-4">
                        <span class="text-3xl sm:text-4xl font-extrabold text-blue-600 tracking-tight mb-2">150+</span>
                        <span class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Alumni Magang</span>
                    </div>
                    <!-- Metric 2 -->
                    <div class="flex flex-col items-center text-center p-4 pt-6 md:pt-4">
                        <span class="text-3xl sm:text-4xl font-extrabold text-emerald-500 tracking-tight mb-2">8+</span>
                        <span class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Divisi Aktif</span>
                    </div>
                    <!-- Metric 3 -->
                    <div class="flex flex-col items-center text-center p-4 pt-6 md:pt-4">
                        <span class="text-3xl sm:text-4xl font-extrabold text-indigo-600 tracking-tight mb-2">100%</span>
                        <span class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Online & Transparan</span>
                    </div>
                    <!-- Metric 4 -->
                    <div class="flex flex-col items-center text-center p-4 pt-6 md:pt-4">
                        <span class="text-3xl sm:text-4xl font-extrabold text-slate-800 tracking-tight mb-2">12+</span>
                        <span class="text-xs sm:text-sm font-semibold text-gray-500 uppercase tracking-wider">Mitra Pendidikan</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Keunggulan (Tentang) Section -->
        <section id="tentang" class="py-24 bg-gray-50/50 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Title -->
                <div class="text-center mb-20">
                    <span class="px-3.5 py-1.5 rounded-full bg-blue-50 text-blue-600 text-xs font-bold tracking-wider uppercase">Fasilitas & Keunggulan</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 mb-4">Kenapa Magang di Dinsos Lamongan?</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                        Kami berkomitmen menghadirkan ekosistem pembelajaran dinamis bagi generasi muda agar memiliki bekal soft-skill mumpuni serta kepedulian sosial yang nyata.
                    </p>
                </div>

                <!-- Features Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature Card 1 -->
                    <div class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mb-8 text-blue-600 text-2xl group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-inner">
                                👥
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-blue-600 transition-colors duration-300">Dampak Sosial Nyata</h3>
                            <p class="text-slate-600 leading-relaxed text-sm">
                                Terjun langsung membantu masyarakat Lamongan yang membutuhkan pelayanan kesejahteraan sosial dan jaminan perlindungan sosial secara riil di lapangan.
                            </p>
                        </div>
                        <div class="mt-8 border-t border-gray-50 pt-4 flex items-center justify-between text-xs text-blue-600 font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span>Pelajari selengkapnya</span>
                            <span>→</span>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-8 text-emerald-600 text-2xl group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-inner">
                                📈
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-emerald-600 transition-colors duration-300">Bimbingan Profesional</h3>
                            <p class="text-slate-600 leading-relaxed text-sm">
                                Mentoring eksklusif dari praktisi dan staf dinas berpengalaman yang siap mengarahkan serta membantumu memecahkan tantangan kerja publik secara bijaksana.
                            </p>
                        </div>
                        <div class="mt-8 border-t border-gray-50 pt-4 flex items-center justify-between text-xs text-emerald-600 font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span>Pelajari selengkapnya</span>
                            <span>→</span>
                        </div>
                    </div>

                    <!-- Feature Card 3 -->
                    <div class="group bg-white rounded-[2rem] p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 border border-gray-100 flex flex-col justify-between">
                        <div>
                            <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mb-8 text-indigo-600 text-2xl group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-inner">
                                💻
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-indigo-600 transition-colors duration-300">Administrasi Digital</h3>
                            <p class="text-slate-600 leading-relaxed text-sm">
                                Nikmati kenyamanan pendaftaran terpadu, absensi kehadiran online harian, pencatatan jurnal, hingga penilaian akhir terintegrasi yang transparan.
                            </p>
                        </div>
                        <div class="mt-8 border-t border-gray-50 pt-4 flex items-center justify-between text-xs text-indigo-600 font-bold opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span>Pelajari selengkapnya</span>
                            <span>→</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Alur Pendaftaran Section -->
        <section id="alur" class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Title -->
                <div class="text-center mb-20">
                    <span class="px-3.5 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold tracking-wider uppercase">Langkah Pendaftaran</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 mb-4">Alur Mudah Pendaftaran Magang</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                        Kami merancang alur rekrutmen digital secara berurutan guna menjamin kemudahan, kecepatan verifikasi, dan kejelasan status pendaftar.
                    </p>
                </div>

                <div class="relative">
                    <!-- Connecting line (Desktop) -->
                    <div class="hidden lg:block absolute top-[60px] left-12 right-12 h-[3px] bg-gradient-to-r from-blue-300 via-indigo-300 to-emerald-300 -z-0 rounded-full"></div>

                    <!-- Steps Cards -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 relative z-10">
                        <!-- Step 1 -->
                        <div class="group bg-gray-50 rounded-[2rem] p-8 hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-transparent hover:border-gray-100 flex flex-col items-start">
                            <div class="w-12 h-12 rounded-full bg-blue-600 text-white font-extrabold flex items-center justify-center text-lg mb-6 shadow-lg shadow-blue-500/25 group-hover:scale-110 transition duration-300">
                                1
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Registrasi Akun</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Buat akun portal pendaftaran menggunakan email aktif Anda untuk mulai mengakses panel pendaftaran.
                            </p>
                        </div>

                        <!-- Step 2 -->
                        <div class="group bg-gray-50 rounded-[2rem] p-8 hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-transparent hover:border-gray-100 flex flex-col items-start">
                            <div class="w-12 h-12 rounded-full bg-indigo-600 text-white font-extrabold flex items-center justify-center text-lg mb-6 shadow-lg shadow-indigo-500/25 group-hover:scale-110 transition duration-300">
                                2
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Lengkapi Berkas</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Isi data profil diri dan unggah berkas wajib seperti CV terbaru & Surat Pengantar Resmi dari Instansi Pendidikan.
                            </p>
                        </div>

                        <!-- Step 3 -->
                        <div class="group bg-gray-50 rounded-[2rem] p-8 hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-transparent hover:border-gray-100 flex flex-col items-start">
                            <div class="w-12 h-12 rounded-full bg-emerald-600 text-white font-extrabold flex items-center justify-center text-lg mb-6 shadow-lg shadow-emerald-500/25 group-hover:scale-110 transition duration-300">
                                3
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Pilih Divisi & Kuota</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Tentukan fokus spesialisasi bidang magang Anda berdasarkan ketersediaan kuota dinas aktif.
                            </p>
                        </div>

                        <!-- Step 4 -->
                        <div class="group bg-gray-50 rounded-[2rem] p-8 hover:bg-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 border border-transparent hover:border-gray-100 flex flex-col items-start">
                            <div class="w-12 h-12 rounded-full bg-slate-900 text-white font-extrabold flex items-center justify-center text-lg mb-6 shadow-lg shadow-slate-950/20 group-hover:scale-110 transition duration-300">
                                4
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mb-2">Seleksi & Mulai</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">
                                Pantau pengumuman di dashboard Anda. Jika diterima, ikuti onboarding digital dan Anda siap magang!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divisi Spesialisasi Section -->
        <section id="divisi" class="py-24 bg-gray-50/50 relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Title -->
                <div class="text-center mb-20">
                    <span class="px-3.5 py-1.5 rounded-full bg-indigo-50 text-indigo-600 text-xs font-bold tracking-wider uppercase">Spesialisasi Bidang</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 mb-4">Divisi Magang Yang Tersedia</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                        Pilihlah divisi magang yang selaras dengan minat keilmuan dan keahlian Anda untuk mendapatkan pengalaman praktis optimal.
                    </p>
                </div>

                <!-- Division Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Divisi 1 -->
                    <div class="group bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col sm:flex-row gap-6">
                        <div class="w-16 h-16 rounded-[1.25rem] bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 text-3xl group-hover:scale-105 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300 shadow-inner">
                            💼
                        </div>
                        <div class="flex flex-col justify-between">
                            <div>
                                <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 text-[9px] font-bold uppercase tracking-wider">Sekretariat</span>
                                <h3 class="text-xl font-bold text-slate-900 mt-2.5 mb-3 group-hover:text-blue-600 transition-colors duration-300">Administrasi & Umum</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    Mempelajari tata kelola persuratan dinas resmi, kearsipan data digital, agenda program kerja pimpinan, serta penyusunan laporan dinas perkantoran.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Manajemen Perkantoran</span>
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Administrasi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divisi 2 -->
                    <div class="group bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col sm:flex-row gap-6">
                        <div class="w-16 h-16 rounded-[1.25rem] bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 text-3xl group-hover:scale-105 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300 shadow-inner">
                            💻
                        </div>
                        <div class="flex flex-col justify-between">
                            <div>
                                <span class="px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[9px] font-bold uppercase tracking-wider">IT Support & Data</span>
                                <h3 class="text-xl font-bold text-slate-900 mt-2.5 mb-3 group-hover:text-emerald-600 transition-colors duration-300">Teknologi Informasi & Data</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    Membantu pemeliharaan basis data bantuan sosial (DTKS), monitoring perangkat keras, IT troubleshooting, pengembangan web portal, & desain publikasi media sosial.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Informatika</span>
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Sistem Informasi</span>
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Desain Kreatif</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divisi 3 -->
                    <div class="group bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col sm:flex-row gap-6">
                        <div class="w-16 h-16 rounded-[1.25rem] bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 text-3xl group-hover:scale-105 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 shadow-inner">
                            🤝
                        </div>
                        <div class="flex flex-col justify-between">
                            <div>
                                <span class="px-2.5 py-1 rounded-full bg-indigo-50 text-indigo-600 text-[9px] font-bold uppercase tracking-wider">Rehabos</span>
                                <h3 class="text-xl font-bold text-slate-900 mt-2.5 mb-3 group-hover:text-indigo-600 transition-colors duration-300">Rehabilitasi Sosial</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    Berkontribusi langsung dalam proses pendampingan warga disabilitas, lansia terlantar, anak asuh, serta ikut serta dalam merancang kegiatan pemberdayaan inklusif.
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Kesejahteraan Sosial</span>
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Psikologi</span>
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Sosiologi</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divisi 4 -->
                    <div class="group bg-white rounded-[2.5rem] p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col sm:flex-row gap-6">
                        <div class="w-16 h-16 rounded-[1.25rem] bg-amber-50 text-amber-600 flex items-center justify-center shrink-0 text-3xl group-hover:scale-105 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300 shadow-inner">
                            🛡️
                        </div>
                        <div class="flex flex-col justify-between">
                            <div>
                                <span class="px-2.5 py-1 rounded-full bg-amber-50 text-amber-600 text-[9px] font-bold uppercase tracking-wider">Linjamsos</span>
                                <h3 class="text-xl font-bold text-slate-900 mt-2.5 mb-3 group-hover:text-amber-600 transition-colors duration-300">Perlindungan & Bencana</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    Membantu pemantauan operasional Program Keluarga Harapan (PKH), manajemen logistik korban pasca-bencana, serta berkolaborasi dengan organisasi sosial daerah (Tagana).
                                </p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Manajemen Bencana</span>
                                <span class="px-2.5 py-1 rounded bg-gray-150 text-slate-600 text-[10px] font-semibold">Hubungan Masyarakat</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="py-24 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Title -->
                <div class="text-center mb-20">
                    <span class="px-3.5 py-1.5 rounded-full bg-blue-50 text-blue-600 text-xs font-bold tracking-wider uppercase">Cerita Alumni</span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mt-4 mb-4">Apa Kata Rekan Alumni Magang?</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto text-sm sm:text-base leading-relaxed">
                        Cerita dan pengalaman langsung dari mahasiswa yang telah menyelesaikan program kolaborasi magang di Dinas Sosial Lamongan.
                    </p>
                </div>

                <!-- Testimonials Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-gray-55/40 rounded-[2rem] p-8 border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-white transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1 text-amber-500 mb-6 text-base">
                                ★★★★★
                            </div>
                            <p class="text-slate-600 italic text-sm leading-relaxed">
                                "Sistem digitalisasi portal ini memudahkan saya dari pengumpulan berkas pendaftaran hingga laporan kegiatan harian. Pembimbing magangnya kompeten dan selalu membimbing tugas kami."
                            </p>
                        </div>
                        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-xl bg-blue-600 text-white font-extrabold flex items-center justify-center text-xs shadow-md">
                                AN
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">Ahmad Nizar</h4>
                                <p class="text-gray-400 text-[10px] sm:text-xs">Alumni Magang IT - UNISLA</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-gray-55/40 rounded-[2rem] p-8 border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-white transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1 text-amber-500 mb-6 text-base">
                                ★★★★★
                            </div>
                            <p class="text-slate-600 italic text-sm leading-relaxed">
                                "Sangat bersyukur dapat kesempatan belajar di Dinsos Lamongan. Saya bisa turun langsung mendampingi penyandang disabilitas secara sosial. Pengalaman kemanusiaan yang berharga!"
                            </p>
                        </div>
                        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-xl bg-emerald-600 text-white font-extrabold flex items-center justify-center text-xs shadow-md">
                                SR
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">Siti Rahmawati</h4>
                                <p class="text-gray-400 text-[10px] sm:text-xs">Alumni Magang Rehabos - UNESA</p>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-gray-55/40 rounded-[2rem] p-8 border border-gray-100 hover:bg-white hover:shadow-2xl hover:border-white transition-all duration-300 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-1 text-amber-500 mb-6 text-base">
                                ★★★★★
                            </div>
                            <p class="text-slate-600 italic text-sm leading-relaxed">
                                "Sistemnya sangat modern, transparan, dan tidak rumit. Proses input data absensi dan penilaian berjalan lancar. Rekomendasi utama untuk program magang digital!"
                            </p>
                        </div>
                        <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                            <div class="w-11 h-11 rounded-xl bg-indigo-600 text-white font-extrabold flex items-center justify-center text-xs shadow-md">
                                BP
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-xs sm:text-sm">Bambang Pratama</h4>
                                <p class="text-gray-400 text-[10px] sm:text-xs">Alumni Sekretariat - SMKN 1 Lamongan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Collapsible FAQ Section -->
        <section id="faq" class="py-24 bg-gray-50/50 relative">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Section Title -->
                <div class="text-center mb-16">
                    <span class="px-3.5 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold tracking-wider uppercase">Pertanyaan Umum</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 mt-4 mb-4">Sering Ditanyakan (FAQ)</h2>
                    <p class="text-slate-600 text-sm max-w-xl mx-auto">
                        Berikut jawaban singkat mengenai keraguan umum seputar program pendaftaran magang terpadu.
                    </p>
                </div>

                <!-- FAQ Accordions -->
                <div x-data="{ active: null }" class="space-y-4">
                    <!-- Item 1 -->
                    <div class="bg-white rounded-[1.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        <button @click="active = active === 1 ? null : 1" class="w-full text-left px-6 py-5 flex justify-between items-center focus:outline-none select-none">
                            <span class="font-bold text-slate-900 text-sm sm:text-base">Siapa saja yang dapat mendaftar magang?</span>
                            <span class="text-slate-500 font-extrabold transition-transform duration-300 text-xl" :class="active === 1 ? 'rotate-45' : 'rotate-0'">+</span>
                        </button>
                        <div x-show="active === 1" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="px-6 pb-6 border-t border-slate-50 pt-4 text-slate-600 text-sm leading-relaxed">
                            Terbuka bagi seluruh Mahasiswa aktif tingkat perguruan tinggi negeri/swasta (D3/D4/S1) maupun Siswa/i aktif tingkat SMA/SMK sederajat yang memegang surat pengantar tugas magang resmi dari instansi pendidikan asal.
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="bg-white rounded-[1.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        <button @click="active = active === 2 ? null : 2" class="w-full text-left px-6 py-5 flex justify-between items-center focus:outline-none select-none">
                            <span class="font-bold text-slate-900 text-sm sm:text-base">Berapa lama durasi magang yang diajukan?</span>
                            <span class="text-slate-500 font-extrabold transition-transform duration-300 text-xl" :class="active === 2 ? 'rotate-45' : 'rotate-0'">+</span>
                        </button>
                        <div x-show="active === 2" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="px-6 pb-6 border-t border-slate-50 pt-4 text-slate-600 text-sm leading-relaxed">
                            Durasi program magang bervariasi antara 1 bulan hingga 6 bulan penuh, sesuai dengan kurikulum khusus kampus merdeka atau syarat praktek wajib dari sekolah/program studi asal.
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="bg-white rounded-[1.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        <button @click="active = active === 3 ? null : 3" class="w-full text-left px-6 py-5 flex justify-between items-center focus:outline-none select-none">
                            <span class="font-bold text-slate-900 text-sm sm:text-base">Berkas apa saja yang wajib dipersiapkan?</span>
                            <span class="text-slate-500 font-extrabold transition-transform duration-300 text-xl" :class="active === 3 ? 'rotate-45' : 'rotate-0'">+</span>
                        </button>
                        <div x-show="active === 3" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="px-6 pb-6 border-t border-slate-50 pt-4 text-slate-600 text-sm leading-relaxed">
                            Secara umum pendaftar wajib mengunggah: Surat Pengantar Magang Resmi, Curriculum Vitae (CV) ter-update, pas foto formal berwarna, serta kartu identitas pelajar/mahasiswa aktif.
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="bg-white rounded-[1.5rem] border border-slate-100 overflow-hidden shadow-sm hover:shadow-md transition duration-300">
                        <button @click="active = active === 4 ? null : 4" class="w-full text-left px-6 py-5 flex justify-between items-center focus:outline-none select-none">
                            <span class="font-bold text-slate-900 text-sm sm:text-base">Apakah terdapat pungutan biaya rekrutmen?</span>
                            <span class="text-slate-500 font-extrabold transition-transform duration-300 text-xl" :class="active === 4 ? 'rotate-45' : 'rotate-0'">+</span>
                        </button>
                        <div x-show="active === 4" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-96"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-96"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="px-6 pb-6 border-t border-slate-50 pt-4 text-slate-600 text-sm leading-relaxed">
                            Tidak sama sekali. Program magang di Dinas Sosial Kabupaten Lamongan diselenggarakan secara penuh tanpa biaya administrasi (100% Gratis).
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call-to-Action (CTA) Grid & Glow Section -->
        <section class="py-20 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-[3rem] bg-slate-900 text-white px-8 py-16 sm:px-16 sm:py-24 shadow-2xl border border-slate-800">
                    <!-- Glow mesh effect -->
                    <div class="absolute inset-0 grid-bg-dark opacity-[0.04] pointer-events-none"></div>
                    <div class="absolute -top-32 -left-32 w-[350px] h-[350px] bg-blue-500/20 rounded-full blur-[90px] animate-pulse-glow"></div>
                    <div class="absolute -bottom-32 -right-32 w-[350px] h-[350px] bg-emerald-500/20 rounded-full blur-[90px] animate-pulse-glow"></div>
                    
                    <!-- Content -->
                    <div class="relative z-10 max-w-2xl mx-auto text-center">
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-6 leading-tight font-sans">
                            Kembangkan Portofolio & Potensi Anda Bersama Kami
                        </h2>
                        <p class="text-slate-300 text-sm sm:text-base mb-10 leading-relaxed max-w-lg mx-auto">
                            Tingkatkan kompetensi Anda dalam lingkungan kerja dinas terstruktur, asah empati sosial Anda, dan buat perubahan nyata di masyarakat.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-stretch sm:items-center">
                            <a href="{{ route('register') }}" class="px-8 py-4 rounded-2xl bg-white text-slate-900 font-bold hover:bg-slate-100 hover:shadow-xl hover:shadow-white/10 transition-all duration-300 transform hover:-translate-y-0.5 text-center text-sm sm:text-base">
                                Daftar Magang Sekarang
                            </a>
                            <a href="#alur" class="px-8 py-4 rounded-2xl bg-slate-800 text-white font-bold border border-slate-700 hover:bg-slate-700/60 transition-all duration-300 text-center text-sm sm:text-base">
                                Pelajari Prosedur
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Upgraded Footer -->
        <footer class="bg-slate-950 text-slate-400 border-t border-slate-900 pt-20 pb-10 relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                    
                    <!-- Branding Column -->
                    <div class="md:col-span-5 flex flex-col items-start">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="h-10 w-10 rounded-xl overflow-hidden bg-white shadow-sm border border-gray-200/20 flex items-center justify-center p-1">
                                <img src="{{ asset('logo-dinsos.jpg') }}" class="h-full w-full object-contain" alt="Logo Lamongan">
                            </div>
                            <span class="font-extrabold text-xl text-white tracking-tight">Dinsos Lamongan</span>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-8">
                            Sistem Manajemen Portal Magang Digital Dinas Sosial Kabupaten Lamongan. Platform terpadu penunjang keilmuan akademis dengan jaminan transparansi penuh.
                        </p>
                        
                        <!-- Socials -->
                        <div class="flex gap-3">
                            <a href="https://instagram.com/dinsoslamongan" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-850 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition duration-300">
                                📸
                            </a>
                            <a href="mailto:dinsos@lamongankab.go.id" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-850 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition duration-300">
                                ✉️
                            </a>
                            <a href="https://dinsos.lamongankab.go.id" target="_blank" class="w-10 h-10 rounded-xl bg-slate-900 border border-slate-850 flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 hover:border-blue-600 transition duration-300">
                                🌐
                            </a>
                        </div>
                    </div>

                    <!-- Links Column -->
                    <div class="md:col-span-3">
                        <h4 class="font-bold text-white text-sm mb-6 tracking-wider uppercase">Menu Navigasi</h4>
                        <ul class="space-y-4 text-sm font-medium">
                            <li><a href="#tentang" class="hover:text-white transition duration-200">Keunggulan Portal</a></li>
                            <li><a href="#alur" class="hover:text-white transition duration-200">Alur Pendaftaran</a></li>
                            <li><a href="#divisi" class="hover:text-white transition duration-200">Daftar Divisi Magang</a></li>
                            <li><a href="#faq" class="hover:text-white transition duration-200">Tanya Jawab (FAQ)</a></li>
                        </ul>
                    </div>

                    <!-- Contact Details Column -->
                    <div class="md:col-span-4">
                        <h4 class="font-bold text-white text-sm mb-6 tracking-wider uppercase">Hubungi Dinas</h4>
                        <address class="not-italic space-y-4 text-sm leading-relaxed text-slate-400">
                            <p class="flex items-start gap-2.5">
                                <span class="text-blue-500 mt-0.5">📍</span>
                                <span>Jl. Panglima Sudirman No. 123, Dapur Utara, Sidokumpul, Kec. Lamongan, Kab. Lamongan, Jawa Timur 62213</span>
                            </p>
                            <p class="flex items-center gap-2.5">
                                <span class="text-blue-500">📞</span>
                                <span>(0322) 321xxx</span>
                            </p>
                            <p class="flex items-center gap-2.5">
                                <span class="text-blue-500">✉️</span>
                                <span>dinsos@lamongankab.go.id</span>
                            </p>
                        </address>
                    </div>

                </div>

                <!-- Footer Copyright & Info -->
                <div class="border-t border-slate-900 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                    <p class="text-center md:text-left">
                        © {{ date('Y') }} Dinas Sosial Kabupaten Lamongan. Seluruh Hak Cipta Dilindungi.
                    </p>
                    <p class="text-slate-600 text-center md:text-right">
                        Dikembangkan sebagai Program Kemitraan Magang Universitas Islam Lamongan (UNISLA) & Dinsos Lamongan.
                    </p>
                </div>
            </div>
        </footer>

    </body>
</html>

