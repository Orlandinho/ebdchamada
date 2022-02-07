<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/students" method="POST" name="Novo Aluno">
        <div class="card-body">
            <div class="form-row">
                <x-form.input name="name" class="col-md-8" nome="nome completo" autofocus/>
                <x-form.input name="dob" nome="data de nascimento" class="col-md-2" />
                <x-form.select name="classroom_id" nome="Classe" class="col-md-2" :classrooms="$classrooms"/>
            </div>
            <div class="form-row">
                <x-form.input name="zipcode" nome="CEP" class="col-md-2" />
                <x-form.input name="address" nome="Endereço" class="col-md-5" />
                <x-form.input name="neighborhood" nome="Bairro" class="col-md-3" />
                <x-form.input name="city" nome="Cidade" class="col-md-2" />
            </div>
            <div class="form-row">
                <x-form.input name="cel" nome="celular" class="col-md-2" />
                <x-form.input name="tel" nome="tel fixo" class="col-md-2" />
                <x-form.input name="email" nome="e-mail" type="email" class="col-md-4" />
                <x-form.input name="avatar" nome="foto" type="file" class="col-md-4" />
            </div>
            <x-form.submit-button>Cadastrar Aluno</x-form.submit-button>
        </div>
    </x-admin.form>

</x-admin.layout>

