@props(['students'])

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="text-center">Lista de alunos</h1>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Adicionar novo aluno <a href="/admin/students/create"><i class="fas fa-user-plus ml-2"></i></a></h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 250px;">
                        <input type="text" name="table_search" class="form-control float-right"
                               placeholder="Pesquisar Alunos">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Classe</th>
                        <th>Data Nasc.</th>
                        <th>Idade</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr class="@if($student->visitor)
                                text-olive
                            @elseif(! $student->active)
                                text-maroon
                            @else

                            @endif">
                            <td class="d-flex align-items-center">
                                <div class="image mr-3">
                                    <img src="{{ asset('storage/'.$student->avatar) }}" class="img-circle elevation-2" style="width: 40px;" alt="User Image">
                                </div>
                                <div>
                                    {{ $student->name }}
                                </div>
                            </td>
                            <td class="align-middle">{{ \App\Models\Classroom::find($student->classroom_id)->class ?? '---' }}</td>
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
            <!-- /.card-body -->
        </div>
    </section>
</div>
