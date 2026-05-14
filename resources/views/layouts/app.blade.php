<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'SIMASOS') }} — Dinas Sosial Kab. Lamongan</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            html, body { height: 100%; overflow: hidden; }
            .main-scroll { overflow-y: auto; height: 100%; }
            /* Teal-blue gradient utilities */
            .grad-teal { background: linear-gradient(135deg, #0d9488 0%, #0891b2 100%); }
            .grad-blue { background: linear-gradient(135deg, #1e40af 0%, #0ea5e9 100%); }
            .card-glass { background: rgba(255,255,255,0.85); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.6); }
        </style>
    </head>
    <body class="font-sans antialiased" style="height:100vh;overflow:hidden;background:linear-gradient(135deg,#e0f2fe 0%,#f0fdf4 50%,#e0f2fe 100%);">
        <div class="flex" style="height:100vh;">
            @include('layouts.sidebar')
            <div class="flex-1 flex flex-col min-w-0" style="height:100vh;overflow:hidden;">
                <!-- Mobile Header -->
                <div class="md:hidden flex items-center justify-between px-4 py-2 shadow" style="background:linear-gradient(90deg,#1e3a8a,#0d9488);">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('logo-dinsos.jpg') }}" style="height:26px;width:auto;border-radius:4px;background:white;padding:1px;" alt="Logo">
                        <span class="font-bold text-white text-sm">SIMASOS</span>
                    </div>
                    <div class="text-xs text-teal-200">{{ substr(auth()->user()->name, 0, 14) }}</div>
                </div>
                <!-- Page Heading -->
                @isset($header)
                    <header class="flex-shrink-0 border-b" style="background:rgba(255,255,255,0.75);backdrop-filter:blur(8px);border-color:rgba(14,165,233,0.2);">
                        <div class="px-5 py-3 flex justify-between items-center">
                            {{ $header }}
                            <span class="text-xs text-teal-600 font-medium hidden md:block">
                                {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }} &bull;
                                <strong>{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }} WIB</strong>
                            </span>
                        </div>
                    </header>
                @endisset
                <!-- Content -->
                <main class="flex-1 main-scroll p-4 md:p-5">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
