@component('mail::message')
# Bem vindo à equipe da EBD da IPVG!<br><br>
Olá colaborador(a) **{{ $user->name }}**!<br><br>
Abaixo há um link de um formulário para o cadastro de sua senha. O link é temporário e ficará disponível até a data **{{ now()->addDays(2)->isoFormat('D/M/Y H:m') }}**.
@component('mail::button', ['url' => $link])
Link para criação da senha
@endcomponent
Se você esquecer/perder a sua senha entre em contato com o(a) superintendente da EBD para que ele(a) solicite o envio de um novo link para criação da senha.<br><br>
Até logo!<br><br>
Equipe da {{ config('app.name') }}
@endcomponent
