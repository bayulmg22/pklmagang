<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Laporan Kehadiran') }}
                </h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Kelola pencatatan kehadiran, pengajuan izin, dan unduh laporan absensi harian Anda.</p>
            </div>
            
            <a href="{{ route('intern.attendance.print') }}" target="_blank"
               class="inline-flex items-center gap-2.5 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold tracking-wide transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 1.252a1.125 1.125 0 0 1-1.107 1.328H7.218a1.125 1.125 0 0 1-1.107-1.328L6.34 18m11.32 0t-.115-.572a16.48 16.48 0 0 0-11.32 0l-.115.572m0 0-.229-1.252A1.125 1.125 0 0 1 5.682 15h12.636a1.125 1.125 0 0 1 1.107 1.328L17.66 18m-11.32 0h11.32" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.75 8.25h1.125c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-1.125M5.25 8.25H4.125C3.504 8.25 3 8.754 3 9.375v4.5c0 .621.504 1.125 1.125 1.125h1.125M14.25 18a1.5 1.5 0 0 0-3 0h3ZM16.5 8.25V5.625c0-.621-.504-1.125-1.125-1.125H8.625C8.004 4.5 7.5 5.004 7.5 5.625V8.25h9Z" />
                </svg>
                Cetak Rekap PDF
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- Alerts -->
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-2xl text-sm font-semibold shadow-sm flex items-center gap-3">
                <div class="p-1 bg-emerald-100 text-emerald-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 rounded-r-2xl text-sm font-semibold shadow-sm flex items-center gap-3">
                <div class="p-1 bg-rose-100 text-rose-600 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Main Workspace Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Side: Interactive Attendance Board (Takes 2 Columns) -->
            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/40 overflow-hidden">
                    <div class="border-b border-slate-50 px-8 py-6 bg-slate-50/50 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <span class="font-bold text-slate-800 text-sm">Absensi Hari Ini</span>
                        </div>
                        <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-full uppercase tracking-wider">Metode Mandiri</span>
                    </div>

                    <div class="p-8">
                        @if(auth()->user()->status === 'finished')
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" /></svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-800">Program Magang Selesai</h3>
                                <p class="text-sm text-slate-500 mt-2">Masa program magang Anda telah selesai. Silakan unduh rekap absensi Anda melalui tombol cetak di atas.</p>
                            </div>
                        @elseif($attendance)
                            <!-- Today's Attendance Logged -->
                            <div class="space-y-6">
                                <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100 flex flex-col sm:flex-row sm:items-center gap-5 justify-between">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm border border-slate-100 flex items-center justify-center text-xl">
                                            @if($attendance->status === 'hadir') 🎯 
                                            @elseif($attendance->status === 'izin') 📄 
                                            @else 💊 
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest">Status Presensi Anda</p>
                                            <h4 class="text-lg font-black text-slate-800 mt-0.5 uppercase flex items-center gap-2">
                                                {{ $attendance->status }}
                                                @if($attendance->check_in_time)
                                                    <span class="text-xs font-semibold text-slate-500 lowercase tracking-normal">pada {{ \Carbon\Carbon::parse($attendance->check_in_time)->format('H:i') }} WIB</span>
                                                @endif
                                            </h4>
                                            
                                            @if($attendance->keterangan)
                                                <p class="text-xs text-slate-500 font-medium mt-1">
                                                    <span class="font-bold text-slate-600">Alasan:</span> {{ $attendance->keterangan }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div>
                                        @if($attendance->status === 'hadir')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-bold border border-emerald-100">
                                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span> Hadir Kantor
                                            </span>
                                        @elseif($attendance->status === 'izin')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-bold border border-amber-100">
                                                📄 Izin Resmi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-rose-50 text-rose-700 rounded-full text-xs font-bold border border-rose-100">
                                                💊 Sakit
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if($attendance->status === 'hadir' && !$attendance->check_out_time)
                                    <!-- Checkout Box -->
                                    <div class="p-6 bg-slate-900 rounded-2xl text-white space-y-4">
                                        <div>
                                            <h4 class="font-bold text-sm">Waktunya Pulang?</h4>
                                            <p class="text-xs text-slate-400 mt-1">Presensi kepulangan Anda dapat dilakukan minimal mulai pukul 15:00 WIB.</p>
                                        </div>
                                        <form action="{{ route('intern.attendance.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="type" value="check_out">
                                            <button type="submit"
                                                class="w-full py-3.5 bg-blue-600 hover:bg-blue-500 text-white rounded-xl font-bold text-xs tracking-wider uppercase transition-all duration-200 shadow-md active:translate-y-0.5">
                                                🌇 Catat Jam Absen Pulang
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="p-6 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-center gap-4 text-emerald-800">
                                        <div class="p-3 bg-emerald-100 rounded-xl text-emerald-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xs font-black uppercase tracking-widest text-emerald-600">Aktivitas Hari Ini Selesai</p>
                                            <p class="text-xs text-emerald-700 font-semibold mt-1">
                                                @if($attendance->check_out_time)
                                                    Anda telah melakukan pencatatan jam pulang pada <span class="font-bold">{{ \Carbon\Carbon::parse($attendance->check_out_time)->format('H:i') }} WIB</span>. Terima kasih atas kontribusi hari ini!
                                                @else
                                                    Seluruh pencatatan kehadiran untuk hari ini telah tuntas disimpan. Sampai jumpa esok hari!
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Not Checked In yet - Form selection for Absence (Izin/Sakit) -->
                            <form action="{{ route('intern.attendance.store') }}" method="POST" enctype="multipart/form-data" id="absenForm" class="space-y-8">
                                @csrf
                                <input type="hidden" name="type" value="check_in">

                                <div>
                                    <h4 class="text-sm font-extrabold text-slate-700 mb-4 uppercase tracking-wider text-center">Pilih Keterangan Ketidakhadiran</h4>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="status" value="izin" class="sr-only peer" onchange="toggleKeterangan(this)">
                                            <div class="p-5 bg-white border-2 border-slate-100 rounded-2xl text-center transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50/20 group-hover:border-slate-200 group-hover:-translate-y-0.5 duration-200 shadow-sm">
                                                <div class="w-12 h-12 mx-auto bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl mb-3 duration-200 peer-checked:bg-blue-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </div>
                                                <p class="text-sm font-extrabold text-slate-800">Izin Khusus / Kuliah</p>
                                                <p class="text-[11px] text-slate-400 mt-1 font-medium">Ada urusan resmi atau kegiatan akademik</p>
                                            </div>
                                        </label>
                                        <label class="relative cursor-pointer group">
                                            <input type="radio" name="status" value="sakit" class="sr-only peer" onchange="toggleKeterangan(this)">
                                            <div class="p-5 bg-white border-2 border-slate-100 rounded-2xl text-center transition-all peer-checked:border-rose-600 peer-checked:bg-rose-50/20 group-hover:border-slate-200 group-hover:-translate-y-0.5 duration-200 shadow-sm">
                                                <div class="w-12 h-12 mx-auto bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-xl mb-3 duration-200 peer-checked:bg-rose-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                                                    </svg>
                                                </div>
                                                <p class="text-sm font-extrabold text-slate-800">Sakit Kesehatan</p>
                                                <p class="text-[11px] text-slate-400 mt-1 font-medium">Kondisi kesehatan tidak memungkinkan hadir</p>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div id="keteranganBox" class="hidden space-y-5 bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alasan / Keterangan Deskriptif <span class="text-rose-500">*</span></label>
                                        <textarea name="keterangan" rows="3" required
                                            class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-xs font-medium focus:ring-2 focus:ring-blue-600 focus:border-transparent focus:outline-none transition-all resize-none shadow-sm"
                                            placeholder="Jelaskan secara singkat..."></textarea>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Unggah Bukti Pendukung <span class="text-slate-400 font-normal text-[10px]">(Opsional - PDF/JPG/PNG max 5MB)</span></label>
                                        <input type="file" name="keterangan_file" accept=".jpg,.jpeg,.png,.pdf"
                                            class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 transition cursor-pointer border border-slate-200 rounded-xl p-1 bg-white">
                                    </div>
                                </div>

                                <button type="submit" id="submitBtn" disabled
                                    class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold text-xs tracking-wider uppercase hover:bg-slate-800 transition duration-200 shadow-md active:translate-y-0.5 disabled:opacity-30 disabled:cursor-not-allowed">
                                    KIRIM LAPORAN KEHADIRAN
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Side: Real-time clock & QR Scan Instructions (Takes 1 Column) -->
            <div class="space-y-8">
                
                <!-- Live Clock Card -->
                <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-blue-950 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl shadow-slate-200">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute -left-10 -top-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10 space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></span>
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Live Server Clock</span>
                        </div>
                        
                        <div class="space-y-1">
                            <h3 class="text-3xl font-black tracking-tight tabular-nums" id="live-clock">
                                {{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') }} WIB
                            </h3>
                            <p class="text-xs text-blue-400 font-bold tracking-wide">
                                {{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->translatedFormat('l, d F Y') }}
                            </p>
                        </div>
                        
                        <div class="pt-4 border-t border-slate-700/50 flex items-center justify-between text-[10px] text-slate-400 font-medium">
                            <span>Mulai Absen: <strong class="text-slate-200">07:00 WIB</strong></span>
                            <span>Absen Pulang: <strong class="text-slate-200">15:00 WIB</strong></span>
                        </div>
                    </div>
                </div>

                <!-- Info QR Card -->
                <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/40 p-8 space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 15h.008v.008H15V15Zm0 2.25h.008v.008H15v-.008ZM12 15h.008v.008H12V15Zm2.25 2.25h.008v.008h-.008v-.008ZM12 17.25h.008v.008H12v-.008Zm2.25-2.25h.008v.008h-.008v-.008ZM16.5 15h.008v.008H16.5V15Zm0 2.25h.008v.008H16.5v-.008ZM12 19.5h.008v.008H12v-.008Zm2.25 0h.008v.008h-.008v-.008ZM15 18.75h.008v.008H15v-.008Z" />
                            </svg>
                        </div>
                        <h4 class="font-extrabold text-sm text-slate-800 uppercase tracking-wider">Metode QR Code</h4>
                    </div>

                    <p class="text-xs text-slate-500 font-medium leading-relaxed">
                        Bagi peserta yang hadir di kantor secara langsung, Anda tidak perlu mengisi formulir ketidakhadiran di samping. Cukup tunjukkan <a href="{{ route('intern.card') }}" class="font-bold text-blue-600 hover:underline">ID Card QR Code</a> Anda kepada Admin di meja resepsionis untuk dipindai secara otomatis.
                    </p>

                    <a href="{{ route('intern.card') }}" 
                       class="flex items-center justify-center gap-2 w-full py-3 bg-blue-50 hover:bg-blue-100/70 text-blue-700 text-xs font-bold rounded-xl transition-all duration-200">
                        Lihat Kartu Presensi QR
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                        </svg>
                    </a>
                </div>

            </div>

        </div>

        <!-- Full Width: Attendance History (10 Days) -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/40 overflow-hidden">
            <div class="border-b border-slate-50 px-8 py-6 bg-slate-50/50 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-slate-100 text-slate-700 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-0.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <span class="font-bold text-slate-800 text-sm">Riwayat Kehadiran (10 Hari Terakhir)</span>
                </div>
                <span class="text-slate-400 text-xs font-semibold">Tercatat di sistem</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/40 text-[10px] font-extrabold uppercase tracking-widest text-slate-400 border-b border-slate-100">
                            <th class="px-8 py-4">Hari & Tanggal</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-center">Jam Masuk</th>
                            <th class="px-6 py-4 text-center">Jam Pulang</th>
                            <th class="px-8 py-4">Alasan & Dokumen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 text-xs">
                        @forelse($history as $row)
                            <tr class="hover:bg-slate-50/30 transition-all duration-100">
                                <td class="px-8 py-4.5 font-bold text-slate-800">
                                    {{ \Carbon\Carbon::parse($row->date)->locale('id')->translatedFormat('l, d F Y') }}
                                </td>
                                <td class="px-6 py-4.5">
                                    @if($row->status === 'hadir')
                                        <span class="inline-block px-2.5 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] font-bold rounded-full border border-emerald-100 uppercase tracking-wider">Hadir</span>
                                    @elseif($row->status === 'izin')
                                        <span class="inline-block px-2.5 py-0.5 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-full border border-amber-100 uppercase tracking-wider">Izin</span>
                                    @else
                                        <span class="inline-block px-2.5 py-0.5 bg-rose-50 text-rose-700 text-[10px] font-bold rounded-full border border-rose-100 uppercase tracking-wider">Sakit</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4.5 text-center font-bold text-slate-600 tabular-nums">
                                    {{ $row->check_in_time ? \Carbon\Carbon::parse($row->check_in_time)->format('H:i') : '-' }}
                                </td>
                                <td class="px-6 py-4.5 text-center font-bold text-slate-600 tabular-nums">
                                    {{ $row->check_out_time ? \Carbon\Carbon::parse($row->check_out_time)->format('H:i') : '-' }}
                                </td>
                                <td class="px-8 py-4.5">
                                    <div class="flex items-center justify-between gap-4">
                                        <span class="text-slate-500 font-medium truncate max-w-[200px]" title="{{ $row->keterangan ?? 'Hadir tepat waktu di kantor.' }}">
                                            {{ $row->keterangan ?? 'Hadir di kantor.' }}
                                        </span>
                                        
                                        @if($row->keterangan_file)
                                            <a href="{{ asset('storage/' . $row->keterangan_file) }}" target="_blank"
                                               class="inline-flex items-center gap-1 text-[10px] font-bold text-blue-600 hover:text-blue-700 bg-blue-50/70 px-2 py-1 rounded-md transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                </svg>
                                                Dokumen
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-slate-400 font-medium">Belum ada riwayat kehadiran tercatat.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script>
        // Real-time Clock Update
        setInterval(() => {
            const clockEl = document.getElementById('live-clock');
            if (clockEl) {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                clockEl.textContent = `${hours}:${minutes}:${seconds} WIB`;
            }
        }, 1000);

        // Toggle Keterangan Box
        function toggleKeterangan(el) {
            const kBox = document.getElementById('keteranganBox');
            const submitBtn = document.getElementById('submitBtn');
            kBox.classList.remove('hidden');
            submitBtn.removeAttribute('disabled');
            
            const ta = document.querySelector('textarea[name="keterangan"]');
            if (ta) {
                ta.placeholder = el.value === 'izin' 
                    ? 'Contoh: Menghadiri urusan administrasi kampus / ada kepentingan mendesak...' 
                    : 'Contoh: Sedang berobat ke dokter karena sakit demam dan flu...';
                ta.focus();
            }
        }
    </script>
</x-app-layout>
