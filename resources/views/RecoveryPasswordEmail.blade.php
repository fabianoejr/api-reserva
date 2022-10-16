@component('mail::message')

Olá, {{ $name }}!

Para redefinir sua senha acesse o link abaixo

@component('mail::button', ['url' => $url])
Redefinir senha
@endcomponent

@endcomponent