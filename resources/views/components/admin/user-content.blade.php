@props(['users'])

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <h1 class="text-center">Lista de Usuários</h1>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Adicionar novo usuário <a href="/admin/users/create"><i class="fas fa-id-badge ml-2"></i></a></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Classe</th>
                        <th>Função</th>
                        <th>Ações</th>
                        <th>Senha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="/admin/users/{{ $user->slug }}" class="d-inline-flex align-items-center text-dark">
                                    <div class="image mr-3">
                                        <img src="{{ $user->avatar !== null ? asset('storage/'.$user->avatar) : asset('storage/avatars/avatar.png') }}"
                                             class="img-circle elevation-2" style="width: 40px;" alt="User Image">
                                    </div>
                                    <div>
                                        <u>{{ $user->name }}</u>
                                    </div>
                                </a>
                            </td>
                            <td class="align-middle">{{ \App\Models\Classroom::find($user->classroom_id)->class ?? '---' }}</td>
                            <td class="align-middle">{{ \App\Models\Role::find($user->role_id)->name }}</td>
                            <td class="align-middle">
                                <div class="d-inline-flex align-items-center">
                                    <a href="/admin/users/{{ $user->slug }}/edit"><i class="fas fa-edit text-secondary"></i></a>
                                    <form action="/admin/users/{{ $user->id }}" class="ml-3 deleteclass" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link classname" data-isclass="2" data-name="{{ $user->name }}">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td class="align-middle">
                                <form action="/password/resend/{{ $user->id }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm btn-block col-md-5 {{ $user->password ? 'btn-outline-success' : 'btn-outline-secondary' }} ">{{ $user->password ? 'Resetar' : 'Criar' }}
                                        <i class="fas fa-envelope ml-2"></i>
                                    </button>
                                </form>
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
