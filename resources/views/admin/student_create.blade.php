<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/students" method="POST" file="enctype=multipart/form-data" name="Novo Aluno">
        <div class="card-body">
            <div class="form-row">
                <x-form.input name="name" bsclass="col-lg-8" value="{{ old('name') }}" nome="nome completo" />
                <x-form.input name="dob" nome="data nasc" bsclass="col-lg-2" value="{{ old('dob') }}" />
                <x-form.select name="classroom_id" nome="classe" bsclass="col-lg-2" selected="{{ old('classroom_id') }}" :classrooms="$classrooms"/>
            </div>
            <div class="form-row">
                <x-form.input name="zipcode" nome="CEP" bsclass="col-lg-2" value="{{ old('zipcode') }}" />
                <x-form.input name="address" nome="Endereço" bsclass="col-lg-5" value="{{ old('address') }}" />
                <x-form.input name="neighborhood" nome="Bairro" bsclass="col-lg-3" value="{{ old('neighborhood') }}" />
                <x-form.input name="city" nome="Cidade" bsclass="col-lg-2" value="{{ old('city') }}" />
            </div>
            <div class="form-row">
                <x-form.input name="cel" nome="celular" bsclass="col-lg-2" value="{{ old('cel') }}" />
                <x-form.input name="tel" nome="tel fixo" bsclass="col-lg-2" value="{{ old('tel') }}" />
                <x-form.input name="email" nome="e-mail" type="email" bsclass="col-lg-3" value="{{ old('email') }}" />
                <x-form.input name="avatar" nome="foto" type="file" bsclass="col-lg-3" value="{{ old('avatar') }}" />
            </div>
            <div class="form-group ml-1">
                <x-form.checkbox-visitant name="visitor" nome="visitante" />
            </div>
            <div>
                <x-form.submit-button>Cadastrar Aluno</x-form.submit-button>
                <small class="float-right text-secondary">Se o CEP digitado no campo for válido o sistema irá automaticamente procurar os dados referentes</small>
            </div>
        </div>
    </x-admin.form>

</x-admin.layout>

