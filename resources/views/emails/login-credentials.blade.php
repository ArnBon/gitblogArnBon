@component('mail::message')
# Tus credenciales para acceder a {{ config('app.name') }}

Utiliza las credenciales para acceder al sistema.

@component('mail::table')
| User   | Contraseña |
|:------- |:----------- |
| {{ $user->email }}  | {{ $password }} |
@endcomponent

@component('mail::button', ['url' => url('login')])

Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
