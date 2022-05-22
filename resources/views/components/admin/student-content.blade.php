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
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr class="@if($student->visitor)
                                text-olive
                            @elseif(! $student->active && ! $student->visitor)
                                text-maroon
                            @else

                            @endif">
                            <td>
                                <a href="/admin/students/{{ $student->slug }}" class="d-inline-flex align-items-center text-dark">
                                    <div class="image mr-3">
                                        <img src="{{ $student->avatar !== null ? asset('storage/'.$student->avatar) : asset('storage/avatars/avatar.png') }}"
                                             class="img-circle elevation-2" style="width: 40px;" alt="User Image">
                                    </div>
                                    <div>
                                        <u>{{ $student->name }}</u>
                                    </div>
                                </a>
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
                                <div class="d-inline-flex align-items-center">
                                    <a href="/admin/students/{{ $student->slug }}/edit"><i class="fas fa-edit text-secondary"></i></a>
                                    @can('delete')
                                        <form action="/admin/students/{{ $student->slug }}" class="ml-3 deleteclass"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link classname" data-isclass="0"
                                                    data-name="{{ $student->name }}">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
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
