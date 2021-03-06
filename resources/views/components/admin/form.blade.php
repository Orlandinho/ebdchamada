@props(['method','route','header','name','file' => null,'bsclass' => 'col-md-11'])
<div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid d-flex">
            <div class="{{ $bsclass }} mx-auto" style="margin-top: 2rem;">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $name }}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ $route }}" {{ $file }}>
                        @csrf
                        @method($method)

                            {{ $slot }}
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
