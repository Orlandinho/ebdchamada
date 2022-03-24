<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chamada IPVG | Dashboard</title>

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- Select plugin element style -->
        <link rel="stylesheet" href="{{  asset('plugins/select2/css/select2.min.css') }}">
        {{--    SweetAlert theme    --}}
        <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    </head>
    <body class="hold-transition sidebar-mini sidebar-collapse">
        <div class="wrapper">
        @include('sweetalert::alert')

            {{ $slot }}

            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Desenvolvido por <a href="https://github.com/Orlandinho">Orlando</a>
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>
        </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    {{-- input mask --}}
    <script src={{ asset('plugins/moment/moment.min.js') }}></script>
    <script src={{ asset('plugins/inputmask/jquery.inputmask.min.js') }}></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- select2 plugin -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- SweetAlert plugin -->
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //inputmask
            $('#dob').inputmask('datetime', {inputFormat: 'dd/mm/yyyy', placeholder:'dd/mm/aaaa'})
            $('#zipcode').inputmask('99999-999', {placeholder: ''})
            $('#cel').inputmask('(99) 99999-9999', {placeholder: ''})
            $('#tel').inputmask('(99) 9999-9999', {placeholder: ''})
        });

        let zipcode = document.getElementById('zipcode')
        if (zipcode) {
            zipcode.addEventListener('blur', e => {
                let cep = zipcode.value.replace(/\D/g, '')
                let address = document.getElementById('address')
                let neighborhood = document.getElementById('neighborhood')
                let city = document.getElementById('city')

                fetch('https://viacep.com.br/ws/' + cep + '/json/')
                    .then(response => response.json())
                    .then(json => {
                        if (json.erro) {
                            Swal.fire({
                                title: 'Oops!',
                                html: `O cep <b>${zipcode.value}</b> não retornou nenhuma informação`,
                                icon: 'error',
                                customClass: {
                                    cancelButton: 'btn btn-outline-danger'
                                },
                                buttonsStyling: false,
                                showCancelButton: true,
                                showConfirmButton: false,
                                cancelButtonText: 'Ok'
                            })
                        } else {
                            Swal.fire({
                                title: 'Endereço encontrado!',
                                html: `Logradouro <b>${json.logradouro}</b>, bairro <b>${json.bairro}</b> e cidade <b>${json.localidade}</b>. Deseja preencher os demais campos de endereço com esses dados?`,
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-outline-success mr-3',
                                    cancelButton: 'btn btn-outline-danger'
                                },
                                buttonsStyling: false,
                                showCancelButton: true,
                                confirmButtonText: 'Preencher',
                                cancelButtonText: 'Cancelar',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    address.value = json.logradouro
                                    neighborhood.value = json.bairro
                                    city.value = json.localidade
                                }
                            })
                        }
                    }).catch(err => {
                    console.log(err)
                })
            })
        }

        document.querySelectorAll('.deleteclass').forEach(classData => {
            classData.addEventListener('submit', e => {
                e.preventDefault()
                let className = classData.querySelector('.classname').getAttribute('data-name')
                let isClass = classData.querySelector('.classname').getAttribute('data-isclass')
                let message = ''
                switch (isClass) {
                    case "0":
                        message = `Ao deletar os dados do(a) aluno(a) <b>${className}</b> você não terá como reverter a ação. Deseja prosseguir?`
                        break;
                    case "1":
                        message = `Ao deletar a classe <b>${className}</b> você não terá como reverter a ação. Deseja prosseguir?`
                        break;
                    case "2":
                        message = `Ao deletar os dados do colaborador(a) <b>${className}</b> você não terá como reverter a ação e ele(a) não terá mais acesso ao sistema. Deseja prosseguir?`
                        break;
                }

                Swal.fire({
                    title: 'Atenção!',
                    html: message,
                    icon: 'warning',
                    customClass:{
                        confirmButton: 'btn btn-outline-success mr-3',
                        cancelButton: 'btn btn-outline-danger'
                    },
                    buttonsStyling: false,
                    showCancelButton: true,
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        classData.submit()
                    }
                })
            })
        })
    </script>
    </body>
</html>
