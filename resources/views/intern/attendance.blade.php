<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Laporan Kehadiran') }}
        </h2>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium shadow-sm">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-xl text-sm font-medium shadow-sm">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="content-card p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-slate-800">{{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}</h3>
                    <p class="text-sm text-slate-500 font-medium">Waktu Sistem: <span class="text-blue-600 font-bold">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }} WIB</span></p>
                </div>
                <a href="{{ route('intern.attendance.print') }}" target="_blank"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 text-white rounded-lg text-xs font-bold hover:bg-slate-700 transition shadow-sm">
                    🖨️ Cetak Rekap PDF
                </a>
            </div>

            @if($attendance)
                <div class="p-6 bg-slate-50 border border-slate-200 rounded-2xl flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-2xl border border-slate-100">✅</div>
                    <div>
                        <p class="text-sm font-bold text-slate-800 uppercase tracking-tight">Kehadiran Hari Ini Tercatat</p>
                        <p class="text-[11px] text-slate-500 font-medium mt-1">
                            Status: <span class="font-bold text-blue-600">{{ ucfirst($attendance->status) }}</span> 
                            @if($attendance->check_in_time) &bull; Jam: {{ $attendance->check_in_time }} @endif
                            @if($attendance->keterangan) &bull; Ket: {{ $attendance->keterangan }} @endif
                        </p>
                    </div>
                </div>

                @if(!$attendance->check_out_time)
                    <form action="{{ route('intern.attendance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="check_out">
                        <button type="submit"
                            class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition shadow-lg active:translate-y-0.5">
                            🌇 INPUT ABSEN PULANG (MIN. 15:00 WIB)
                        </button>
                    </form>
                @else
                    <div class="p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-center">
                        <p class="text-xs font-bold text-emerald-700 uppercase tracking-widest">✅ Aktivitas Hari Ini Selesai</p>
                        <p class="text-[10px] text-emerald-600 mt-1">Terima kasih, Anda telah mencatat jam pulang pada {{ $attendance->check_out_time }}.</p>
                    </div>
                @endif

            @else
                <form action="{{ route('intern.attendance.store') }}" method="POST" enctype="multipart/form-data" id="absenForm" class="space-y-6">
                    @csrf
                    <input type="hidden" name="type" value="check_in">

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-3 text-center">Pilih Status Ketidakhadiran</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="status" value="izin" class="sr-only peer" onchange="toggleKeterangan(this)">
                                <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl text-center transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50/50 group-hover:border-slate-200">
                                    <div class="text-3xl mb-2">📄</div>
                                    <p class="text-sm font-bold text-slate-700 peer-checked:text-blue-700">Izin</p>
                                    <p class="text-[10px] text-slate-400">Ada keperluan resmi</p>
                                </div>
                            </label>
                            <label class="relative cursor-pointer group">
                                <input type="radio" name="status" value="sakit" class="sr-only peer" onchange="toggleKeterangan(this)">
                                <div class="p-4 bg-white border-2 border-slate-100 rounded-2xl text-center transition-all peer-checked:border-rose-600 peer-checked:bg-rose-50/50 group-hover:border-slate-200">
                                    <div class="text-3xl mb-2">🤒</div>
                                    <p class="text-sm font-bold text-slate-700 peer-checked:text-rose-700">Sakit</p>
                                    <p class="text-[10px] text-slate-400">Kondisi kesehatan</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div id="keteranganBox" class="hidden space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Alasan / Keterangan Deskriptif <span class="text-rose-500">*</span></label>
                            <textarea name="keterangan" rows="3" 
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all"
                                placeholder="Jelaskan secara singkat..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Unggah Bukti Pendukung <span class="text-slate-400 font-normal text-xs">(Opsional)</span></label>
                            <input type="file" name="keterangan_file" accept=".jpg,.jpeg,.png,.pdf"
                                class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-slate-200 file:text-slate-700 hover:file:bg-slate-300 transition cursor-pointer border border-slate-200 rounded-xl p-1 bg-slate-50">
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" disabled
                        class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold text-sm hover:bg-slate-800 transition shadow-lg active:translate-y-0.5 disabled:opacity-30 disabled:cursor-not-allowed">
                        KIRIM LAPORAN KEHADIRAN
                    </button>
                </form>
            @endif
        </div>

        <!-- Info QR -->
        <div class="p-4 bg-blue-50 border border-blue-100 rounded-2xl flex items-start gap-3">
            <span class="text-xl">💡</span>
            <div>
                <p class="text-xs font-bold text-blue-800 uppercase tracking-tight">Info Scan QR</p>
                <p class="text-[11px] text-blue-600 font-medium leading-relaxed mt-0.5">Bagi peserta yang hadir di kantor, Anda tidak perlu mengisi form ini. Cukup tunjukkan <a href="{{ route('intern.card') }}" class="font-bold underline">ID Card QR Code</a> Anda kepada Admin untuk diverifikasi.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleKeterangan(el) {
            document.getElementById('keteranganBox').classList.remove('hidden');
            document.getElementById('submitBtn').removeAttribute('disabled');
            const ta = document.querySelector('textarea[name="keterangan"]');
            ta.placeholder = el.value === 'izin' 
                ? 'Contoh: Menghadiri urusan administrasi kampus / urusan keluarga mendesak...' 
                : 'Contoh: Sedang berobat ke dokter karena flu dan demam tinggi...';
            ta.focus();
        }
    </script>
</x-app-layout>
