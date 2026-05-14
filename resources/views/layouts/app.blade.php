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
            html, body { height: 100%; }
            .bg-main { background-color: #f8fafc; } /* Slate 50 */
            .sidebar-width { width: 260px; min-width: 260px; }
            .content-card { 
                background: white; 
                border: 1px solid #e2e8f0; 
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
                border-radius: 0.75rem;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-900 bg-main">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0">
                
                <!-- Desktop Header -->
                <header class="bg-white border-b border-slate-200 sticky top-0 z-30">
                    <div class="px-6 py-4 flex justify-between items-center">
                        <div class="flex items-center gap-4">
                            @isset($header)
                                {{ $header }}
                            @endisset
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-slate-500 hidden md:block">
                                {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                            </span>
                            <div class="h-8 w-px bg-slate-200 hidden md:block"></div>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-xs font-bold text-slate-600">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-700 hidden sm:block">{{ auth()->user()->name }}</span>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
