<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <article class="space-y-8">
                <header>
                    <h2 class="text-xl font-black">- Kontaks</h2>
                </header>
                <section class="overflow-x-auto relative rounded-lg shadow-sm">
                    <x-kontak-table :users="$users"/>
                </section>
                <footer>
                    {{ $users->links() }}
                </footer>
            </article>
        </div>
    </div>

</x-app-layout>
