<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIMASOS') }} — Dinsos Lamongan</title>

        <!-- Fonts: Plus Jakarta Sans & Inter -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800|inter:400,500,600,700&display=swap" rel="stylesheet" />

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

            [x-cloak] { display: none !important; }

            html, body, .font-sans {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif !important;
                height: 100%;
                scroll-behavior: smooth;
            }
            h1, h2, h3, h4, h5, h6, .font-bold, .font-black, .font-extrabold {
                font-family: 'Plus Jakarta Sans', sans-serif !important;
                letter-spacing: -0.02em;
            }
            .bg-main { 
                background: #f8fafc;
                background-attachment: fixed;
            }
            
            .sidebar-width { width: 280px; min-width: 280px; }
            
            .content-card { 
                background: #ffffff;
                border: 1px solid rgba(226, 232, 240, 0.8);
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.03);
                border-radius: 1.25rem;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .content-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.04);
                border-color: rgba(59, 130, 246, 0.2);
            }

            .glass-header {
                background: rgba(255, 255, 255, 0.85);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border-bottom: 1px solid #f1f5f9;
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
    <body class="font-sans antialiased text-slate-900 bg-main" 
          x-data="{ 
              mobileMenuOpen: false, 
              sidebarMinimized: localStorage.getItem('sidebarMinimized') === 'true' 
          }" 
          x-init="$watch('sidebarMinimized', val => localStorage.setItem('sidebarMinimized', val))">
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
            <aside :class="sidebarMinimized ? 'w-[80px] is-minimized' : 'w-64'" class="hidden lg:flex group/sidebar bg-white flex-shrink-0 flex-col h-screen sticky top-0 z-40 transition-[width] duration-300 ease-in-out">
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
                <div class="fixed inset-y-0 left-0 w-72 bg-white shadow-2xl flex flex-col"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full">
                    
                    <div class="absolute top-4 right-4 z-50">
                        <button @click="mobileMenuOpen = false" class="p-2 rounded-xl bg-white text-slate-500 hover:text-slate-800 shadow-sm border border-slate-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto group/sidebar">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0">
                
                <!-- Optimized Responsive Header (Donezo Design Style) -->
                <header class="glass-header sticky top-0 z-30 h-20 flex items-center bg-white/80 backdrop-blur-md">
                    <div class="w-full px-4 sm:px-6 flex justify-between items-center">
                        <!-- Left Side: Mobile Menu & Search Task -->
                        <div class="flex items-center gap-4 flex-1">
                            <!-- Mobile Menu Toggle -->
                            <button @click="mobileMenuOpen = true" class="lg:hidden p-2 -ml-2 rounded-xl hover:bg-slate-100 text-slate-600 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>

                            <!-- Centered Donezo-style Search task input -->
                            <div class="hidden md:flex items-center bg-slate-50 rounded-xl px-3.5 py-2 w-72 border border-slate-200/50 focus-within:border-blue-500/40 focus-within:bg-white focus-within:shadow-sm transition-all duration-200 gap-2 shrink-0">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" /></svg>
                                <input type="text" placeholder="Search task" class="bg-transparent border-none p-0 text-xs text-slate-700 placeholder-slate-400 focus:ring-0 focus:outline-none w-full leading-none font-medium">
                                <span class="text-[10px] text-slate-400 font-bold bg-white border border-slate-200 rounded px-1.5 py-0.5 leading-none shrink-0 shadow-sm flex items-center gap-0.5 select-none">⌘F</span>
                            </div>
                        </div>

                        <!-- Right Side: Mail, Bell, and User Profile Side-by-Side -->
                        <div class="flex items-center gap-2 sm:gap-4 min-w-0">
                            <!-- Mail Button -->
                            <button class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                            </button>

                            <!-- Bell Notification Button -->
                            <button class="p-2 rounded-xl text-slate-400 hover:text-slate-600 hover:bg-slate-50 transition duration-200 relative">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" /></svg>
                                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-blue-600 border border-white rounded-full"></span>
                            </button>

                            <div class="h-8 w-px bg-slate-100 mx-1 hidden sm:block"></div>

                            <!-- Donezo-style side-by-side profile -->
                            <div class="flex items-center gap-3">
                                @auth
                                    <div class="hidden sm:flex flex-col text-right leading-tight">
                                        <span class="text-xs font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</span>
                                        <span class="text-[9px] text-slate-400 font-semibold mt-1 tracking-wider uppercase leading-none">{{ auth()->user()->role === 'intern' ? 'Peserta' : 'Admin' }}</span>
                                    </div>
                                    <a href="{{ route('profile.edit') }}" class="flex-shrink-0 group relative">
                                        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full overflow-hidden border border-slate-200/80 flex items-center justify-center bg-slate-100 text-slate-700 font-extrabold shadow-sm transition duration-200 group-hover:scale-105">
                                            @if(auth()->user()->photo_path)
                                                <img src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                            @endif
                                        </div>
                                        <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full animate-pulse sm:w-3 sm:h-3"></div>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-5 max-w-[1600px] mx-auto w-full">
                    @isset($header)
                        <div class="mb-6 animate-fade">
                            <div class="flex items-center gap-2 mb-1">
                                <div class="w-1 h-4 bg-blue-600 rounded-full"></div>
                                <h2 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Halaman Menu</h2>
                            </div>
                            <h1 class="text-xl sm:text-2xl font-black text-slate-800 uppercase tracking-tight">{{ $header }}</h1>
                        </div>
                    @endisset

                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
