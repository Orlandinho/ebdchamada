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
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data Nasc.</th>
                        <th>Idade</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($classroom->students as $student)
                        <tr class="@if($student->visitor)
                            text-olive
                                @elseif(! $student->active & ! $student->visitor)
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
                                    <form action="/admin/students/{{ $student->slug }}" class="ml-3 deleteclass"  method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link classname" data-isclass="0" data-name="{{ $student->name }}">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
