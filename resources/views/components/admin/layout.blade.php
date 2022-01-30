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
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>
        </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
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
        });

        document.querySelectorAll('.deleteclass').forEach(classroom => {
            classroom.addEventListener('submit', e => {
                e.preventDefault()
                let className = classroom.querySelector('.classname').getAttribute('data-name')
                Swal.fire({
                    title: 'Atenção!',
                    html: `Ao deletar a classe <b>${className}</b> você não terá como reverter a ação. Deseja prosseguir?`,
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
                        classroom.submit()
                    }
                })
            })
        })
    </script>
    </body>
</html>
