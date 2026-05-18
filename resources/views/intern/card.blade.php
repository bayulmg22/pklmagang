<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight">{{ __('ID Card Magang') }}</h2>
            <p class="text-xs text-slate-500 font-medium mt-1">Kelola foto profil dan cetak kartu identitas resmi peserta magang.</p>
        </div>
    </x-slot>
    <style>
        .perspective-1000{perspective:1000px}.transform-style-3d{transform-style:preserve-3d}.backface-hidden{backface-visibility:hidden}.rotate-y-180{transform:rotateY(180deg)}.group:hover .flip-inner{transform:rotateY(180deg)}.flip-inner{transition:transform .75s cubic-bezier(.4,.2,.2,1)}
    </style>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            {{-- Left: Upload & Print --}}
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white border border-slate-100 rounded-3xl shadow-xl p-6 md:p-8 space-y-5">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-red-50 text-red-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"/></svg>
                        </div>
                        <div><h3 class="font-extrabold text-slate-800 text-base">Foto Profil Kartu</h3><p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Personalisasi ID Card</p></div>
                    </div>
                    @if(session('success'))
                    <div class="p-3 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded-r-xl text-xs font-semibold flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>{{ session('success') }}
                    </div>
                    @endif
                    <form id="photoForm" action="{{ route('intern.card.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="relative group/u">
                            <input id="photoInput" type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewAndSubmit(this)">
                            <div class="w-full bg-slate-50 border-2 border-dashed border-slate-200 group-hover/u:border-red-400 rounded-2xl p-6 flex flex-col items-center text-center transition-all">
                                <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-slate-400 group-hover/u:text-red-500 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"/></svg>
                                </div>
                                <p id="file_name" class="text-xs font-black text-slate-600">Klik untuk pilih foto</p>
                                <p class="text-[9px] text-slate-400 mt-1">JPG/PNG, Maks 2MB</p>
                            </div>
                        </div>
                        @error('photo')<p class="text-rose-600 text-xs font-bold mt-2">{{ $message }}</p>@enderror
                    </form>
                </div>
                <div class="bg-gradient-to-br from-red-700 to-red-900 shadow-xl rounded-3xl p-6 md:p-8 relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-36 h-36 bg-white/5 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="relative z-10 space-y-4">
                        <div><h4 class="text-lg font-black text-white">Unduh Kartu Cetak</h4><p class="text-red-200 text-xs font-semibold mt-1">PDF resolusi tinggi dua sisi, 100% sesuai pratinjau.</p></div>
                        <button type="button" onclick="printIDCard()" class="w-full flex items-center justify-center gap-2 py-3.5 bg-white text-red-700 rounded-2xl font-bold text-xs tracking-wider uppercase shadow-lg hover:-translate-y-0.5 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                            Cetak PDF Sesuai Preview
                        </button>
                    </div>
                </div>

                {{-- Live Card Color Customizer --}}
                <div class="bg-white border border-slate-100 rounded-3xl shadow-xl p-6 md:p-8 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-rose-50 text-rose-600 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9.53 16.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Zm0 0a15.998 15.998 0 0 0 3.388-1.62m-3.388 1.62 1.942-1.942m9 9-.288-.288a1.86 1.86 0 0 0-2.63 0l-4.5 4.5a1.86 1.86 0 0 0 0 2.63l.288.288a1.86 1.86 0 0 0 2.63 0l4.5-4.5a1.86 1.86 0 0 0 0-2.63Zm-4.72-4.72-1.942 1.942m1.942-1.942a15.999 15.999 0 0 0 3.387-1.62M14.53 9.122a3 3 0 0 0-5.78 1.128 2.25 2.25 0 0 1-2.4 2.245 4.5 4.5 0 0 0 8.4-2.245c0-.399-.078-.78-.22-1.128Z"/></svg>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-slate-800 text-base">Warna Latar Kartu</h3>
                            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-0.5">Kustomisasi Live</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2.5">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pilih Preset Gradien:</label>
                        <div class="grid grid-cols-5 gap-2" id="gradientPresets">
                            <!-- Maroon/Red -->
                            <button type="button" class="w-full aspect-square rounded-xl border-2 border-red-500 hover:scale-105 active:scale-95 transition-all shadow-sm focus:outline-none" style="background: linear-gradient(160deg,#7f1d1d 0%,#991b1b 30%,#b91c1c 60%,#dc2626 100%);" onclick="changeCardBackground('linear-gradient(160deg,#7f1d1d 0%,#991b1b 30%,#b91c1c 60%,#dc2626 100%)', this)"></button>
                            <!-- Emerald/Green -->
                            <button type="button" class="w-full aspect-square rounded-xl border-2 border-transparent hover:scale-105 active:scale-95 transition-all shadow-sm focus:outline-none" style="background: linear-gradient(160deg,#064e3b 0%,#047857 50%,#10b981 100%);" onclick="changeCardBackground('linear-gradient(160deg,#064e3b 0%,#047857 50%,#10b981 100%)', this)"></button>
                            <!-- Violet/Purple -->
                            <button type="button" class="w-full aspect-square rounded-xl border-2 border-transparent hover:scale-105 active:scale-95 transition-all shadow-sm focus:outline-none" style="background: linear-gradient(160deg,#3b0764 0%,#581c87 50%,#8b5cf6 100%);" onclick="changeCardBackground('linear-gradient(160deg,#3b0764 0%,#581c87 50%,#8b5cf6 100%)', this)"></button>
                            <!-- Dark/Slate -->
                            <button type="button" class="w-full aspect-square rounded-xl border-2 border-transparent hover:scale-105 active:scale-95 transition-all shadow-sm focus:outline-none" style="background: linear-gradient(160deg,#0f172a 0%,#1e293b 50%,#475569 100%);" onclick="changeCardBackground('linear-gradient(160deg,#0f172a 0%,#1e293b 50%,#475569 100%)', this)"></button>
                            <!-- Sunset Amber -->
                            <button type="button" class="w-full aspect-square rounded-xl border-2 border-transparent hover:scale-105 active:scale-95 transition-all shadow-sm focus:outline-none" style="background: linear-gradient(160deg,#78350f 0%,#d97706 50%,#f59e0b 100%);" onclick="changeCardBackground('linear-gradient(160deg,#78350f 0%,#d97706 50%,#f59e0b 100%)', this)"></button>
                        </div>
                    </div>

                    <div class="w-full h-px bg-slate-100 my-1"></div>

                    <div class="flex items-center justify-between gap-4 pt-1">
                        <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Atau Warna Custom:</label>
                        <input type="color" id="customColorPicker" class="w-10 h-10 rounded-xl border border-slate-200 cursor-pointer overflow-hidden p-0 bg-transparent" oninput="changeCardBackground(this.value, null)" value="#b91c1c">
                    </div>
                </div>
            </div>

            {{-- Right: Card Preview --}}
            <div class="lg:col-span-7 flex flex-col items-center space-y-5">
                <div class="text-center">
                    <span class="inline-block px-3 py-1 bg-red-50 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-100">Pratinjau Kartu</span>
                    <p class="text-xs text-slate-400 mt-2 font-semibold">Arahkan kursor untuk melihat sisi belakang</p>
                </div>
                <div id="card-preview-container" class="perspective-1000 w-[320px] h-[500px] mx-auto group cursor-pointer">
                    <div class="w-full h-full relative transform-style-3d flip-inner">
                        {{-- FRONT --}}
                        <div class="absolute inset-0 backface-hidden rounded-[1.5rem] shadow-2xl font-sans bg-slate-800 p-2.5">
                            {{-- Lanyard clip --}}
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-16 h-5 bg-slate-700 rounded-b-lg z-30 flex items-end justify-center pb-1"><div class="w-6 h-1.5 bg-slate-600 rounded-full"></div></div>
                            {{-- Inner card --}}
                            <div class="relative w-full h-full rounded-xl overflow-hidden card-bg-element" style="background:linear-gradient(160deg,#7f1d1d 0%,#991b1b 30%,#b91c1c 60%,#dc2626 100%);">
                                {{-- Decorative pattern --}}
                                <div class="absolute inset-0 opacity-10 z-0" style="background-image:repeating-linear-gradient(45deg,transparent,transparent 20px,rgba(255,255,255,0.05) 20px,rgba(255,255,255,0.05) 22px);"></div>
                                {{-- School name badge top-left --}}
                                <div class="absolute top-3.5 left-3.5 z-20 flex items-center bg-white/20 backdrop-blur-md px-3 py-1 rounded-full border border-white/10 shadow-sm max-w-[300px]">
                                    <span class="text-[11px] font-black text-white uppercase tracking-wider truncate">{{ auth()->user()->school }}</span>
                                </div>
                                {{-- Vertical text right side: PESERTA MAGANG --}}
                                <div class="absolute right-2 top-1/2 -translate-y-1/2 z-20 flex flex-col items-center gap-1">
                                    <div class="text-white/90 font-black text-[30px] uppercase tracking-[0.3em] leading-none" style="writing-mode:vertical-rl;text-orientation:mixed;">MAGANG</div>
                                </div>
                                {{-- Chevron arrows decoration --}}
                                <div class="absolute right-8 top-8 z-10 flex flex-col gap-0.5 opacity-30">
                                    <span class="text-white [font-size:100px] font-black">›››</span>
                                    <span class="text-white [font-size:100px] font-black">›››</span>
                                    <span class="text-white [font-size:100px] font-black">›››</span>
                                </div>
                                {{-- Large Photo area --}}
                                <div class="absolute top-12 left-3 right-10 bottom-16 z-10 rounded-lg overflow-hidden border-2 border-white/20 shadow-xxl bg-slate-00">
                                    @if(auth()->user()->photo_path)
                                        <img id="cardPhotoPreview" src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">
                                    @else
                                        <img id="cardPhotoPreview" class="w-full h-full object-cover hidden">
                                        <div id="cardPhotoPlaceholder" class="w-full h-full flex flex-col items-center justify-center text-slate-400 bg-slate-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                                            <span class="text-[8px] font-bold mt-1 uppercase tracking-wider">Upload Foto</span>
                                        </div>
                                    @endif
                                </div>
                                {{-- Name bar bottom --}}
                                <div class="absolute bottom-0 inset-x-0 z-20 bg-slate-900/90 backdrop-blur-sm px-4 py-4 flex items-center justify-between">
                                    <h3 class="text-white [font-size:20px] font-black text-sm uppercase tracking-tight truncate max-w-[300px]">{{ auth()->user()->name }}</h3>
                                    <div class="flex items-center gap-1 flex-shrink-0">
                                        <div class="w-1.5 h-1.5 bg-red-500 rounded-full"></div>
                                        <div class="w-1.5 h-1.5 bg-white/50 rounded-full"></div>
                                        <div class="w-1.5 h-1.5 bg-white/30 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- BACK --}}
                        <div class="absolute inset-0 backface-hidden rotate-y-180 rounded-[1.5rem] shadow-2xl font-sans bg-slate-800 p-2.5">
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-16 h-5 bg-slate-700 rounded-b-lg z-30 flex items-end justify-center pb-1"><div class="w-6 h-1.5 bg-slate-600 rounded-full"></div></div>
                            <div class="relative w-full h-full rounded-xl overflow-hidden flex flex-col items-center justify-between py-5 px-5 card-bg-element" style="background:linear-gradient(160deg,#7f1d1d 0%,#991b1b 30%,#b91c1c 60%,#dc2626 100%);">
                                <div class="absolute inset-0 opacity-10 z-0" style="background-image:repeating-linear-gradient(45deg,transparent,transparent 20px,rgba(255,255,255,0.05) 20px,rgba(255,255,255,0.05) 22px);"></div>
                                {{-- SCAN ME Heading top --}}
                                <div class="relative z-20 flex items-center justify-center mt-2">
                                    <span class="text-white font-black text-sm tracking-[0.3em] uppercase leading-none bg-white/10 px-4 py-1.5 rounded-full border border-white/10">SCAN ME</span>
                                </div>
                                {{-- QR Code --}}
                                <div class="relative z-20 p-3.5 bg-white/95 rounded-2xl shadow-xl mt-2">
                                    <div class="absolute -top-1 -left-1 w-3.5 h-3.5 border-t-2 border-l-2 border-red-400 rounded-tl"></div>
                                    <div class="absolute -top-1 -right-1 w-3.5 h-3.5 border-t-2 border-r-2 border-red-400 rounded-tr"></div>
                                    <div class="absolute -bottom-1 -left-1 w-3.5 h-3.5 border-b-2 border-l-2 border-red-400 rounded-bl"></div>
                                    <div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 border-b-2 border-r-2 border-red-400 rounded-br"></div>
                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate(route('attendance.scan', auth()->user())) !!}
                                </div>
                                {{-- Info rows --}}
                                <div class="relative z-20 w-full space-y-1.5 mt-2">
                                    <div class="bg-white/10 backdrop-blur border border-white/10 px-3.5 py-2 rounded-xl flex justify-between items-center"><span class="text-[8px] font-bold text-white/60 uppercase tracking-wider">Nama</span><span class="text-[9px] font-black text-white uppercase truncate max-w-[140px]">{{ auth()->user()->name }}</span></div>
                                    <div class="bg-white/10 backdrop-blur border border-white/10 px-3.5 py-2 rounded-xl flex justify-between items-center"><span class="text-[8px] font-bold text-white/60 uppercase tracking-wider">NIM</span><span class="text-[9px] font-black text-white uppercase">{{ auth()->user()->nim }}</span></div>
                                    <div class="bg-white/10 backdrop-blur border border-white/10 px-3.5 py-2 rounded-xl flex justify-between items-center"><span class="text-[8px] font-bold text-white/60 uppercase tracking-wider">Jurusan</span><span class="text-[9px] font-black text-yellow-300 uppercase truncate max-w-[140px]">{{ auth()->user()->major ?? '-' }}</span></div>
                                </div>
                                <p class="relative z-20 text-[7px] text-white/40 text-center font-medium mt-1">Kartu pengenal resmi peserta magang Dinas Sosial Kab. Lamongan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Print staging zone --}}
    <div class="fixed" style="left:5000px;top:0;z-index:-9999;width:320px;height:1000px;pointer-events:none;overflow:hidden;">
        <div id="printable-card-area" style="width:320px;">
            {{-- Front --}}
            <div class="relative w-[320px] h-[500px] font-sans bg-slate-800 p-2.5" style="border-radius:1.5rem;overflow:hidden;">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-16 h-5 bg-slate-700 rounded-b-lg z-30 flex items-end justify-center pb-1"><div class="w-6 h-1.5 bg-slate-600 rounded-full"></div></div>
                <div class="relative w-full h-full rounded-xl overflow-hidden card-bg-element" style="background:linear-gradient(160deg,#7f1d1d 0%,#991b1b 30%,#b91c1c 60%,#dc2626 100%);">
                    <div class="absolute inset-0 opacity-10" style="background-image:repeating-linear-gradient(45deg,transparent,transparent 20px,rgba(255,255,255,0.05) 20px,rgba(255,255,255,0.05) 22px);"></div>
                    {{-- School name badge top-left --}}
                    <div class="absolute top-3.5 left-3.5 z-20 flex items-center bg-white/20 px-3 py-1 rounded-full border border-white/10 max-w-[170px]">
                        <span class="text-[7.5px] font-black text-white uppercase tracking-wider truncate">{{ auth()->user()->school }}</span>
                    </div>
                    <div class="absolute right-2 top-1/2 -translate-y-1/2 z-20"><div class="text-white/90 font-black text-[11px] uppercase tracking-[0.3em] leading-none" style="writing-mode:vertical-rl;">Peserta Magang</div></div>
                    <div class="absolute right-8 top-8 z-10 flex flex-col gap-0.5 opacity-30"><span class="text-white text-sm font-black">›››</span><span class="text-white text-sm font-black">›››</span><span class="text-white text-sm font-black">›››</span></div>
                    <div class="absolute top-12 left-3 right-10 bottom-16 z-10 rounded-lg overflow-hidden border-2 border-white/20 bg-slate-700">
                        @if(auth()->user()->photo_path)<img src="{{ asset('storage/' . auth()->user()->photo_path) }}?t={{ time() }}" class="w-full h-full object-cover">@else<div class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-700"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12"><path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg></div>@endif
                    </div>
                    <div class="absolute bottom-0 inset-x-0 z-20 bg-slate-900/90 px-4 py-3 flex items-center justify-between"><h3 class="text-white font-black text-sm uppercase tracking-tight truncate max-w-[200px]">{{ auth()->user()->name }}</h3><div class="flex items-center gap-1"><div class="w-1.5 h-1.5 bg-red-500 rounded-full"></div><div class="w-1.5 h-1.5 bg-white/50 rounded-full"></div><div class="w-1.5 h-1.5 bg-white/30 rounded-full"></div></div></div>
                </div>
            </div>
            <div class="html2pdf__page-break"></div>
            {{-- Back --}}
            <div class="relative w-[320px] h-[500px] font-sans bg-slate-800 p-2.5" style="border-radius:1.5rem;overflow:hidden;">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-16 h-5 bg-slate-700 rounded-b-lg z-30 flex items-end justify-center pb-1"><div class="w-6 h-1.5 bg-slate-600 rounded-full"></div></div>
                <div class="relative w-full h-full rounded-xl overflow-hidden flex flex-col items-center justify-between py-5 px-5 card-bg-element" style="background:linear-gradient(160deg,#7f1d1d 0%,#991b1b 30%,#b91c1c 60%,#dc2626 100%);">
                    <div class="absolute inset-0 opacity-10" style="background-image:repeating-linear-gradient(45deg,transparent,transparent 20px,rgba(255,255,255,0.05) 20px,rgba(255,255,255,0.05) 22px);"></div>
                    {{-- SCAN ME Heading top --}}
                    <div class="relative z-20 flex items-center justify-center mt-2">
                        <span class="text-white font-black text-sm tracking-[0.3em] uppercase leading-none bg-white/10 px-4 py-1.5 rounded-full border border-white/10">SCAN ME</span>
                    </div>
                    <div class="relative z-20 p-3.5 bg-white/95 rounded-2xl shadow-xl mt-2">
                        <div class="absolute -top-1 -left-1 w-3.5 h-3.5 border-t-2 border-l-2 border-red-400 rounded-tl"></div><div class="absolute -top-1 -right-1 w-3.5 h-3.5 border-t-2 border-r-2 border-red-400 rounded-tr"></div><div class="absolute -bottom-1 -left-1 w-3.5 h-3.5 border-b-2 border-l-2 border-red-400 rounded-bl"></div><div class="absolute -bottom-1 -right-1 w-3.5 h-3.5 border-b-2 border-r-2 border-red-400 rounded-br"></div>
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate(route('attendance.scan', auth()->user())) !!}
                    </div>
                    <div class="relative z-20 w-full space-y-1.5 mt-2">
                        <div class="bg-white/10 border border-white/10 px-3.5 py-2 rounded-xl flex justify-between items-center"><span class="text-[8px] font-bold text-white/60 uppercase tracking-wider">Nama</span><span class="text-[9px] font-black text-white uppercase truncate max-w-[140px]">{{ auth()->user()->name }}</span></div>
                        <div class="bg-white/10 border border-white/10 px-3.5 py-2 rounded-xl flex justify-between items-center"><span class="text-[8px] font-bold text-white/60 uppercase tracking-wider">NIM</span><span class="text-[9px] font-black text-white uppercase">{{ auth()->user()->nim }}</span></div>
                        <div class="bg-white/10 border border-white/10 px-3.5 py-2 rounded-xl flex justify-between items-center"><span class="text-[8px] font-bold text-white/60 uppercase tracking-wider">Jurusan</span><span class="text-[9px] font-black text-yellow-300 uppercase truncate max-w-[140px]">{{ auth()->user()->major ?? '-' }}</span></div>
                    </div>
                    <p class="relative z-20 text-[7px] text-white/40 text-center font-medium mt-1">Kartu pengenal resmi peserta magang Dinas Sosial Kab. Lamongan</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function previewAndSubmit(input){if(input.files&&input.files[0]){document.getElementById('file_name').textContent=input.files[0].name;const r=new FileReader();r.onload=function(e){const p=document.querySelectorAll('#cardPhotoPreview');p.forEach(x=>{x.src=e.target.result;x.classList.remove('hidden')});const h=document.querySelectorAll('#cardPhotoPlaceholder');h.forEach(x=>x.classList.add('hidden'))};r.readAsDataURL(input.files[0]);setTimeout(()=>document.getElementById('photoForm').submit(),600)}}
        function printIDCard(){const el=document.getElementById('printable-card-area');if(!el){alert('Error');return}html2pdf().set({margin:0,filename:'ID_Card_Magang_{{ auth()->user()->nim }}.pdf',image:{type:'jpeg',quality:1},html2canvas:{scale:2.5,useCORS:true,logging:false},jsPDF:{unit:'pt',format:[320,500],orientation:'portrait'}}).from(el).save()}

        function changeCardBackground(bgValue, clickedBtn) {
            let backgroundStyle = bgValue;
            if (bgValue.startsWith('#')) {
                backgroundStyle = `linear-gradient(160deg, ${bgValue} 0%, ${adjustColor(bgValue, -20)} 50%, ${adjustColor(bgValue, -40)} 100%)`;
            }
            
            const bgElements = document.querySelectorAll('.card-bg-element');
            bgElements.forEach(el => {
                el.style.background = backgroundStyle;
            });

            if (clickedBtn) {
                const presets = document.querySelectorAll('#gradientPresets button');
                presets.forEach(p => {
                    p.classList.remove('border-red-500', 'border-slate-300');
                    p.classList.add('border-transparent');
                });
                clickedBtn.classList.remove('border-transparent');
                clickedBtn.classList.add('border-red-500');
            } else {
                const presets = document.querySelectorAll('#gradientPresets button');
                presets.forEach(p => {
                    p.classList.remove('border-red-500', 'border-slate-300');
                    p.classList.add('border-transparent');
                });
            }
        }

        function adjustColor(hex, percent) {
            let R = parseInt(hex.substring(1, 3), 16);
            let G = parseInt(hex.substring(3, 5), 16);
            let B = parseInt(hex.substring(5, 7), 16);

            R = parseInt(R * (100 + percent) / 100);
            G = parseInt(G * (100 + percent) / 100);
            B = parseInt(B * (100 + percent) / 100);

            R = (R < 255) ? R : 255;
            G = (G < 255) ? G : 255;
            B = (B < 255) ? B : 255;

            R = (R > 0) ? R : 0;
            G = (G > 0) ? G : 0;
            B = (B > 0) ? B : 0;

            const rHex = R.toString(16).padStart(2, '0');
            const gHex = G.toString(16).padStart(2, '0');
            const bHex = B.toString(16).padStart(2, '0');

            return `#${rHex}${gHex}${bHex}`;
        }
    </script>
</x-app-layout>
