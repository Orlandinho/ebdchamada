<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
        <meta name="generator" content="Hugo 0.88.1">
        <title>IP Vila Gustavo</title>

        <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/sign-in/">
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            html,
            body {
                height: 100%;
            }

            body {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-align: center;
                align-items: center;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }

            .form-signin {
                width: 100%;
                max-width: 330px;
                padding: 15px;
                margin: auto;
            }

            .form-signin .form-control {
                position: relative;
                box-sizing: border-box;
                height: auto;
                padding: 10px;
                font-size: 16px;
            }
            .form-signin .form-control:focus {
                z-index: 2;
            }
            .form-signin input[type="email"] {
                margin-bottom: -1px;
                border-bottom-right-radius: 0;
                border-bottom-left-radius: 0;
            }
            .form-signin input[type="password"] {
                margin-bottom: 10px;
                border-top-left-radius: 0;
                border-top-right-radius: 0;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
        </style>
    </head>
    <body class="text-center">
        <form class="form-signin" method="POST" action="/password/{{ $user->id }}">
            @csrf
            @method('PATCH')
            <img class="mb-4" src="{{ asset('dist/img/logos/ipvg.png') }}" alt="" width="100%" height="100%">
            <h1 class="h3 mb-3 font-weight-normal">Crie sua senha</h1>
            <label for="password" class="sr-only">Senha</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required autofocus>
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <label for="password_confirmation" class="sr-only">Confirme a senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirme a senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Criar</button>
            <p class="mt-5 mb-3 text-muted">&copy; IP Vila Gustavo 2022</p>
        </form>
    </body>
</html>
