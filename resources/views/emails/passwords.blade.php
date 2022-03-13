@component('mail::message')
# Bem vindo à equipe da EBD da IPVG!<br><br>
Olá colaborador(a) **{{ $user->name }}**!<br><br>
É necessário criar uma senha para o acesso do sistema de chamada da EBD que poderá ser feito no link abaixo.

@component('mail::button', ['url' => $link])
Link para criação da senha
@endcomponent
Se você esquecer/perder a sua senha entre em contato com o(a) superintendente da EBD para que ele(a) solicite o envio de um novo novo link para atualização da senha.<br><br>
Até logo!<br><br>
Equipe da {{ config('app.name') }}
@endcomponent
