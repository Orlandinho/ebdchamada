

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row d-flex align-items-center justify-content-center mb-4 mt-4">
                <div class="">
                    <h1 class="m-0 mr-3">Todas as Classes</h1>
                </div><!-- /.col -->
                <a href="#" title="Adicionar uma nova classe"><i class="text-gray-dark fas fa-plus-square fa-lg"></i></a>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex align-items-lg-center justify-content-lg-around">

                {{ $slot }}
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
