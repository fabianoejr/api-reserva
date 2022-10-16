@component('mail::message')

Olá, {{ $name }}!

Por favor, verifique sua conta clicando no link

@component('mail::button', ['url' => $url])
Verificar conta
@endcomponent

@endcomponent