<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Portal Magang - Dinas Sosial Kab. Lamongan</title>

        <!-- Fonts: Plus Jakarta Sans & Inter -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased overflow-x-hidden bg-gray-50/50">
        
        <div class="min-h-screen flex flex-col lg:flex-row relative">
            
            <!-- Left Branding Panel (Desktop Only) -->
            <div class="hidden lg:flex lg:w-5/12 bg-slate-950 text-white p-16 flex-col justify-between relative overflow-hidden select-none">
                <!-- Background animations & Grid -->
                <div class="absolute inset-0 grid-bg-dark opacity-[0.05] pointer-events-none"></div>
                <div class="absolute -top-32 -left-32 w-[350px] h-[350px] bg-blue-500/20 rounded-full blur-[90px] animate-pulse-glow"></div>
                <div class="absolute -bottom-32 -right-32 w-[350px] h-[350px] bg-emerald-500/20 rounded-full blur-[90px] animate-pulse-glow"></div>
                
                <!-- Header: Back to Home -->
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400 hover:text-white transition duration-300 group">
                        <span class="group-hover:-translate-x-1 transition-transform duration-300">←</span> Kembali ke Beranda
                    </a>
                </div>
                
                <!-- Middle: Brand Title & Bullet points -->
                <div class="relative z-10 space-y-8 my-auto max-w-sm">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-xl overflow-hidden bg-white shadow-sm flex items-center justify-center p-1 border border-white/10">
                            <img src="{{ asset('logo-dinsos.jpg') }}" class="h-full w-full object-contain" alt="Logo Lamongan">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-lg tracking-tight leading-none">Dinsos Lamongan</span>
                            <span class="text-[9px] text-slate-400 font-semibold tracking-wider uppercase mt-1">Portal Magang Digital</span>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <span class="inline-block px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[10px] font-bold uppercase tracking-wider">Sistem Terintegrasi</span>
                        <h2 class="text-3xl font-extrabold leading-tight">Satu Langkah Menuju Karir Profesional</h2>
                        <p class="text-slate-400 text-xs leading-relaxed">
                            Hubungkan keilmuan akademis Anda dengan pengabdian sosial nyata di lingkungan Dinas Sosial Kabupaten Lamongan.
                        </p>
                    </div>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 text-xs font-extrabold mt-0.5">✓</span>
                            <span class="text-slate-300 text-xs leading-normal">Pendaftaran & berkas 100% digital tanpa antrean perkantoran.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 text-xs font-extrabold mt-0.5">✓</span>
                            <span class="text-slate-300 text-xs leading-normal">Pemantauan kegiatan harian, absensi online, & jurnal terpadu.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-full bg-emerald-500/10 border border-emerald-500/25 flex items-center justify-center text-emerald-400 text-xs font-extrabold mt-0.5">✓</span>
                            <span class="text-slate-300 text-xs leading-normal">Penilaian dari pembimbing/mentor dengan sertifikasi resmi dinas.</span>
                        </li>
                    </ul>
                </div>
                
                <!-- Footer Info -->
                <div class="relative z-10 flex flex-col gap-2 border-t border-slate-900/60 pt-6">
                    <p class="text-slate-500 text-[10px]">
                        © {{ date('Y') }} Dinas Sosial Kabupaten Lamongan.
                    </p>
                    <p class="text-slate-600 text-[9px]">
                        Dikembangkan untuk Program Magang Universitas Islam Lamongan (UNISLA).
                    </p>
                </div>
            </div>

            <!-- Right Content Panel (Dynamic Forms) -->
            <div class="w-full lg:w-7/12 min-h-screen flex flex-col items-center justify-center p-6 sm:p-12 relative overflow-hidden bg-gray-50/50">
                
                <!-- Background Ambient Blobs inside right panel -->
                <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10 select-none">
                    <div class="absolute top-[10%] left-[-10%] w-[380px] h-[380px] rounded-full bg-blue-400/10 blur-[90px] animate-blob-1"></div>
                    <div class="absolute bottom-[10%] right-[-10%] w-[380px] h-[380px] rounded-full bg-emerald-400/10 blur-[90px] animate-blob-2"></div>
                </div>

                <!-- Logo & Brand Header on Mobile/Tablet -->
                <div class="w-full max-w-lg flex items-center justify-between lg:hidden mb-8 mt-4">
                    <a href="/" class="flex items-center gap-3">
                        <div class="h-9 w-9 rounded-xl overflow-hidden bg-white shadow-sm flex items-center justify-center p-1 border border-slate-100">
                            <img src="{{ asset('logo-dinsos.jpg') }}" class="h-full w-full object-contain" alt="Logo Lamongan">
                        </div>
                        <div class="flex flex-col">
                            <span class="font-extrabold text-sm text-slate-900 tracking-tight leading-none">Dinsos Lamongan</span>
                            <span class="text-[8px] text-gray-500 font-semibold tracking-wider uppercase mt-0.5">Portal Magang</span>
                        </div>
                    </a>
                    <a href="/" class="text-xs font-bold text-slate-500 hover:text-blue-600 transition">
                        ← Kembali
                    </a>
                </div>

                <!-- Dynamic Wrapper Card -->
                <div class="w-full max-w-lg relative z-10 my-4">
                    <div class="glass-card rounded-[2.5rem] p-8 sm:p-10 shadow-2xl border border-white/60">
                        {{ $slot }}
                    </div>
                </div>
                
            </div>
            
        </div>
        
    </body>
</html>
