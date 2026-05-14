<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-bold text-base text-blue-900">ID Card Magang</h2>
            <p class="text-xs text-teal-600">Lengkapi foto profil untuk mencetak kartu identitas</p>
        </div>
    </x-slot>

    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
            
            <!-- Left: Settings & Print -->
            <div class="md:col-span-7 space-y-6">
                <!-- Status Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-blue-100 p-6 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50 rounded-full -mr-16 -mt-16"></div>
                    <div class="relative z-10">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Instruksi Pencetakan</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Pastikan foto yang Anda unggah adalah foto resmi (setengah badan) dengan latar belakang polos. Kartu ini digunakan sebagai identitas resmi selama kegiatan magang di <span class="font-semibold text-blue-700">Dinas Sosial Kab. Lamongan</span>.
                        </p>
                    </div>
                </div>

                <!-- Form Upload -->
                <div class="bg-white rounded-3xl shadow-md border border-blue-100 p-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center text-xl">📸</div>
                        <h3 class="text-lg font-bold text-gray-800">Perbarui Foto Profil</h3>
                    </div>
                    
                    @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-50 border border-green-200 rounded-2xl flex items-center gap-2">
                            <span>✅</span> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('intern.card.photo') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="relative group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih File Foto (JPG/PNG, Max 2MB)</label>
                            <input type="file" name="photo" accept="image/*" 
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition cursor-pointer border border-dashed border-teal-300 rounded-2xl p-2 bg-teal-50/30" required>
                            @error('photo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-teal-600 to-blue-700 text-white rounded-2xl font-bold hover:shadow-lg hover:opacity-90 transition transform active:scale-[0.98]">
                            Simpan & Update Foto
                        </button>
                    </form>
                </div>

                <!-- Print Action -->
                <div class="bg-gradient-to-br from-blue-900 to-teal-800 rounded-3xl shadow-xl p-8 text-white">
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-xl font-black mb-2 tracking-tight">Siap Untuk Cetak?</h3>
                            <p class="text-blue-100 text-sm opacity-90">Unduh kartu dalam format PDF kualitas tinggi untuk dicetak sebagai ID Card fisik.</p>
                        </div>
                        <a href="{{ route('intern.card.print') }}" target="_blank" 
                           class="px-8 py-4 bg-white text-blue-900 rounded-2xl font-black text-base shadow-2xl hover:bg-blue-50 transition transform hover:-translate-y-1 active:translate-y-0">
                           🖨️ CETAK SEKARANG
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Live Preview -->
            <div class="md:col-span-5 flex justify-center">
                <div class="sticky top-6">
                    <p class="text-center text-xs font-bold text-blue-900 uppercase tracking-widest mb-4">Preview Kartu Digital</p>
                    
                    {{-- ID Card Design --}}
                    <div class="w-[300px] h-[480px] bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-gray-200 flex flex-col relative scale-95 origin-top">
                        <!-- Header Background -->
                        <div class="h-32 bg-gradient-to-br from-blue-700 to-teal-600 relative flex flex-col items-center justify-center text-white">
                            <div class="absolute -right-10 -top-10 w-32 h-32 bg-white/10 rounded-full"></div>
                            <img src="{{ asset('logo-dinsos.jpg') }}" class="h-10 w-auto bg-white rounded-lg p-1 shadow-md mb-2 z-10" alt="Logo">
                            <p class="font-black text-sm tracking-widest z-10">DINAS SOSIAL</p>
                            <p class="text-[10px] font-medium tracking-[0.2em] opacity-90 z-10 uppercase">Kabupaten Lamongan</p>
                        </div>

                        <!-- User Info Section -->
                        <div class="flex-1 flex flex-col items-center pt-8 px-6 text-center">
                            <!-- Photo Container -->
                            <div class="w-28 h-36 bg-gray-50 border-[6px] border-white shadow-xl rounded-2xl overflow-hidden mb-6 -mt-16 z-20 transition-transform hover:scale-105 duration-300">
                                @if(auth()->user()->photo_path)
                                    <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center bg-gray-100 text-gray-400">
                                        <span class="text-2xl mb-1">👤</span>
                                        <span class="text-[10px] font-bold">BELUM ADA FOTO</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Name & Details -->
                            <h2 class="text-lg font-black text-blue-950 leading-tight mb-1 uppercase">{{ auth()->user()->name }}</h2>
                            <p class="text-teal-600 font-bold text-xs tracking-wider mb-3">{{ auth()->user()->nim }}</p>
                            
                            <div class="w-full h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent mb-3"></div>
                            
                            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ auth()->user()->school }}</p>
                            <p class="text-[9px] font-black text-blue-700 mt-1 tracking-widest bg-blue-50 px-3 py-1 rounded-full inline-block">PESERTA MAGANG</p>

                            <!-- QR Code Section -->
                            <div class="mt-auto mb-10">
                                <div class="p-2 bg-white border-2 border-teal-50 rounded-2xl shadow-inner">
                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)->generate(auth()->user()->id . '-' . auth()->user()->nim) !!}
                                </div>
                                <p class="text-[8px] font-bold text-gray-400 mt-2 tracking-[0.3em] uppercase">SIMASOS QR CODE</p>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="h-8 bg-gradient-to-r from-blue-900 to-teal-800 flex items-center justify-center">
                            <span class="text-[9px] font-black text-white tracking-[0.4em] uppercase">DIGITAL PASS</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
