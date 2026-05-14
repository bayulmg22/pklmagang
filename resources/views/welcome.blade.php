<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Portal Magang - Dinas Sosial Kab. Lamongan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900">
        <!-- Navbar -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-gray-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            D
                        </div>
                        <span class="font-bold text-xl text-gray-800 tracking-tight">Dinsos Lamongan</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-blue-600 transition">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5">Daftar Magang</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-white">
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-blue-50/50 to-green-50/50 -z-10"></div>
            
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 text-center">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold mb-6">
                    <span class="flex w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Pendaftaran Dibuka
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    Portal Magang Digital <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-green-500">
                        Dinas Sosial Kab. Lamongan
                    </span>
                </h1>
                <p class="mt-4 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed mb-10">
                    Sistem informasi manajemen magang terpadu untuk Mahasiswa dan Siswa/i yang ingin berkontribusi dan belajar langsung di lingkungan Dinas Sosial Kabupaten Lamongan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="px-8 py-3.5 rounded-full bg-blue-600 text-white font-semibold hover:bg-blue-700 shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-lg">
                        Mulai Pendaftaran
                    </a>
                    <a href="#tentang" class="px-8 py-3.5 rounded-full bg-white text-gray-700 font-semibold border border-gray-200 hover:border-gray-300 hover:bg-gray-50 transition text-lg shadow-sm">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>

        <!-- Tentang Section -->
        <div id="tentang" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Kenapa Magang di Dinsos Lamongan?</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Kami memberikan kesempatan bagi generasi muda untuk memahami dunia kerja pemerintahan sekaligus terjun langsung dalam pelayanan sosial masyarakat.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition border border-gray-100">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 text-blue-600 text-2xl">
                            👥
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pelayanan Sosial Terpadu</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Mendapatkan pengalaman nyata dalam melayani masyarakat yang membutuhkan bantuan sosial di wilayah Kabupaten Lamongan.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition border border-gray-100">
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mb-6 text-green-600 text-2xl">
                            📈
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Pengembangan Diri</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Tingkatkan soft skill dan hard skill Anda di dunia kerja yang dinamis, didukung oleh pembimbing magang yang profesional.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition border border-gray-100">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mb-6 text-blue-600 text-2xl">
                            💻
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Sistem Digital</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Proses pendaftaran, absensi, hingga penilaian dilakukan secara digital dan terintegrasi melalui portal ini.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-green-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                        D
                    </div>
                    <span class="font-bold text-lg text-gray-800">Dinas Sosial Kab. Lamongan</span>
                </div>
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} Dinas Sosial Kabupaten Lamongan. All rights reserved.
                </p>
                <p class="text-gray-400 text-xs mt-2">
                    Dikembangkan untuk keperluan Program Magang Universitas Islam Lamongan (UNISLA).
                </p>
            </div>
        </footer>
    </body>
</html>
