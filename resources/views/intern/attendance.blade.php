<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Absensi Harian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6 text-center relative">
                <div class="absolute top-6 right-6">
                    <a href="{{ route('intern.attendance.print') }}" target="_blank" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700 transition text-sm">
                        🖨️ Cetak PDF
                    </a>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h3>
                <p class="text-gray-500 mb-8">Silakan lakukan absensi kehadiran Anda hari ini.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Absen Masuk -->
                    <div class="p-6 border rounded-xl {{ $attendance ? 'bg-gray-50 border-gray-200' : 'bg-white border-blue-200 shadow-sm' }}">
                        <div class="text-4xl mb-4">🌅</div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Absen Masuk</h4>
                        <p class="text-sm text-gray-500 mb-4">Batas Waktu: 07:00 - 09:00</p>
                        
                        @if($attendance)
                            <div class="inline-flex items-center gap-2 text-green-600 font-bold bg-green-50 px-4 py-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Tercatat: {{ $attendance->check_in_time ?? '-' }} ({{ ucfirst($attendance->status) }})
                            </div>
                        @else
                            <form action="{{ route('intern.attendance.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="check_in">
                                <div class="mb-4 text-left">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan Kehadiran:</label>
                                    <div class="flex gap-4">
                                        <label class="flex items-center gap-2">
                                            <input type="radio" name="status" value="hadir" checked class="text-blue-600 focus:ring-blue-500">
                                            <span class="text-sm">Hadir</span>
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="radio" name="status" value="izin" class="text-yellow-500 focus:ring-yellow-400">
                                            <span class="text-sm">Izin</span>
                                        </label>
                                        <label class="flex items-center gap-2">
                                            <input type="radio" name="status" value="sakit" class="text-red-500 focus:ring-red-400">
                                            <span class="text-sm">Sakit</span>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Kirim Absensi</button>
                            </form>
                        @endif
                    </div>

                    <!-- Absen Pulang -->
                    <div class="p-6 border rounded-xl {{ ($attendance && $attendance->check_out_time) ? 'bg-gray-50 border-gray-200' : 'bg-white border-green-200 shadow-sm' }}">
                        <div class="text-4xl mb-4">🌇</div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Absen Pulang</h4>
                        <p class="text-sm text-gray-500 mb-4">Minimal Jam: 15:00</p>
                        
                        @if($attendance && $attendance->check_out_time)
                            <div class="inline-flex items-center gap-2 text-green-600 font-bold bg-green-50 px-4 py-2 rounded-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Tercatat: {{ $attendance->check_out_time }}
                            </div>
                        @else
                            <form action="{{ route('intern.attendance.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" value="check_out">
                                <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition" {{ !$attendance ? 'disabled' : '' }}>
                                    Absen Pulang Sekarang
                                </button>
                            </form>
                            @if(!$attendance)
                                <p class="text-xs text-red-500 mt-2">Anda harus Absen Masuk terlebih dahulu.</p>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-100 text-left">
                    <h4 class="font-bold text-gray-800 mb-4">Alternatif: Scan QR Code</h4>
                    <p class="text-sm text-gray-600 mb-4">Jika Anda berada di kantor, Anda juga dapat menunjukkan <a href="{{ route('intern.card.print') }}" target="_blank" class="text-blue-600 underline">ID Card QR Code</a> Anda kepada Admin untuk di-scan.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
