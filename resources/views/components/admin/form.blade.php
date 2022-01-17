@props(['method','route','button','header','name'])
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row d-flex align-items-center justify-content-center mb-4 mt-4">
                <div class="">
                    <h1 class="m-0 mr-3">{{ $header }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-6 mx-auto">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Classe {{ $name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ $route }}">
                        @csrf
                        @method($method)
                        <div class="card-body">
                            {{ $slot }}
                        </div>
                        <x-form.submit-button>{{ $button }}</x-form.submit-button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
