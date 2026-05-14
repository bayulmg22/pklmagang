<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Intern Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(auth()->user()->status === 'pending')
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Menunggu Persetujuan!</strong>
                    <span class="block sm:inline">Pendaftaran Anda sedang ditinjau oleh Admin. Harap tunggu persetujuan untuk mencetak ID Card dan mengakses fitur magang lainnya.</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- ID Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 text-center p-6">
                    <div class="w-16 h-16 mx-auto bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-3xl mb-4">🪪</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">ID Card Magang</h3>
                    <p class="text-sm text-gray-500 mb-4">Cetak kartu identitas dan QR Code untuk keperluan absensi.</p>
                    @if(auth()->user()->status === 'approved' || auth()->user()->status === 'finished')
                        <a href="{{ route('intern.card') }}" target="_blank" class="w-full inline-block px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Cetak Kartu</a>
                    @else
                        <button disabled class="w-full px-4 py-2 bg-gray-300 text-gray-500 rounded-lg font-semibold cursor-not-allowed">Menunggu Persetujuan</button>
                    @endif
                </div>

                <!-- Absensi -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 text-center p-6">
                    <div class="w-16 h-16 mx-auto bg-green-100 text-green-600 rounded-full flex items-center justify-center text-3xl mb-4">📷</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Absensi Harian</h3>
                    <p class="text-sm text-gray-500 mb-4">Lakukan absensi masuk (07:00-09:00) dan pulang (>15:00).</p>
                    @if(auth()->user()->status === 'approved' || auth()->user()->status === 'finished')
                        <a href="{{ route('intern.attendance') }}" class="w-full inline-block px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">Isi Absensi</a>
                    @else
                        <button disabled class="w-full px-4 py-2 bg-gray-300 text-gray-500 rounded-lg font-semibold cursor-not-allowed">Belum Tersedia</button>
                    @endif
                </div>

                <!-- Jurnal -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 text-center p-6">
                    <div class="w-16 h-16 mx-auto bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-3xl mb-4">📝</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Jurnal Kegiatan</h3>
                    <p class="text-sm text-gray-500 mb-4">Catat kegiatan harian dan upload foto bukti aktivitas.</p>
                    @if(auth()->user()->status === 'approved' || auth()->user()->status === 'finished')
                        <a href="{{ route('intern.journals') }}" class="w-full inline-block px-4 py-2 bg-purple-600 text-white rounded-lg font-semibold hover:bg-purple-700 transition">Isi Jurnal</a>
                    @else
                        <button disabled class="w-full px-4 py-2 bg-gray-300 text-gray-500 rounded-lg font-semibold cursor-not-allowed">Belum Tersedia</button>
                    @endif
                </div>

                <!-- Penilaian Akhir -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 text-center p-6 mt-6 md:mt-0 md:col-span-3">
                    <div class="w-16 h-16 mx-auto bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-3xl mb-4">🏆</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Penilaian Akhir Magang</h3>
                    <p class="text-sm text-gray-500 mb-4">Lihat hasil evaluasi dari pembimbing dan cetak sertifikat nilai.</p>
                    @if(auth()->user()->status === 'finished')
                        <a href="{{ route('intern.evaluation') }}" class="inline-block px-8 py-2 bg-yellow-500 text-white rounded-lg font-semibold hover:bg-yellow-600 transition">Lihat & Cetak Nilai</a>
                    @else
                        <button disabled class="px-8 py-2 bg-gray-300 text-gray-500 rounded-lg font-semibold cursor-not-allowed">Belum Tersedia</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
