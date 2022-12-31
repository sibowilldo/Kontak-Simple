<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="space-y-8">
                <header class="flex items-center justify-between">
                    <h2 class="text-xl font-black">- Kontaks</h2>
                    @if(auth()->user()->is_admin)
                        <x-button-link :link="route('users.create')">New Kontak</x-button-link>
                    @endif
                </header>
                @livewire('kontak-table')
            </article>
        </div>
    </div>
</x-app-layout>
