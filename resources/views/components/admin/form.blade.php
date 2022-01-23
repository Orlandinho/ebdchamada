@props(['method','route','button','header','name'])
<div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid d-flex">
            <div class="col-md-6 mx-auto" style="margin-top: 4rem;">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ $route }}">
                        @csrf
                        @method($method)
                        <div class="card-body">
                            {{ $slot }}
                            <x-form.submit-button>{{ $button }}</x-form.submit-button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
