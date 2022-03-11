<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/users" method="POST" bsclass="col-md-6" file="enctype=multipart/form-data" name="Criando novo usuário">
        <div class="card-body col-lg">
            <div class="form-group row">
                <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-9">
                    <input name="name" value="{{ old('name') }}" class="form-control" id="nome">
                    <x-form.errors name="name" />
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                <div class="col-sm-9">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
                    <x-form.errors name="email" />
                </div>
            </div>

            <div class="form-group row">
                <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                <div class="col-sm-9">
                    <input type="file" name="avatar" class="form-control" id="avatar">
                    <x-form.errors name="avatar" />
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Senha</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="password">
                    <x-form.errors name="password" />
                </div>
            </div>

            <div class="form-group row">
                <label for="password_confirmation" class="col-sm-3 col-form-label">Confirme a Senha</label>
                <div class="col-sm-9">
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
            </div>

            <div class="form-group row mt-2">
                <label class="col-sm-3">Função</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        @foreach($roles as $role)
                            <div class="{{ $loop->last ? '' : 'mr-3' }}">
                                <input type="radio" class="form-check-input" name="role_id" value="{{ $role->id }}" {{ $loop->first ? 'checked' : '' }} id="role_{{ $role->id }}">
                                <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <x-form.errors name="role_id" />
                </div>
            </div>

            <x-form.submit-button>Cadastrar</x-form.submit-button>
        </div>
    </x-admin.form>

</x-admin.layout>

