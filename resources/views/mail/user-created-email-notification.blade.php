<x-mail::message>
# Hi there, {{ $user->name }}

    Your Kontak details were created successfully by our team.

<x-mail::button :url="route('login')">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
