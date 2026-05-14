<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penilaian Akhir Magang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul class="list-disc pl-5 text-sm">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3">Peserta</th>
                                <th scope="col" class="px-6 py-3 text-center">Status</th>
                                <th scope="col" class="px-6 py-3 text-center">Nilai Rata-rata</th>
                                <th scope="col" class="px-6 py-3 text-center">Predikat</th>
                                <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($interns as $intern)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">{{ $intern->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $intern->nim }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($intern->status == 'finished')
                                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">Selesai Dinilai</span>
                                        @else
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">Aktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center font-bold">
                                        {{ $intern->evaluation ? $intern->evaluation->average : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($intern->evaluation)
                                            <span class="font-bold text-gray-800">{{ $intern->evaluation->predicate }}</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button onclick="document.getElementById('modal-{{ $intern->id }}').classList.remove('hidden')" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-xs font-semibold">
                                            {{ $intern->evaluation ? 'Edit Nilai' : 'Beri Nilai' }}
                                        </button>
                                    </td>
                                </tr>

                                <!-- Modal Form -->
                                <div id="modal-{{ $intern->id }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
                                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                                        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                                            <div class="absolute inset-0 bg-gray-500 opacity-75" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')"></div>
                                        </div>
                                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <form action="{{ route('admin.evaluations.store', $intern) }}" method="POST">
                                                @csrf
                                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Input Penilaian: {{ $intern->name }}</h3>
                                                    <div class="grid grid-cols-2 gap-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Kedisiplinan</label>
                                                            <input type="number" name="kedisiplinan" value="{{ $intern->evaluation->kedisiplinan ?? '' }}" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Tanggung Jawab</label>
                                                            <input type="number" name="tanggung_jawab" value="{{ $intern->evaluation->tanggung_jawab ?? '' }}" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Kerja Sama Tim</label>
                                                            <input type="number" name="kerja_sama" value="{{ $intern->evaluation->kerja_sama ?? '' }}" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Kreativitas</label>
                                                            <input type="number" name="kreativitas" value="{{ $intern->evaluation->kreativitas ?? '' }}" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Adaptasi</label>
                                                            <input type="number" name="kemampuan_beradaptasi" value="{{ $intern->evaluation->kemampuan_beradaptasi ?? '' }}" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Kualitas Hasil Kerja</label>
                                                            <input type="number" name="kualitas_hasil_kerja" value="{{ $intern->evaluation->kualitas_hasil_kerja ?? '' }}" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div class="col-span-2">
                                                            <label class="block text-sm font-medium text-gray-700">Penyusunan Laporan</label>
                                                            <input type="number" name="penyusunan_laporan" value="{{ $intern->evaluation->penyusunan_laporan ?? '' }}" min="0" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div class="col-span-2">
                                                            <label class="block text-sm font-medium text-gray-700">Komentar / Pesan Motivasi</label>
                                                            <textarea name="comments" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ $intern->evaluation->comments ?? '' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Simpan Nilai
                                                    </button>
                                                    <button type="button" onclick="document.getElementById('modal-{{ $intern->id }}').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                                        Batal
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada peserta aktif.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
