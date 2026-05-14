<!-- Sidebar Container -->
<div class="w-64 bg-white shadow-xl flex-shrink-0 flex flex-col hidden md:flex min-h-screen">
    <!-- Logo -->
    <div class="h-20 flex items-center px-6 border-b border-gray-100 bg-gray-50">
        <a href="/" class="flex items-center gap-3">
            <x-application-logo class="block h-10 w-auto fill-current text-gray-800" />
            <span class="font-bold text-gray-800 leading-tight">Dinsos<br>Lamongan</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        @if(auth()->user()->role === 'admin')
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Menu Admin</p>
            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Dashboard
            </x-nav-link>
            
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Kelola Peserta</p>
            <x-nav-link :href="route('admin.interns')" :active="request()->routeIs('admin.interns')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Data Peserta
            </x-nav-link>
            <x-nav-link :href="route('admin.alumni')" :active="request()->routeIs('admin.alumni')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Alumni Magang
            </x-nav-link>

            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Aktivitas</p>
            <x-nav-link :href="route('admin.attendances')" :active="request()->routeIs('admin.attendances')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Pantau Absensi
            </x-nav-link>
            <x-nav-link :href="route('admin.journals')" :active="request()->routeIs('admin.journals')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Jurnal Kegiatan
            </x-nav-link>
            <x-nav-link :href="route('admin.evaluations')" :active="request()->routeIs('admin.evaluations')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Penilaian Akhir
            </x-nav-link>
        @else
            <p class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-4">Menu Peserta</p>
            <x-nav-link :href="route('intern.dashboard')" :active="request()->routeIs('intern.dashboard')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Dashboard
            </x-nav-link>
            <x-nav-link :href="route('intern.card')" :active="request()->routeIs('intern.card')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                ID Card Magang
            </x-nav-link>
            <x-nav-link :href="route('intern.attendance')" :active="request()->routeIs('intern.attendance')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Absensi Harian
            </x-nav-link>
            <x-nav-link :href="route('intern.journals')" :active="request()->routeIs('intern.journals')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Jurnal Kegiatan
            </x-nav-link>
            <x-nav-link :href="route('intern.evaluation')" :active="request()->routeIs('intern.evaluation')" class="flex w-full px-3 py-2 rounded-lg mb-1">
                Penilaian Akhir
            </x-nav-link>
        @endif
    </nav>

    <!-- User Profile & Logout -->
    <div class="border-t border-gray-100 p-4 bg-gray-50">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold overflow-hidden border">
                @if(auth()->user()->photo_path)
                    <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" class="w-full h-full object-cover">
                @else
                    {{ substr(auth()->user()->name, 0, 1) }}
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ ucfirst(auth()->user()->role) }}</p>
            </div>
        </div>
        
        <div class="flex flex-col gap-2">
            <a href="{{ route('profile.edit') }}" class="block w-full text-left px-3 py-2 text-sm text-gray-600 hover:bg-gray-200 rounded-md transition text-center">
                Pengaturan Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md transition text-center font-semibold">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Mobile Sidebar Overlay & Nav -->
<!-- (Sederhananya kita tampilkan tombol menu di topbar untuk mobile) -->
