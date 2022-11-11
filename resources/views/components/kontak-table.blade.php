
<table class="w-full rounded-lg bg-white">
    <thead class="border-b-2 border-gray-300 mb-4">
    <tr>
        <th class="py-4 px-8 text-gray-400 text-xs font-semibold uppercase text-left lg:bg-white sm:bg-gray-50">ID</th>
        <th class="py-4 px-8 text-gray-400 text-xs font-semibold uppercase text-left">User</th>
        <th class="py-4 px-8 text-gray-400 text-xs font-semibold uppercase text-left">Contact Details</th>
        <th class="py-4 px-8 text-gray-400 text-xs font-semibold uppercase text-left">Joined</th>
        <th class="py-4 px-8 text-gray-400 text-xs font-semibold uppercase text-left"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($users  as $user)
        <tr class="border-b border-dashed border-gray-200 last:border-b-0 {{ $loop->even % 2? 'bg-white': 'bg-gray-50' }}">
            <td  class="py-3 left whitespace-nowrap pl-5  md:w-[30px] w-20">{{ sprintf('#%03d', $user->id) }}</td>
            <td class="py-1 px-5 left md:w-[300px] min-w-[180px]">
                {{ $user->fullname }}
                <div  class="text-xs text-gray-400">{{ $user->za_id_number }}</div>
            </td>
            <td class="py-3 px-5 left md:w-2/6 min-w-[130px]">
                {{ $user->mobile_number }}
                <div  class="text-xs text-gray-400">{{ $user->email }}</div>
            </td>
            <td class="py-3 px-5 left min-w-[120px]">
                {{ $user->created_at->format('M d, Y') }}
                <div  class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</div>
            </td>
            <td class="py-3 px-5 left">
                <div class="space-x-1 flex">
                    <x-button-link :link="route('users.show', $user->id)">
                        View
                    </x-button-link>
                    @if(auth()->user()->is_admin || $user->id == auth()->id() )
                    <x-button-link :link="route('users.edit', $user->id)" class="bg-blue-500">
                        Edit
                    </x-button-link>
                    @endif
                    @if(auth()->user()->is_admin)
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                        @csrf
                        @method('delete')

                        <x-primary-button :link="route('users.show', $user->id)" class="bg-gray-50 border-red-400 text-red-400 text-xs rounded font-bold">
                            Delete
                        </x-primary-button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
