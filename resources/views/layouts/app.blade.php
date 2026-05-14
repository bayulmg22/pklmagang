<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="min-h-screen bg-gray-100 flex">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0">
                
                <!-- Mobile Header -->
                <div class="md:hidden flex items-center justify-between bg-white border-b border-gray-100 px-4 py-3">
                    <a href="/" class="flex items-center gap-2">
                        <x-application-logo class="block h-8 w-auto" />
                        <span class="font-bold text-gray-800">Dinsos Lamongan</span>
                    </a>
                    <!-- Simplified mobile menu (just user info for now) -->
                    <div class="text-sm font-bold text-gray-600">{{ substr(auth()->user()->name, 0, 10) }}..</div>
                </div>

                <!-- Page Heading (Optional) -->
                @isset($header)
                    <header class="bg-white shadow z-10 relative">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Content Area -->
                <main class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>
