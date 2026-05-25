<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight leading-tight">
                    {{ __('Pusat Notifikasi') }}
                </h2>
                <p class="text-xs text-slate-500 font-medium mt-1">Semua pesan dan pengumuman dari Admin akan masuk ke sini.</p>
            </div>
            
            @if(auth()->user()->unreadNotifications->count() > 0)
            <form action="{{ route('notifications.read-all') }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold rounded-xl transition shadow-md shadow-slate-200">
                    Tandai Semua Dibaca
                </button>
            </form>
            @endif
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-6">
        
        <!-- Filter Tabs -->
        <div class="flex gap-2 border-b border-slate-200 pb-px">
            <a href="{{ route('intern.notifications') }}" class="px-5 py-2.5 text-sm font-bold border-b-2 transition-colors {{ !request()->has('filter') ? 'border-slate-800 text-slate-800' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">Semua</a>
            <a href="{{ route('intern.notifications', ['filter' => 'message']) }}" class="px-5 py-2.5 text-sm font-bold border-b-2 transition-colors {{ request()->get('filter') === 'message' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">Pesan Pribadi</a>
            <a href="{{ route('intern.notifications', ['filter' => 'announcement']) }}" class="px-5 py-2.5 text-sm font-bold border-b-2 transition-colors {{ request()->get('filter') === 'announcement' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">Pengumuman</a>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/40 overflow-hidden">
            <div class="border-b border-slate-50 px-8 py-6 bg-slate-50/50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-lg">Riwayat Pesan</h3>
                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-black uppercase tracking-widest">
                    {{ $notifications->total() }} Notifikasi
                </span>
            </div>

            <div class="divide-y divide-slate-50">
                @forelse($notifications as $notification)
                    <div class="p-6 sm:px-8 hover:bg-slate-50/50 transition-colors flex gap-4 {{ $notification->read_at ? 'opacity-70' : '' }}">
                        <div class="p-3 {{ isset($notification->data['type']) && $notification->data['type'] === 'announcement' ? 'bg-blue-50 text-blue-600' : 'bg-indigo-50 text-indigo-600' }} rounded-2xl shrink-0 h-fit">
                            @if(isset($notification->data['type']) && $notification->data['type'] === 'announcement')
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" /></svg>
                            @else
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0 flex flex-col justify-center">
                            <div class="flex justify-between items-start gap-4 mb-2">
                                <h4 class="text-base font-extrabold text-slate-800 leading-tight">
                                    {{ $notification->data['title'] ?? 'Pesan Baru' }}
                                </h4>
                                <span class="text-[10px] font-bold text-slate-400 whitespace-nowrap">
                                    {{ $notification->created_at->translatedFormat('d M Y, H:i') }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line">{{ $notification->data['message'] ?? '' }}</p>
                        </div>
                        
                        @if(is_null($notification->read_at))
                            <div class="shrink-0 flex items-center justify-center">
                                <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-3 h-3 rounded-full bg-blue-500 hover:bg-blue-600 hover:scale-110 transition shadow-sm" title="Tandai dibaca"></button>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" /></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-800 mb-1">Pusat Notifikasi Kosong</h4>
                        <p class="text-sm text-slate-500 font-medium">Belum ada pesan atau pengumuman untuk Anda.</p>
                    </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
                <div class="border-t border-slate-50 px-8 py-4 bg-slate-50/50">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
