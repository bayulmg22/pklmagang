<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Interns -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Total Pendaftar</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total_interns'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl">👥</div>
                </div>
                <!-- Pending -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Menunggu Acc</p>
                        <h3 class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xl">⏳</div>
                </div>
                <!-- Active -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Peserta Aktif</p>
                        <h3 class="text-2xl font-bold text-green-600">{{ $stats['active'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl">✅</div>
                </div>
                <!-- Alumni -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 mb-1">Alumni Selesai</p>
                        <h3 class="text-2xl font-bold text-purple-600">{{ $stats['alumni'] }}</h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xl">🎓</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Menu Admin</h3>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('admin.interns') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">Kelola Peserta</a>
                        <a href="{{ route('admin.attendances') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700 transition">Pantau Absensi</a>
                        <a href="{{ route('admin.journals') }}" class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 transition">Jurnal Kegiatan</a>
                        <a href="{{ route('admin.evaluations') }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg text-sm font-semibold hover:bg-yellow-600 transition">Penilaian Akhir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
