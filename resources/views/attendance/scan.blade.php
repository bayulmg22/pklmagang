<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-xl text-slate-800 leading-tight uppercase tracking-wider">
            {{ __('Presensi Kehadiran QR') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-12 px-4">
        <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-100/50 overflow-hidden border border-slate-100">
            <!-- Header Info -->
            <div class="bg-slate-900 p-8 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                
                <div class="relative z-10 space-y-4">
                    <div class="w-24 h-24 mx-auto bg-white rounded-3xl p-1 shadow-2xl overflow-hidden border border-white/10">
                        @if($user->photo_path)
                            <img src="{{ asset('storage/' . $user->photo_path) }}" class="w-full h-full object-cover rounded-2xl">
                        @else
                            <div class="w-full h-full bg-slate-50 flex items-center justify-center text-3xl text-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-slate-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-white text-lg font-black uppercase tracking-tight">{{ $user->name }}</h3>
                        <p class="text-blue-400 text-xs font-bold uppercase tracking-[0.2em] mt-1">{{ $user->nim }}</p>
                    </div>
                    <div class="inline-block px-3 py-1 bg-white/5 backdrop-blur-md border border-white/10 rounded-full text-[10px] text-white font-extrabold uppercase tracking-wider">
                        {{ $user->school }}
                    </div>
                </div>
            </div>

            <div class="p-8 space-y-8">
                <!-- Date and Time at the Top -->
                <div class="text-center bg-slate-50/50 p-4 rounded-2xl border border-slate-100">
                    <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-[0.2em]">Waktu Pindai</span>
                    <h3 class="text-3xl font-black text-slate-800 tabular-nums mt-0.5" id="live-clock">
                        {{ now()->format('H:i:s') }}
                    </h3>
                    <p class="text-[10px] font-bold text-slate-400 mt-0.5 uppercase tracking-wider">
                        {{ now()->locale('id')->translatedFormat('l, d F Y') }}
                    </p>
                </div>

                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-bold tracking-wide flex items-center gap-3">
                        <div class="p-1 bg-emerald-100 text-emerald-600 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                        </div>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-xs font-bold tracking-wide flex items-center gap-3">
                        <div class="p-1 bg-rose-100 text-rose-600 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($attendance && $attendance->status === 'sakit')
                    <div class="text-center py-6 bg-rose-50 rounded-2xl border border-rose-100">
                        <div class="text-3xl mb-2">💊</div>
                        <h4 class="font-extrabold text-rose-800 uppercase tracking-widest text-xs">Status: Sakit</h4>
                        <p class="text-[10px] text-rose-500 font-medium mt-1 leading-relaxed px-6">Peserta terdaftar dengan keterangan sakit hari ini.</p>
                    </div>
                @endif

                <!-- Fixed dynamic route instead of hardcoded IP -->
                <form action="{{ route('attendance.store', $user) }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 text-center">Tentukan Status Kehadiran</span>
                        <div class="grid grid-cols-3 gap-3">
                            <!-- Hadir -->
                            <label class="cursor-pointer group">
                                <input type="radio" name="status" value="hadir" class="hidden peer" checked>
                                <div class="p-4 rounded-2xl border border-slate-100 bg-slate-50 text-center transition-all duration-200 peer-checked:border-blue-600 peer-checked:bg-blue-50/20 group-hover:bg-white shadow-sm">
                                    <div class="w-8 h-8 mx-auto text-blue-600 bg-blue-50 rounded-lg flex items-center justify-center mb-2 peer-checked:bg-blue-100/70">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    </div>
                                    <div class="text-[10px] font-extrabold uppercase text-slate-600 peer-checked:text-blue-700 tracking-wider">Hadir</div>
                                </div>
                            </label>

                            <!-- Izin -->
                            <label class="cursor-pointer group">
                                <input type="radio" name="status" value="izin" class="hidden peer">
                                <div class="p-4 rounded-2xl border border-slate-100 bg-slate-50 text-center transition-all duration-200 peer-checked:border-amber-600 peer-checked:bg-amber-50/20 group-hover:bg-white shadow-sm">
                                    <div class="w-8 h-8 mx-auto text-amber-600 bg-amber-50 rounded-lg flex items-center justify-center mb-2 peer-checked:bg-amber-100/70">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div class="text-[10px] font-extrabold uppercase text-slate-600 peer-checked:text-amber-700 tracking-wider">Izin</div>
                                </div>
                            </label>

                            <!-- Sakit -->
                            <label class="cursor-pointer group">
                                <input type="radio" name="status" value="sakit" class="hidden peer">
                                <div class="p-4 rounded-2xl border border-slate-100 bg-slate-50 text-center transition-all duration-200 peer-checked:border-rose-600 peer-checked:bg-rose-50/20 group-hover:bg-white shadow-sm">
                                    <div class="w-8 h-8 mx-auto text-rose-600 bg-rose-50 rounded-lg flex items-center justify-center mb-2 peer-checked:bg-rose-100/70">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z" />
                                        </svg>
                                    </div>
                                    <div class="text-[10px] font-extrabold uppercase text-slate-600 peer-checked:text-rose-700 tracking-wider">Sakit</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    @php
                        $isLate = now()->hour >= 9 && now()->hour < 15;
                    @endphp

                    @if($isLate)
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-center gap-3">
                            <span class="text-xl">⏰</span>
                            <div>
                                <div class="text-[10px] font-black uppercase text-amber-700 tracking-widest">Terlambat Otomatis</div>
                                <p class="text-[9px] text-amber-600 font-bold">Waktu pendaftaran masuk sudah melewati batas toleransi jam 09:00 pagi.</p>
                            </div>
                        </div>
                    @endif

                    <div id="notesField" class="hidden">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Keterangan / Alasan Khusus</label>
                        <textarea name="keterangan" rows="2" 
                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-xs font-semibold text-slate-700 focus:bg-white focus:border-blue-600 focus:outline-none transition-all resize-none shadow-sm" 
                            placeholder="Tulis alasan jika diperlukan..."></textarea>
                    </div>

                    <button type="submit" name="action" value="check_in" 
                        class="w-full bg-slate-900 text-white font-extrabold py-4.5 rounded-2xl shadow-md hover:bg-blue-600 transition-all duration-200 uppercase tracking-widest text-[10px] flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                        </svg>
                        Simpan Perubahan Kehadiran
                    </button>

                    <!-- Separate Check-out Button (Only if Hadir & Not Checked Out) -->
                    @php
                        $hasActiveHadir = \App\Models\Attendance::where('user_id', $user->id)
                            ->where('date', now()->toDateString())
                            ->where('status', 'hadir')
                            ->whereNull('check_out_time')
                            ->exists();
                    @endphp

                    @if($hasActiveHadir)
                        <div class="relative py-2">
                            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-100"></div></div>
                            <div class="relative flex justify-center text-[8px] font-black text-slate-300 uppercase tracking-[0.3em] bg-white px-4">Menu Kepulangan</div>
                        </div>
                        <button type="submit" name="action" value="check_out" 
                            class="w-full bg-rose-500 text-white font-extrabold py-4.5 rounded-2xl shadow-md hover:bg-rose-600 transition-all duration-200 uppercase tracking-widest text-[10px] flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            Absen Pulang Peserta
                        </button>
                    @endif
                </form>

                <div class="pt-6 border-t border-slate-100 text-center">
                    <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest">Sistem Absensi Digital SIMASOS</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Real-time Clock
        setInterval(() => {
            const clockEl = document.getElementById('live-clock');
            if (clockEl) {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                clockEl.textContent = `${hours}:${minutes}:${seconds}`;
            }
        }, 1000);

        // Toggle Notes Field based on status selection
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                const notesField = document.getElementById('notesField');
                if (notesField) {
                    if (e.target.value !== 'hadir') {
                        notesField.classList.remove('hidden');
                    } else {
                        notesField.classList.add('hidden');
                    }
                }
            });
        });
    </script>
</x-app-layout>
