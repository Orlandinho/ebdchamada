@component('mail::message')
# Bem vindo à equipe da EBD da IPVG!<br>
Olá colaborador(a) **{{ $request->name }}**!<br><br>
A sua senha de acesso ao sistema de chamada da IPVG é: **{{ $request->password }}**.<br><br>
Se você esquecer ou perder a sua senha entre em contato com o Admin do sistema, somente ele(a) poderá gerar uma nova senha pra você, ok?

@component('mail::button', ['url' => 'http://localhost:8000/login'])
Link de acesso
@endcomponent

Até logo!<br><br>
Equipe da {{ config('app.name') }}
@endcomponent
