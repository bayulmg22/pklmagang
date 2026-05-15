<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-slate-800 leading-tight uppercase tracking-widest">
            {{ __('Presensi Kehadiran QR') }}
        </h2>
    </x-slot>

    <div class="max-w-xl mx-auto py-12 px-4">
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-slate-200/50 overflow-hidden border border-slate-100">
            <!-- Header Info -->
            <div class="bg-slate-900 p-10 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-600/10 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="w-24 h-24 mx-auto bg-white rounded-3xl p-1 shadow-2xl mb-6 overflow-hidden">
                        @if($user->photo_path)
                            <img src="{{ asset('storage/' . $user->photo_path) }}" class="w-full h-full object-cover rounded-2xl">
                        @else
                            <div class="w-full h-full bg-slate-50 flex items-center justify-center text-3xl text-slate-200">👤</div>
                        @endif
                    </div>
                    <h3 class="text-white text-xl font-black uppercase tracking-tight">{{ $user->name }}</h3>
                    <p class="text-blue-400 text-xs font-bold uppercase tracking-[0.2em] mt-2">{{ $user->nim }}</p>
                    <div class="mt-4 inline-block px-4 py-1.5 bg-white/5 backdrop-blur-md border border-white/10 rounded-full text-[10px] text-white font-black uppercase tracking-widest">
                        {{ $user->school }}
                    </div>
                </div>
            </div>

            <div class="p-10">
                <!-- Date and Time at the Top -->
                <div class="text-center mb-10 -mt-5">
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">Waktu Absensi</div>
                    <div class="text-4xl font-black text-slate-900 tabular-nums">{{ now()->format('H:i') }}</div>
                    <div class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest">{{ now()->locale('id')->translatedFormat('l, d F Y') }}</div>
                </div>

                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl text-xs font-black uppercase tracking-wide flex items-center gap-3">
                        <span class="text-lg">✅</span> {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-8 p-4 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl text-xs font-black uppercase tracking-wide flex items-center gap-3">
                        <span class="text-lg">⚠️</span> {{ session('error') }}
                    </div>
                @endif

                <form action="http://192.168.1.9:8000/absensi/{{ $user->id }}" method="POST" class="space-y-8">
                    @csrf
                    
                    @if(!$attendance || ($attendance && !$attendance->check_out_time))
                        <div class="grid grid-cols-3 gap-4">
                            @foreach(['hadir' => '🎯', 'izin' => '📝', 'sakit' => '💊'] as $status => $emoji)
                                <label class="cursor-pointer group">
                                    <input type="radio" name="status" value="{{ $status }}" class="hidden peer" {{ ($attendance && $attendance->status == $status) ? 'checked' : ($status == 'hadir' ? 'checked' : '') }}>
                                    <div class="p-4 rounded-3xl border-2 border-slate-50 bg-slate-50 text-center transition-all peer-checked:border-blue-600 peer-checked:bg-white peer-checked:shadow-xl peer-checked:shadow-blue-600/10 group-hover:bg-white">
                                        <div class="text-2xl mb-1">{{ $emoji }}</div>
                                        <div class="text-[10px] font-black uppercase text-slate-500 peer-checked:text-blue-600 tracking-tighter">{{ $status }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @php
                            $isLate = now()->hour >= 9 && now()->hour < 15;
                        @endphp

                        @if($isLate && (!$attendance || ($attendance && $attendance->status == 'hadir')))
                            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 space-y-3">
                                <div class="flex items-center gap-2 text-amber-700">
                                    <span class="text-sm">⏰</span>
                                    <span class="text-[10px] font-black uppercase tracking-widest">Peringatan Terlambat</span>
                                </div>
                                <p class="text-[10px] text-amber-600 font-bold leading-relaxed">Saat ini sudah melewati jam 09:00. Harap masukkan alasan keterlambatan Anda di bawah ini.</p>
                                <textarea name="keterangan" rows="3" class="w-full bg-white border-0 rounded-xl px-4 py-3 text-sm font-bold focus:ring-2 focus:ring-amber-500 outline-none shadow-sm" placeholder="Contoh: Terjebak macet, ban bocor, dsb..."></textarea>
                            </div>
                        @else
                            <div id="notesField" class="hidden">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 ml-1">Keterangan (Opsional)</label>
                                <textarea name="keterangan" rows="3" class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl px-5 py-4 text-sm font-bold text-slate-700 focus:bg-white focus:border-blue-600 outline-none transition-all resize-none shadow-inner" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                            </div>
                        @endif

                        <button type="submit" class="w-full bg-slate-900 text-white font-black py-5 rounded-[1.5rem] shadow-xl shadow-slate-900/20 hover:bg-blue-600 transition-all uppercase tracking-[0.2em] text-xs flex items-center justify-center gap-3">
                            @if($attendance)
                                <span>🚪 ABSEN PULANG</span>
                            @else
                                <span>✅ KONFIRMASI HADIR</span>
                            @endif
                        </button>
                    @else
                        <div class="text-center py-10 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                            <div class="text-4xl mb-4">🏠</div>
                            <h4 class="font-black text-slate-800 uppercase tracking-widest text-sm">Selesai Untuk Hari Ini</h4>
                            <p class="text-[10px] text-slate-400 font-bold mt-2">Anda sudah melakukan absen masuk dan pulang.</p>
                        </div>
                    @endif
                </form>

                <div class="mt-10 pt-10 border-t border-slate-50 text-center">
                    <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Sistem Absensi Digital SIMASOS</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="status"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                const notesField = document.getElementById('notesField');
                if (notesField) {
                    if (e.target.value !== 'hadir') {
                        notesField.classList.remove('hidden');
                    } else {
                        @if(!$isLate)
                            notesField.classList.add('hidden');
                        @endif
                    }
                }
            });
        });
    </script>
</x-app-layout>
