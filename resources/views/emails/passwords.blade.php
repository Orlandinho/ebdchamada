@component('mail::message')
# Bem vindo à equipe da EBD da IPVG!<br><br>
Olá colaborador(a) **{{ $user->name }}**!<br><br>
É necessário criar uma senha para acesso ao sistema da **IPVG**. O link é temporário e ficará disponível até a data **{{ now()->addDays(2)->isoFormat('DD/MM/Y H:mm') }}**, ou até que a senha tenha sido criada.
@component('mail::button', ['url' => $link])
Link para criação da senha
@endcomponent
Caso você tenha esquecido ou perdido a sua senha você pode entrar em contato com o(a) superintendente da EBD para que ele(a) solicite o envio de um novo link para criação de uma nova senha ou confirmar o seu e-mail na página de login do sistema ao clicar no link de "Esqueci a minha senha".<br><br>
Equipe da {{ config('app.name') }}<br><br>
<div style="text-align: center;">
    <img src="https://ipvilagustavo.com.br/wp-content/uploads/2020/05/logo-01.png" style="height: 80px; width: 130px;">
</div>
@endcomponent
