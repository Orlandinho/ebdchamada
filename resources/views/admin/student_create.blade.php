<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/students" method="POST" file="enctype=multipart/form-data" name="Novo Aluno">
        <div class="card-body">
            <div class="form-row">
                <x-form.input name="name" class="col-lg-8" nome="nome completo" />
                <x-form.input name="dob" nome="data nasc" class="col-lg-2" />
                <x-form.select name="classroom_id" nome="classe" class="col-lg-2" :classrooms="$classrooms"/>
            </div>
            <div class="form-row">
                <x-form.input name="zipcode" nome="CEP" class="col-lg-2" />
                <x-form.input name="address" nome="Endereço" class="col-lg-5" />
                <x-form.input name="neighborhood" nome="Bairro" class="col-lg-3" />
                <x-form.input name="city" nome="Cidade" class="col-lg-2" />
            </div>
            <div class="form-row">
                <x-form.input name="cel" nome="celular" class="col-lg-2" />
                <x-form.input name="tel" nome="tel fixo" class="col-lg-2" />
                <x-form.input name="email" nome="e-mail" type="email" class="col-lg-4" />
                <x-form.input name="avatar" nome="foto" type="file" class="col-lg-4" />
            </div>
            <div>
                <x-form.submit-button>Cadastrar Aluno</x-form.submit-button>
                <small class="float-right text-secondary">Se o CEP digitado no campo for válido o sistema irá automaticamente procurar os dados referentes</small>
            </div>
        </div>
    </x-admin.form>

</x-admin.layout>

