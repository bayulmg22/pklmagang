<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="mb-2">
                <h1 class="text-2xl font-black text-slate-900 tracking-tight px-4 sm:px-0">Pengaturan Profil</h1>
                <p class="text-xs font-medium text-slate-500 px-4 sm:px-0">Kelola informasi akun dan keamanan Anda.</p>
            </div>

            <div class="p-4 sm:p-8 bg-white/80 backdrop-blur-md shadow-sm border border-slate-100 sm:rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white/80 backdrop-blur-md shadow-sm border border-slate-100 sm:rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white/80 backdrop-blur-md shadow-sm border border-slate-100 sm:rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
