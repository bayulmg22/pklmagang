<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-lg text-gray-800">Absensi Harian</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                ❌ {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                <ul class="list-disc pl-4 text-sm">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-4">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Jam: <span class="font-semibold text-blue-700">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i') }} WIB</span></p>
                </div>
                <a href="{{ route('intern.attendance.print') }}" target="_blank"
                   class="flex items-center gap-2 px-4 py-2 bg-gray-800 text-white rounded-xl text-sm font-semibold hover:bg-gray-700 transition">
                    🖨️ Cetak PDF
                </a>
            </div>

            @if($attendance)
                <!-- Sudah absen masuk -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4 flex items-center gap-3">
                    <span class="text-2xl">✅</span>
                    <div>
                        <p class="font-bold text-blue-800">Sudah Mencatat Kehadiran Hari Ini</p>
                        <p class="text-sm text-blue-600">
                            Status: <strong>{{ ucfirst($attendance->status) }}</strong>
                            @if($attendance->check_in_time) · Jam: {{ $attendance->check_in_time }} @endif
                            @if($attendance->keterangan) · Ket: {{ $attendance->keterangan }} @endif
                        </p>
                    </div>
                </div>

                @if(!$attendance->check_out_time)
                    <form action="{{ route('intern.attendance.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="type" value="check_out">
                        <button type="submit"
                            class="w-full py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-bold text-base hover:opacity-90 transition shadow">
                            🌇 Absen Pulang Sekarang (Min. 15:00 WIB)
                        </button>
                    </form>
                @else
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
                        <p class="font-bold text-green-700">✅ Absen Pulang Tercatat: {{ $attendance->check_out_time }}</p>
                        <p class="text-sm text-green-600 mt-1">Kehadiran hari ini sudah lengkap. Terima kasih!</p>
                    </div>
                @endif

            @else
                <!-- Form Absensi -->
                <form action="{{ route('intern.attendance.store') }}" method="POST" enctype="multipart/form-data" id="absenForm">
                    @csrf
                    <input type="hidden" name="type" value="check_in">

                    <!-- Pilih Status -->
                    <p class="text-sm font-semibold text-gray-700 mb-3">Pilih Keterangan Ketidakhadiran:</p>
                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="izin" class="sr-only peer" onchange="toggleKeterangan(this)">
                            <div class="border-2 border-gray-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 rounded-xl p-4 text-center transition">
                                <div class="text-3xl mb-1">📄</div>
                                <p class="font-bold text-gray-700 peer-checked:text-yellow-700">Izin</p>
                                <p class="text-xs text-gray-400">Ada keperluan/acara</p>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="status" value="sakit" class="sr-only peer" onchange="toggleKeterangan(this)">
                            <div class="border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-50 rounded-xl p-4 text-center transition">
                                <div class="text-3xl mb-1">🤒</div>
                                <p class="font-bold text-gray-700">Sakit</p>
                                <p class="text-xs text-gray-400">Tidak fit / sakit</p>
                            </div>
                        </label>
                    </div>

                    <!-- Keterangan -->
                    <div id="keteranganBox" class="hidden mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Keterangan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="keterangan" rows="3" placeholder="Contoh: Menghadiri acara pernikahan keluarga / demam sejak kemarin malam..."
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>

                        <label class="block text-sm font-semibold text-gray-700 mt-3 mb-2">
                            Upload Bukti (Surat Keterangan / Foto) <span class="text-gray-400 font-normal">— Opsional</span>
                        </label>
                        <input type="file" name="keterangan_file" accept=".jpg,.jpeg,.png,.pdf"
                            class="block w-full text-sm border border-gray-300 rounded-xl px-3 py-2 bg-gray-50 cursor-pointer">
                    </div>

                    <button type="submit" id="submitBtn" disabled
                        class="w-full py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-bold text-base hover:opacity-90 transition shadow disabled:opacity-40 disabled:cursor-not-allowed">
                        📤 Kirim Keterangan Ketidakhadiran
                    </button>
                </form>

                <p class="text-xs text-gray-400 text-center mt-3">Pilih salah satu status di atas untuk mengaktifkan form</p>
            @endif
        </div>

        <!-- Scan QR Info -->
        <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-4 flex items-start gap-3">
            <span class="text-2xl">📲</span>
            <div>
                <p class="font-semibold text-indigo-800 text-sm">Alternatif: Scan QR Code</p>
                <p class="text-xs text-indigo-600 mt-0.5">Tunjukkan <a href="{{ route('intern.card.print') }}" target="_blank" class="underline font-semibold">ID Card QR Code</a> Anda kepada Admin untuk di-scan sebagai absensi.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleKeterangan(el) {
            document.getElementById('keteranganBox').classList.remove('hidden');
            document.getElementById('submitBtn').removeAttribute('disabled');
            // update textarea placeholder based on status
            const ta = document.querySelector('textarea[name="keterangan"]');
            if (el.value === 'izin') {
                ta.placeholder = 'Jelaskan acara/keperluan Anda, misal: menghadiri wisuda kakak, rapat OSIS, dll...';
            } else {
                ta.placeholder = 'Jelaskan kondisi sakit Anda, misal: demam sejak tadi malam, diare, dll...';
            }
        }
    </script>
</x-app-layout>
