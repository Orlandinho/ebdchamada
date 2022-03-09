<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/classrooms" method="POST" bsclass="col-md-6" name="Criando novo usuário">
        <div class="card-body col-lg">
            <div class="form-group row">
                <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-9">
                    <input name="name" class="form-control" id="nome">
                </div>
                <x-form.errors name="name" />
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-mail</label>
                <div class="col-sm-9">
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <x-form.errors name="email" />
            </div>

            <div class="form-group row">
                <label for="avatar" class="col-sm-3 col-form-label">Avatar</label>
                <div class="col-sm-9">
                    <input type="file" name="avatar" class="form-control" id="avatar">
                </div>
                <x-form.errors name="avatar" />
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Senha</label>
                <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <x-form.errors name="password" />
            </div>

            <div class="form-group row">
                <label for="password_confirm" class="col-sm-3 col-form-label">Confirme a Senha</label>
                <div class="col-sm-9">
                    <input type="password" name="password_confirm" class="form-control" id="password_confirm">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3">Função</label>
                <div class="col-sm-9">
                    <div class="form-check form-check-inline">
                        <div class="mr-3">
                            <input type="radio" class="form-check-input" name="role_id" checked value="1" id="role_1">
                            <label class="form-check-label" for="role_1">Professor</label>
                        </div>
                        <div class="mr-3">
                            <input type="radio" class="form-check-input" name="role_id" value="2" id="role_2">
                            <label class="form-check-label" for="role_2">Assistente</label>
                        </div>
                        <div>
                            <input type="radio" class="form-check-input" name="role_id" value="3" id="role_3">
                            <label class="form-check-label" for="role_3">Admin</label>
                        </div>
                    </div>
                </div>
            </div>

            <x-form.submit-button>Cadastrar</x-form.submit-button>
        </div>
    </x-admin.form>

</x-admin.layout>

