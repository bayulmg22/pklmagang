<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-base text-blue-900">Dashboard Admin</h2>
            <p class="text-xs text-teal-600">Selamat datang, {{ auth()->user()->name }}</p>
        </div>
    </x-slot>

    <div class="grid grid-cols-12 gap-4 h-full">

        {{-- Row 1: Stats --}}
        <div class="col-span-12 grid grid-cols-4 gap-4">
            {{-- Total --}}
            <div class="rounded-2xl p-4 text-white shadow-lg flex items-center gap-4" style="background:linear-gradient(135deg,#1d4ed8,#0ea5e9);">
                <div class="text-4xl">👥</div>
                <div>
                    <p class="text-xs font-semibold text-blue-100 uppercase tracking-wide">Total Pendaftar</p>
                    <p class="text-3xl font-black">{{ $stats['total_interns'] }}</p>
                </div>
            </div>
            {{-- Pending --}}
            <div class="rounded-2xl p-4 text-white shadow-lg flex items-center gap-4" style="background:linear-gradient(135deg,#d97706,#fbbf24);">
                <div class="text-4xl">⏳</div>
                <div>
                    <p class="text-xs font-semibold text-yellow-100 uppercase tracking-wide">Menunggu ACC</p>
                    <p class="text-3xl font-black">{{ $stats['pending'] }}</p>
                </div>
            </div>
            {{-- Active --}}
            <div class="rounded-2xl p-4 text-white shadow-lg flex items-center gap-4" style="background:linear-gradient(135deg,#0d9488,#22c55e);">
                <div class="text-4xl">✅</div>
                <div>
                    <p class="text-xs font-semibold text-green-100 uppercase tracking-wide">Peserta Aktif</p>
                    <p class="text-3xl font-black">{{ $stats['active'] }}</p>
                </div>
            </div>
            {{-- Alumni --}}
            <div class="rounded-2xl p-4 text-white shadow-lg flex items-center gap-4" style="background:linear-gradient(135deg,#7c3aed,#a78bfa);">
                <div class="text-4xl">🎓</div>
                <div>
                    <p class="text-xs font-semibold text-purple-100 uppercase tracking-wide">Alumni Selesai</p>
                    <p class="text-3xl font-black">{{ $stats['alumni'] }}</p>
                </div>
            </div>
        </div>

        {{-- Row 2: Quick Access Cards --}}
        <div class="col-span-12 grid grid-cols-3 gap-4">
            <a href="{{ route('admin.interns') }}" class="group rounded-2xl p-5 flex items-center gap-4 shadow-md hover:shadow-xl transition-all hover:-translate-y-1" style="background:linear-gradient(135deg,#eff6ff,#dbeafe);border:1.5px solid #bfdbfe;">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow" style="background:linear-gradient(135deg,#1d4ed8,#0ea5e9);">👥</div>
                <div>
                    <p class="font-bold text-blue-900 text-sm">Data Peserta</p>
                    <p class="text-xs text-blue-500">Kelola & setujui pendaftar</p>
                </div>
                <span class="ml-auto text-blue-300 group-hover:text-blue-600 text-lg">›</span>
            </a>
            <a href="{{ route('admin.alumni') }}" class="group rounded-2xl p-5 flex items-center gap-4 shadow-md hover:shadow-xl transition-all hover:-translate-y-1" style="background:linear-gradient(135deg,#f5f3ff,#ede9fe);border:1.5px solid #ddd6fe;">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow" style="background:linear-gradient(135deg,#7c3aed,#a78bfa);">🎓</div>
                <div>
                    <p class="font-bold text-purple-900 text-sm">Alumni Magang</p>
                    <p class="text-xs text-purple-400">Data peserta yang selesai</p>
                </div>
                <span class="ml-auto text-purple-300 group-hover:text-purple-600 text-lg">›</span>
            </a>
            <a href="{{ route('admin.attendances') }}" class="group rounded-2xl p-5 flex items-center gap-4 shadow-md hover:shadow-xl transition-all hover:-translate-y-1" style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:1.5px solid #bbf7d0;">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow" style="background:linear-gradient(135deg,#0d9488,#22c55e);">📋</div>
                <div>
                    <p class="font-bold text-green-900 text-sm">Pantau Absensi</p>
                    <p class="text-xs text-green-500">Rekap kehadiran harian</p>
                </div>
                <span class="ml-auto text-green-300 group-hover:text-green-600 text-lg">›</span>
            </a>
            <a href="{{ route('admin.journals') }}" class="group rounded-2xl p-5 flex items-center gap-4 shadow-md hover:shadow-xl transition-all hover:-translate-y-1" style="background:linear-gradient(135deg,#fff7ed,#ffedd5);border:1.5px solid #fed7aa;">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow" style="background:linear-gradient(135deg,#c2410c,#fb923c);">📝</div>
                <div>
                    <p class="font-bold text-orange-900 text-sm">Jurnal Kegiatan</p>
                    <p class="text-xs text-orange-400">Aktivitas harian peserta</p>
                </div>
                <span class="ml-auto text-orange-300 group-hover:text-orange-600 text-lg">›</span>
            </a>
            <a href="{{ route('admin.evaluations') }}" class="group rounded-2xl p-5 flex items-center gap-4 shadow-md hover:shadow-xl transition-all hover:-translate-y-1" style="background:linear-gradient(135deg,#fefce8,#fef9c3);border:1.5px solid #fde68a;">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl shadow" style="background:linear-gradient(135deg,#a16207,#eab308);">⭐</div>
                <div>
                    <p class="font-bold text-yellow-900 text-sm">Penilaian Akhir</p>
                    <p class="text-xs text-yellow-600">Beri nilai & predikat peserta</p>
                </div>
                <span class="ml-auto text-yellow-300 group-hover:text-yellow-600 text-lg">›</span>
            </a>

            {{-- Info Banner --}}
            <div class="rounded-2xl p-5 flex items-center gap-4" style="background:linear-gradient(135deg,#1e3a8a,#0d9488);color:white;">
                <div class="text-3xl">🏛️</div>
                <div>
                    <p class="font-bold text-sm">SIMASOS</p>
                    <p class="text-xs text-blue-200">Sistem Manajemen Magang</p>
                    <p class="text-xs text-teal-200 mt-0.5">Dinas Sosial Kab. Lamongan</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
