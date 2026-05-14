<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ $title ?? 'Manajemen Peserta Magang' }}
        </h2>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="content-card overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider">Daftar Pendaftar & Peserta</h3>
                <span class="text-xs text-slate-400">Total: {{ count($interns) }} Orang</span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-[11px] text-slate-500 uppercase tracking-widest bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 font-bold">Nama & Instansi</th>
                            <th class="px-6 py-4 font-bold">ID / NIM</th>
                            <th class="px-6 py-4 font-bold">Proposal</th>
                            <th class="px-6 py-4 font-bold">Status</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($interns as $intern)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-slate-800">{{ $intern->name }}</div>
                                    <div class="text-[10px] text-slate-400 font-medium">{{ $intern->school }}</div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 font-medium">{{ $intern->nim }}</td>
                                <td class="px-6 py-4">
                                    @if($intern->proposal_path)
                                        <a href="{{ asset('storage/' . $intern->proposal_path) }}" target="_blank" class="inline-flex items-center gap-1 text-blue-600 font-bold hover:text-blue-800 underline decoration-blue-200 underline-offset-4">
                                            <span>📄</span> PDF
                                        </a>
                                    @else
                                        <span class="text-slate-300 italic">N/A</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($intern->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-200 uppercase tracking-tighter">Pending</span>
                                    @elseif($intern->status == 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 uppercase tracking-tighter">Aktif</span>
                                    @elseif($intern->status == 'rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-200 uppercase tracking-tighter">Ditolak</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-200 uppercase tracking-tighter">Selesai</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        @if($intern->status == 'pending')
                                            <form action="{{ route('admin.interns.approve', $intern) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-emerald-600 text-white text-[10px] font-bold rounded-lg hover:bg-emerald-700 transition shadow-sm">TERIMA</button>
                                            </form>
                                            <form action="{{ route('admin.interns.reject', $intern) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-3 py-1.5 bg-white border border-rose-200 text-rose-600 text-[10px] font-bold rounded-lg hover:bg-rose-50 transition">TOLAK</button>
                                            </form>
                                        @else
                                            <span class="text-slate-300 text-[10px] font-bold">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="text-slate-300 text-4xl mb-2">📁</div>
                                    <p class="text-slate-400 text-sm font-medium">Belum ada data pendaftar magang.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
