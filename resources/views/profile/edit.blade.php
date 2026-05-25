<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-8 animate-fade-in">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-10">
            
            <div class="mb-8">
                <h1 class="text-3xl font-black text-slate-900 tracking-tight px-4 sm:px-0">Pengaturan Akun</h1>
                <p class="text-sm font-medium text-slate-500 mt-1 px-4 sm:px-0">Kelola preferensi, keamanan, dan data pribadi Anda.</p>
            </div>

            <!-- Profile Info Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 sm:px-0">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-bold text-slate-900">Informasi Pribadi</h3>
                    <p class="text-sm text-slate-500 mt-2">Perbarui foto profil, nama lengkap, dan alamat email Anda untuk memastikan informasi akun selalu up-to-date.</p>
                </div>
                <div class="md:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <hr class="border-slate-100">

            <!-- Password Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 sm:px-0">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-bold text-slate-900">Keamanan & Sandi</h3>
                    <p class="text-sm text-slate-500 mt-2">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanannya dari akses tidak sah.</p>
                </div>
                <div class="md:col-span-2 bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <hr class="border-slate-100">

            <!-- Delete Account Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-4 sm:px-0 pb-10">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-bold text-rose-600">Hapus Akun</h3>
                    <p class="text-sm text-slate-500 mt-2">Tindakan ini tidak dapat dibatalkan. Semua data dan sumber daya yang terkait dengan akun ini akan dihapus secara permanen dari sistem.</p>
                </div>
                <div class="md:col-span-2 bg-rose-50/30 rounded-3xl border border-rose-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
                    <div class="p-6 sm:p-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
