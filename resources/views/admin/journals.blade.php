<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jurnal Kegiatan Peserta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Waktu</th>
                                    <th scope="col" class="px-6 py-3">Nama Peserta</th>
                                    <th scope="col" class="px-6 py-3 w-1/2">Aktivitas</th>
                                    <th scope="col" class="px-6 py-3">Foto Bukti</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($journalsGrouped as $date => $journals)
                                    <tr class="bg-gray-100">
                                        <td colspan="4" class="px-6 py-2 font-bold text-gray-700">Tanggal: {{ $date }}</td>
                                    </tr>
                                    @foreach($journals as $journal)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $journal->created_at->format('H:i') }}
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $journal->user?->name ?? 'User Dihapus' }}</td>
                                        <td class="px-6 py-4">{{ $journal->activity }}</td>
                                        <td class="px-6 py-4">
                                            @if($journal->photo_path)
                                                <a href="{{ asset('storage/' . $journal->photo_path) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $journal->photo_path) }}" class="w-16 h-16 object-cover rounded shadow-sm border hover:scale-110 transition">
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data jurnal kegiatan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
