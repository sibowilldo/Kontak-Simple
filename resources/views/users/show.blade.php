<x-app-layout>
    <x-slot name="header">
        <section  class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($user->name . '\'s Details') }}
            </h2>
            <div>
                <a href="{{route('users.index')}}">Back to List</a>
            </div>
        </section>
    </x-slot>


    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <article class="space-y-8">
                <header>
                    <h2 class="text-xl font-black">- Details</h2>
                </header>
                <section class="w-full rounded-lg bg-white px-8 py-6 shadow">
                    <ul class="space-y-4">
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">Full Name</div>
                            {{ $user->fullname }}
                        </li>
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">Birth Date</div>
                            {{ $user->birth_date->format('M d, Y') }}
                        </li>
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">South African ID Number</div>
                            {{ $user->za_id_number }}
                        </li>
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">Mobile Number</div>
                            {{ $user->mobile_number }}
                        </li>
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">Email Address</div>
                            {{ $user->email }}
                        </li>
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">Preferred Language</div>
                            {{ $user->language->name }}
                        </li>
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">Interests</div>
                            <section class="space-3 ">

                                @foreach($user->interests->pluck('name') as $interest)
                                    <span class="bg-blue-500 text-white rounded p-1 text-xs">{{ $interest }}</span>
                                @endforeach
                            </section>
                        </li>
                        <li>
                            <div  class="text-xs text-gray-400 uppercase font-bold mb-1">Details Added At</div>
                            {{ $user->created_at->format('Y-m-d H:i:s') }}
                        </li>
                    </ul>
                </section>
                <footer class="flex flex-row gap-2">
                    @if(auth()->user()->is_admin || auth()->id() == $user->id)
                        <x-button-link :link="route('users.edit', $user->id)" class="bg-blue-500">
                            Edit
                        </x-button-link>
                    @endif
                    @if(auth()->user()->is_admin)
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                            @csrf
                            @method('delete')

                            <x-primary-button :link="route('users.show', $user->id)" class="hover:bg-red-100 bg-gray-50 border-red-400 text-red-400 text-xs rounded font-bold">
                                Delete
                            </x-primary-button>
                        </form>
                    @endif
                </footer>
            </article>
        </div>
    </div>

</x-app-layout>
