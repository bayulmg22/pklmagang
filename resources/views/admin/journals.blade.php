<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('Monitoring Jurnal Kegiatan') }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div class="content-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Aktivitas Harian Peserta</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Update Otomatis</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-500 uppercase tracking-widest bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Waktu & Tanggal</th>
                            <th class="px-6 py-4 font-bold">Nama Peserta</th>
                            <th class="px-6 py-4 font-bold w-1/3">Detail Aktivitas</th>
                            <th class="px-6 py-4 font-bold text-center">Dokumentasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($journalsGrouped as $date => $journals)
                            <tr class="bg-slate-50/50">
                                <td colspan="4" class="px-6 py-2 text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                    🗓️ {{ \Carbon\Carbon::parse($date)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            @foreach($journals as $journal)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4 text-slate-500 font-medium">
                                    {{ $journal->created_at->format('H:i') }} WIB
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $journal->user?->name ?? 'N/A' }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $journal->user?->school ?? '' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-slate-600 leading-relaxed text-xs">{{ $journal->activity }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center">
                                        @if($journal->photo_path)
                                            <a href="{{ asset('storage/' . $journal->photo_path) }}" target="_blank" class="block group">
                                                <div class="w-16 h-16 rounded-xl overflow-hidden border-2 border-white shadow-sm group-hover:shadow-md group-hover:scale-105 transition-all">
                                                    <img src="{{ asset('storage/' . $journal->photo_path) }}" class="w-full h-full object-cover">
                                                </div>
                                            </a>
                                        @else
                                            <span class="text-slate-300 italic text-[10px]">No Photo</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                    <p class="text-3xl mb-2">📝</p>
                                    <p class="text-sm font-medium">Belum ada jurnal aktivitas yang dikirimkan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
