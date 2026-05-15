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
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        animation: {
                            'fade-in': 'fadeIn 0.5s ease-out forwards',
                            'slide-up': 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                        }
                    }
                }
            }
        </script>
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
    <body class="font-sans antialiased text-slate-900 bg-main" x-data="{ mobileMenuOpen: false }">
        @php
            $currentRoute = request()->route() ? request()->route()->getName() : '';
            $iconMap = [
                'admin.dashboard' => '📈',
                'admin.interns' => '👥',
                'admin.alumni' => '🎓',
                'admin.attendances' => '📋',
                'admin.journals' => '📝',
                'admin.evaluations' => '⭐',
                'intern.dashboard' => '🏠',
                'intern.card' => '🪪',
                'intern.attendance' => '📋',
                'intern.journals' => '📝',
                'intern.evaluation' => '⭐',
            ];
            $currentIcon = $iconMap[$currentRoute] ?? 'S';
        @endphp

        <div class="flex min-h-screen">
            <!-- Sidebar Desktop -->
            <aside class="hidden lg:flex w-64 bg-gradient-to-b from-sky-100 to-emerald-100 flex-shrink-0 flex-col min-h-screen sticky top-0 z-40 border-r border-sky-200">
                @include('layouts.sidebar')
            </aside>

            <!-- Mobile Sidebar Drawer -->
            <div x-show="mobileMenuOpen" 
                 class="fixed inset-0 z-50 lg:hidden" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0">
                
                <!-- Backdrop -->
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>

                <!-- Sidebar Content -->
                <div class="fixed inset-y-0 left-0 w-72 bg-gradient-to-b from-sky-50 to-emerald-50 shadow-2xl flex flex-col"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full">
                    
                    <div class="absolute top-4 right-4 z-50">
                        <button @click="mobileMenuOpen = false" class="p-2 rounded-xl bg-white/80 text-slate-600 shadow-sm border border-sky-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0">
                
                <!-- Responsive Header -->
                <header class="glass-header sticky top-0 z-30">
                    <div class="px-4 sm:px-6 py-2.5 flex justify-between items-center">
                        <!-- Left Side -->
                        <div class="flex items-center gap-3">
                            <!-- Mobile Menu Toggle -->
                            <button @click="mobileMenuOpen = true" class="lg:hidden p-2 -ml-2 rounded-xl hover:bg-slate-100 text-slate-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>

                            <!-- Desktop Branding -->
                            <div class="hidden lg:flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white text-base font-black shadow-lg">
                                    {{ $currentIcon }}
                                </div>
                                <div class="flex flex-col leading-none">
                                    <span class="text-xs font-black text-slate-800 uppercase tracking-tight">SIMASOS</span>
                                    <span class="text-[8px] font-bold text-blue-500 uppercase tracking-widest mt-0.5">Sistem Magang</span>
                                </div>
                                <div class="h-6 w-px bg-slate-200 mx-2"></div>
                                @isset($header)
                                    <div class="text-sm font-black text-slate-800 uppercase tracking-widest truncate max-w-[300px]">
                                        {{ $header }}
                                    </div>
                                @endisset
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="flex items-center gap-3 sm:gap-6">
                            <!-- Desktop Date/Time -->
                            <div class="hidden md:flex flex-col items-end leading-none">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">DATA SISTEM</span>
                                <span class="text-xs font-black text-slate-800">
                                    {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                                </span>
                            </div>

                            <div class="h-8 w-px bg-slate-200 hidden md:block"></div>

                            <!-- User Profile -->
                            <div class="flex items-center gap-2 sm:gap-3">
                                @auth
                                    <div class="flex flex-col items-end text-right leading-none">
                                        <p class="text-[9px] sm:text-xs font-black text-slate-900 mb-0.5 truncate max-w-[70px] sm:max-w-[200px]">{{ auth()->user()->name }}</p>
                                        <p class="text-[7px] sm:text-[9px] font-black text-blue-500 uppercase tracking-widest">{{ auth()->user()->role }}</p>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="group relative">
                                        <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl bg-slate-900 overflow-hidden flex items-center justify-center text-xs font-black text-white shadow-xl transition-all group-hover:scale-110">
                                            @if(auth()->user()->photo_path)
                                                <img src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="absolute -top-0.5 -right-0.5 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full animate-pulse sm:w-3 sm:h-3"></div>
                                    </a>
                                @endauth
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
