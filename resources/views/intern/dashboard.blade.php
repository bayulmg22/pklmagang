<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-base text-blue-900">Dashboard Peserta</h2>
            <p class="text-xs text-teal-600">Selamat datang di SIMASOS, {{ auth()->user()->name }}</p>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        
        @if(auth()->user()->status === 'pending')
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 p-5 rounded-3xl flex items-center gap-4 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-200/20 rounded-full -mr-16 -mt-16"></div>
                <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 animate-pulse">⏳</div>
                <div class="relative z-10">
                    <h3 class="font-black text-amber-900 leading-tight">MENUNGGU VERIFIKASI</h3>
                    <p class="text-xs text-amber-700 mt-1 font-medium italic">Pendaftaran Anda sedang ditinjau oleh Admin Dinas Sosial. Harap tunggu persetujuan sebelum dapat mengakses fitur penuh.</p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            
            <!-- Left Column: User Status & ID Card Quick View -->
            <div class="md:col-span-4 space-y-6">
                <div class="bg-white rounded-3xl shadow-md border border-blue-100 p-6 flex flex-col items-center text-center">
                    <div class="w-24 h-24 rounded-full border-4 border-teal-50 shadow-lg mb-4 overflow-hidden bg-gray-100">
                        @if(auth()->user()->photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-3xl">👤</div>
                        @endif
                    </div>
                    <h2 class="text-xl font-black text-blue-950 leading-tight">{{ auth()->user()->name }}</h2>
                    <p class="text-teal-600 font-bold text-sm tracking-widest mt-1 uppercase">{{ auth()->user()->nim }}</p>
                    <div class="mt-4 px-4 py-1.5 rounded-full bg-blue-50 text-blue-700 text-[10px] font-black uppercase tracking-widest border border-blue-100">
                        {{ auth()->user()->school }}
                    </div>

                    <div class="w-full mt-6 grid grid-cols-2 gap-3">
                        <div class="bg-teal-50 rounded-2xl p-3 border border-teal-100">
                            <p class="text-[10px] font-bold text-teal-600 uppercase">Status</p>
                            <p class="text-xs font-black text-teal-900 mt-0.5">
                                @if(auth()->user()->status === 'approved') AKTIF
                                @elseif(auth()->user()->status === 'finished') ALUMNI
                                @else PENDING @endif
                            </p>
                        </div>
                        <div class="bg-blue-50 rounded-2xl p-3 border border-blue-100">
                            <p class="text-[10px] font-bold text-blue-600 uppercase">Peran</p>
                            <p class="text-xs font-black text-blue-900 mt-0.5">PESERTA</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-900 to-teal-800 rounded-3xl p-6 text-white shadow-xl">
                    <h3 class="font-black text-sm mb-3 uppercase tracking-widest flex items-center gap-2">
                        <span>🪪</span> ID CARD STATUS
                    </h3>
                    @if(auth()->user()->status === 'approved' || auth()->user()->status === 'finished')
                        <p class="text-xs text-blue-100 mb-4 font-medium italic">Kartu identitas Anda sudah dapat digunakan untuk keperluan absensi QR.</p>
                        <a href="{{ route('intern.card') }}" class="w-full py-2.5 bg-white text-blue-900 rounded-xl font-black text-xs text-center block shadow hover:bg-blue-50 transition">LIHAT KARTU</a>
                    @else
                        <p class="text-xs text-blue-200 mb-4 font-medium italic">Kartu identitas akan muncul setelah pendaftaran Anda disetujui admin.</p>
                        <button disabled class="w-full py-2.5 bg-blue-800/50 text-blue-400 rounded-xl font-black text-xs cursor-not-allowed">MENUNGGU ACC</button>
                    @endif
                </div>
            </div>

            <!-- Right Column: Main Features Grid -->
            <div class="md:col-span-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    <!-- Absensi -->
                    <div class="group relative bg-white rounded-3xl p-6 shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-150"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-3xl mb-4 group-hover:rotate-12 transition">📋</div>
                            <h3 class="text-lg font-black text-gray-800 leading-tight">Absensi Harian</h3>
                            <p class="text-xs text-gray-500 mt-2 font-medium italic">Laporkan kehadiran harian, sakit, atau izin dengan cepat.</p>
                            <div class="mt-6 flex justify-end">
                                @if(auth()->user()->status === 'approved')
                                    <a href="{{ route('intern.attendance') }}" class="px-5 py-2 bg-green-600 text-white rounded-xl text-xs font-black shadow-lg hover:bg-green-700 transition">ABSEN SEKARANG</a>
                                @else
                                    <span class="px-5 py-2 bg-gray-100 text-gray-400 rounded-xl text-xs font-black">TERKUNCI</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Jurnal -->
                    <div class="group relative bg-white rounded-3xl p-6 shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-purple-50 rounded-full -mr-12 -mt-12 transition-transform group-hover:scale-150"></div>
                        <div class="relative z-10">
                            <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center text-3xl mb-4 group-hover:rotate-12 transition">📝</div>
                            <h3 class="text-lg font-black text-gray-800 leading-tight">Jurnal Kegiatan</h3>
                            <p class="text-xs text-gray-500 mt-2 font-medium italic">Catat setiap aktivitas magang Anda sebagai bukti laporan.</p>
                            <div class="mt-6 flex justify-end">
                                @if(auth()->user()->status === 'approved' || auth()->user()->status === 'finished')
                                    <a href="{{ route('intern.journals') }}" class="px-5 py-2 bg-purple-600 text-white rounded-xl text-xs font-black shadow-lg hover:bg-purple-700 transition">ISI JURNAL</a>
                                @else
                                    <span class="px-5 py-2 bg-gray-100 text-gray-400 rounded-xl text-xs font-black">TERKUNCI</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Penilaian -->
                    <div class="group relative bg-white rounded-3xl p-6 shadow-md border border-gray-100 hover:shadow-xl transition-all duration-300 overflow-hidden sm:col-span-2">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full -mr-16 -mt-16 transition-transform group-hover:scale-150"></div>
                        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center gap-6">
                            <div class="w-20 h-20 bg-amber-100 text-amber-600 rounded-3xl flex-shrink-0 flex items-center justify-center text-4xl group-hover:rotate-12 transition">⭐</div>
                            <div class="flex-1">
                                <h3 class="text-xl font-black text-gray-800 leading-tight">Penilaian Akhir Magang</h3>
                                <p class="text-xs text-gray-500 mt-2 font-medium italic leading-relaxed">Lihat hasil evaluasi kinerja Anda dan unduh sertifikat nilai setelah masa magang berakhir. Hasil ini diberikan langsung oleh pembimbing Dinsos.</p>
                                <div class="mt-6">
                                    @if(auth()->user()->status === 'finished')
                                        <a href="{{ route('intern.evaluation') }}" class="px-6 py-2.5 bg-amber-500 text-white rounded-xl text-xs font-black shadow-lg hover:bg-amber-600 transition inline-block">LIHAT & CETAK HASIL</a>
                                    @else
                                        <span class="px-6 py-2.5 bg-amber-50/50 text-amber-600/50 border border-amber-200/30 rounded-xl text-xs font-black inline-block">PENILAIAN BELUM TERSEDIA</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Info Banner -->
                    <div class="sm:col-span-2 rounded-3xl p-6 flex flex-col sm:flex-row items-center gap-4 bg-gradient-to-r from-blue-900 to-teal-800 text-white shadow-inner">
                        <div class="text-4xl">🏛️</div>
                        <div class="text-center sm:text-left">
                            <p class="font-black text-sm tracking-tight">SIMASOS KAB. LAMONGAN</p>
                            <p class="text-[10px] text-teal-200 font-medium tracking-widest uppercase mt-0.5">Dinas Sosial Kabupaten Lamongan &bull; Sistem Informasi Manajemen Magang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
