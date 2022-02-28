@component('mail::message')
    <p>
        Hi {{$user->name}},
    </p>
    <p>
        Welcome to {{ config('app.name') }} removals. Please find your login details below.
    </p>
    <p><b>Username:</b> {{$user->email}}</p>
    <p><b>Password:</b> {{$password_generated}}</p>
    @component('mail::button', ['url' => config('app.url')])
        Login
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
