<x-mail::message>
    # Hi there, {{ $user->name }}

    Your Kontak details were updated successfully.

    <x-mail::button :url="route('login')">
        Login
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
