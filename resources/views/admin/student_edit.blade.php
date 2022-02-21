<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/students" method="PATCH" file="enctype=multipart/form-data" name="Novo Aluno">
        <div class="card-body">
            <div class="form-row">
                <x-form.input name="name" bsclass="col-lg-8" value="{{ old('name', $student->name) }}" nome="nome completo" />
                <x-form.input name="dob" nome="data nasc" bsclass="col-lg-2" value="{{ old('dob', $student->getDob()) }}" />
                <x-form.select name="classroom_id" nome="classe" bsclass="col-lg-2" selected="{{ old('classroom_id', $student->classroom_id) }}" :classrooms="$classrooms"/>
            </div>
            <div class="form-row">
                <x-form.input name="zipcode" nome="CEP" bsclass="col-lg-2" value="{{ old('zipcode', $student->information->zipcode) }}" />
                <x-form.input name="address" nome="Endereço" bsclass="col-lg-5" value="{{ old('address', $student->information->address) }}" />
                <x-form.input name="neighborhood" nome="Bairro" bsclass="col-lg-3" value="{{ old('neighborhood', $student->information->neighborhood) }}" />
                <x-form.input name="city" nome="Cidade" bsclass="col-lg-2" value="{{ old('city', $student->city) }}" />
            </div>
            <div class="form-row">
                <x-form.input name="cel" nome="celular" bsclass="col-lg-2" value="{{ old('cel', $student->information->cel) }}" />
                <x-form.input name="tel" nome="tel fixo" bsclass="col-lg-2" value="{{ old('tel', $student->information->tel) }}" />
                <x-form.input name="email" nome="e-mail" type="email" bsclass="col-lg-4" value="{{ old('email', $student->email) }}" />
                <x-form.input name="avatar" nome="foto" type="file" bsclass="col-lg-4" value="{{ old('avatar', $student->avatar) }}" />
            </div>
            <div>
                <x-form.submit-button>Cadastrar Aluno</x-form.submit-button>
                <small class="float-right text-secondary">Se o CEP digitado no campo for válido o sistema irá automaticamente procurar os dados referentes</small>
            </div>
        </div>
    </x-admin.form>

</x-admin.layout>

