<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title ?? 'Kelola Peserta Magang' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                                    <th scope="col" class="px-6 py-3">NIM/NISN</th>
                                    <th scope="col" class="px-6 py-3">Asal Sekolah/Kampus</th>
                                    <th scope="col" class="px-6 py-3">Proposal</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($interns as $intern)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $intern->name }}</td>
                                        <td class="px-6 py-4">{{ $intern->nim }}</td>
                                        <td class="px-6 py-4">{{ $intern->school }}</td>
                                        <td class="px-6 py-4">
                                            @if($intern->proposal_path)
                                                <a href="{{ asset('storage/' . $intern->proposal_path) }}" target="_blank" class="text-blue-600 hover:underline">Lihat PDF</a>
                                            @else
                                                <span class="text-gray-400">Tidak ada</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($intern->status == 'pending')
                                                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded border border-yellow-300">Pending</span>
                                            @elseif($intern->status == 'approved')
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-300">Aktif</span>
                                            @elseif($intern->status == 'rejected')
                                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-300">Ditolak</span>
                                            @else
                                                <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded border border-purple-300">Selesai</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 flex gap-2 justify-center">
                                            @if($intern->status == 'pending')
                                                <form action="{{ route('admin.interns.approve', $intern) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 focus:outline-none">Terima</button>
                                                </form>
                                                <form action="{{ route('admin.interns.reject', $intern) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 focus:outline-none">Tolak</button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-xs">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data pendaftar.</td>
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
