<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">
            {{ __('ID Card Magang') }}
        </h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Column: Settings -->
        <div class="lg:col-span-7 space-y-6">
            <div class="content-card p-6">
                <h3 class="font-bold text-slate-800 mb-4">Pengaturan Kartu</h3>
                <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                    Unggah foto profil terbaru Anda untuk dicetak pada kartu magang. Pastikan wajah terlihat jelas dengan pencahayaan yang cukup.
                </p>

                @if(session('success'))
                    <div class="p-4 mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('intern.card.photo') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Pilih File Foto (Maks 2MB)</label>
                        <input type="file" name="photo" accept="image/*" 
                            class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition cursor-pointer border border-slate-200 rounded-lg p-1 bg-slate-50" required>
                        @error('photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-slate-900 text-white rounded-lg text-sm font-bold hover:bg-slate-800 transition shadow-sm">
                        Simpan Perubahan Foto
                    </button>
                </form>
            </div>

            <div class="content-card p-8 bg-blue-600 text-white border-0 shadow-lg shadow-blue-200">
                <h4 class="text-xl font-bold mb-2">Cetak Kartu Fisik</h4>
                <p class="text-blue-100 text-sm mb-6 leading-relaxed">Kartu magang Anda dapat diunduh dalam format PDF. Kartu ini digunakan untuk identitas resmi dan scan kehadiran di kantor Dinas Sosial.</p>
                <a href="{{ route('intern.card.print') }}" target="_blank" 
                   class="inline-flex items-center gap-2 px-8 py-3 bg-white text-blue-600 rounded-xl font-bold text-sm shadow-xl hover:bg-blue-50 transition active:translate-y-0.5">
                    🖨️ Cetak ID Card (PDF)
                </a>
            </div>
        </div>

        <!-- Right Column: Card Preview -->
        <div class="lg:col-span-5 flex flex-col items-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Preview Kartu Digital</p>
            
            {{-- Professional ID Card Layout --}}
            <div class="w-[280px] h-[440px] bg-white rounded-2xl shadow-2xl border border-slate-200 flex flex-col overflow-hidden relative">
                <!-- Blue Header Banner -->
                <div class="h-28 bg-blue-600 flex flex-col items-center justify-center text-center p-4">
                    <img src="{{ asset('logo-dinsos.jpg') }}" class="h-10 w-auto bg-white rounded p-1 mb-2 shadow-sm" alt="Logo">
                    <h5 class="text-white font-bold text-sm tracking-wide">DINAS SOSIAL</h5>
                    <p class="text-blue-200 text-[9px] font-bold uppercase tracking-widest">Kabupaten Lamongan</p>
                </div>

                <!-- Profile Section -->
                <div class="flex-1 flex flex-col items-center px-4 pt-10 text-center bg-slate-50/30">
                    <!-- Photo Box -->
                    <div class="w-28 h-36 bg-white border-4 border-white shadow-xl rounded-lg overflow-hidden -mt-20 z-10">
                        @if(auth()->user()->photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                👤
                            </div>
                        @endif
                    </div>

                    <!-- Name & ID -->
                    <div class="mt-6">
                        <h2 class="text-lg font-bold text-slate-800 leading-tight uppercase">{{ auth()->user()->name }}</h2>
                        <p class="text-blue-600 font-bold text-sm mt-1 tracking-wider">{{ auth()->user()->nim }}</p>
                        <div class="w-12 h-1 bg-blue-600 mx-auto my-3 rounded-full"></div>
                        <p class="text-[10px] font-bold text-slate-500 uppercase">{{ auth()->user()->school }}</p>
                        <p class="text-[9px] font-bold text-slate-400 mt-0.5 tracking-widest bg-slate-100 px-3 py-1 rounded-full inline-block">PESERTA MAGANG</p>
                    </div>

                    <!-- QR Area -->
                    <div class="mt-auto mb-8 flex flex-col items-center">
                        <div class="p-1.5 bg-white border border-slate-100 shadow-sm rounded-lg">
                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)->generate(auth()->user()->id . '-' . auth()->user()->nim) !!}
                        </div>
                        <p class="text-[8px] font-bold text-slate-300 mt-2 tracking-[0.2em] uppercase">SIMASOS ID PASS</p>
                    </div>
                </div>

                <!-- Card Footer Bar -->
                <div class="h-6 bg-slate-900 flex items-center justify-center">
                    <span class="text-[8px] font-bold text-slate-400 tracking-[0.3em] uppercase">Digital Identification System</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
