@props(['classroom'])
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Classe {{ $classroom->class }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header d-inline-flex align-items-center">
                <p class="card-title mr-2">{{ $classroom->teachers->count() > 1 ? 'Professores: ' : 'Professor/Superintendente: ' }}</p>
                @foreach($classroom->teachers as $teacher)
                    <a href="#" class="mr-2">{{ $teacher->name }} </a>
                    @if(! $loop->last)
                        <span class="mr-2">e</span>
                    @endif
                @endforeach
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <p class="h4">Lista de Alunos</p>
                        <div class="table-responsive p-0" style="height: 320px;">
                            <table class="table table-hover table-head-fixed text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Data Nasc.</th>
                                        <th>Idade</th>
                                        <th>Status</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($classroom->students as $student)
                                <tr class="@if($student->visitor)
                                                text-olive
                                            @elseif(! $student->active)
                                                text-maroon
                                            @else

                                            @endif">
                                    <td class="d-flex align-items-center">
                                        <div class="image mr-3">
                                            <img src="{{ asset('/storage/avatars/default'.rand(1,5).'.png') }}" class="img-circle elevation-2" style="width: 40px;" alt="User Image">
                                        </div>
                                        <div>
                                            {{ $student->name }}
                                        </div>
                                    </td>
                                    <td class="align-middle">{{ $student->getDob() }}</td>
                                    <td class="align-middle">{{ $student->age() . ' anos' }}</td>
                                    <td class="align-middle">
                                        @if($student->visitor)
                                            Visitante
                                        @elseif($student->active)
                                            Ativo
                                        @else
                                            Inativo
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        <a href="#">Mais</a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
