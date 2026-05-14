<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIMASOS') }} — Dinsos Lamongan</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
            @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
            @keyframes slideInRight { from { opacity: 0; transform: translateX(-10px); } to { opacity: 1; transform: translateX(0); } }

            html, body { height: 100%; scroll-behavior: smooth; }
            .bg-main { 
                background: radial-gradient(circle at top right, #f1f5f9 0%, #f8fafc 100%);
                background-attachment: fixed;
            }
            
            .sidebar-width { width: 280px; min-width: 280px; }
            
            .content-card { 
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(226, 232, 240, 0.8);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
                border-radius: 1.25rem;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .content-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08);
                border-color: rgba(59, 130, 246, 0.2);
            }

            .glass-header {
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-bottom: 1px solid rgba(226, 232, 240, 0.7);
            }

            .animate-fade { animation: fadeIn 0.5s ease-out forwards; }
            .animate-slide-up { animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
            .animate-slide-right { animation: slideInRight 0.5s ease-out forwards; }

            /* Custom Scrollbar */
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
            ::-webkit-scrollbar-thumb:hover { background: #cbd5e1; }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-900 bg-main">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0">
                
                <!-- Desktop Header -->
                <header class="glass-header sticky top-0 z-30">
                    <div class="px-6 py-3 flex justify-between items-center">
                        <!-- Left Side: System Name & Title -->
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white text-xs font-black shadow-lg">S</div>
                                <span class="text-sm font-black text-slate-900 tracking-tight">SIMASOS PORTAL</span>
                            </div>
                            <div class="h-6 w-px bg-slate-200 hidden sm:block"></div>
                            @isset($header)
                                <div class="text-sm font-bold text-blue-600 uppercase tracking-widest hidden md:block">
                                    {{ $header }}
                                </div>
                            @endisset
                        </div>

                        <!-- Right Side: Date, Time & Profile -->
                        <div class="flex items-center gap-6">
                            <div class="hidden sm:flex flex-col items-end leading-none">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">DATA SISTEM</span>
                                <span class="text-xs font-black text-slate-800">
                                    {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                                </span>
                            </div>

                            <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                            <div class="flex items-center gap-3">
                                <div class="flex flex-col items-end text-right hidden sm:block leading-none">
                                    <p class="text-xs font-black text-slate-900 mb-1">{{ auth()->user()->name }}</p>
                                    <p class="text-[9px] font-black text-blue-500 uppercase tracking-widest">{{ auth()->user()->role }}</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" title="Pengaturan Profil" class="group relative">
                                    <div class="w-9 h-9 rounded-xl bg-slate-900 flex items-center justify-center text-xs font-black text-white shadow-xl transition-all group-hover:scale-110 group-hover:bg-blue-600">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full flex items-center justify-center text-[8px] text-white animate-pulse">✓</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-5 max-w-[1600px] mx-auto w-full">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
