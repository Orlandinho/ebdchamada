<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/users/{{ $user->id }}" method="PATCH" bsclass="col-md-6" file="enctype=multipart/form-data" name="Atualizando dados do colaborador(a) {{ $user->name }}">
        <div class="card-body col-lg">
            <div class="form-group row">
                <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-9">
                    <input name="name" value="{{ old('name', $user->name) }}" class="form-control" id="nome">
                    <x-form.errors name="name" />
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                <div class="col-sm-9">
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" id="email">
                    <x-form.errors name="email" />
                </div>
            </div>

            <div class="form-group row">
                <label for="classroom_id" class="col-sm-3 col-form-label">Classes</label>
                <div class="col-sm-9">
                    <select name="classroom_id" class="form-control" id="classroom_id">
                        <option value=" ">-----</option>
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ $user->classroom_id === $classroom->id ? 'selected' : '' }}>{{ $classroom->class }}</option>
                        @endforeach
                    </select>
                    <x-form.errors name="classroom_id" />
                </div>
            </div>

            <div class="form-group row">
                <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                <div class="col-sm-6">
                    <input type="file" name="avatar" class="form-control" id="avatar">
                    <x-form.errors name="avatar" />
                </div>
                @if($user->avatar)
                    <div class="col-sm-3">
                        <img src="{{ asset('storage/'.$user->avatar) }}" class="rounded elevation-2 d-block mx-auto" style="width: 96px;" alt="User Image">
                    </div>
                @else
                    <p class="my-auto mx-auto">Não há foto</p>
                @endif
            </div>

            <div class="form-group row">
                <label class="col-sm-3">Função</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        @foreach($roles as $role)
                            <div class="{{ $loop->last ? '' : 'mr-3' }}">
                                <input type="radio" class="form-check-input" name="role_id" value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'checked' : '' }} id="role_{{ $role->id }}">
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-form.errors name="role_id" />
                </div>
            </div>

            <x-form.submit-button>Atualizar</x-form.submit-button>
        </div>
    </x-admin.form>

</x-admin.layout>

