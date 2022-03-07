<x-admin.layout>

    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form route="/admin/students/{{ $student->slug }}" method="PATCH" file="enctype=multipart/form-data" name="{{ $student->name }}">
        <div class="card-body">
            <div class="form-row">
                <x-form.input name="name" bsclass="col-lg-8" :value="old('name', $student->name)" nome="nome completo" />
                <x-form.input name="dob" nome="data nasc" bsclass="col-lg-2" :value="old('dob', $student->getDob())" />
                <x-form.select name="classroom_id" nome="classe" bsclass="col-lg-2" :selected="old('classroom_id', $student?->classroom_id)" :classrooms="$classrooms"/>
            </div>
            <div class="form-row">
                <x-form.input name="zipcode" nome="CEP" bsclass="col-lg-2" :value="old('zipcode', $student->information?->zipcode)" />
                <x-form.input name="address" nome="endereço" bsclass="col-lg-5" :value="old('address', $student->information?->address)" />
                <x-form.input name="neighborhood" nome="bairro" bsclass="col-lg-3" :value="old('neighborhood', $student->information?->neighborhood)" />
                <x-form.input name="city" nome="cidade" bsclass="col-lg-2" :value="old('city', $student->information?->city)" />
            </div>
            <div class="form-row">
                <x-form.input name="cel" nome="celular" bsclass="col-lg-2" :value="old('cel', $student->information?->cel)" />
                <x-form.input name="tel" nome="tel fixo" bsclass="col-lg-2" :value="old('tel', $student->information?->tel)" />
                <x-form.input name="email" nome="e-mail" type="email" bsclass="col-lg-3" :value="old('email', $student?->email)" />
                <x-form.input name="avatar" nome="foto" type="file" bsclass="col-lg-3" :value="old('avatar', $student?->avatar)" />
                @if($student->avatar)
                    <div class="col-lg-2">
                        <img src="{{ asset('storage/'.$student->avatar) }}" class="rounded elevation-2 d-block mx-auto" style="width: 96px;" alt="User Image">
                    </div>
                @else
                    <p class="my-auto mx-auto">Não há foto</p>
                @endif
            </div>
            <div class="form-row">
                <div class="form-group ml-2">
                    <x-form.checkbox-visitant name="active" :confirm="$student->active" nome="ativo"/>
                </div>
                <div class="form-group ml-3">
                    <x-form.checkbox-visitant name="visitor" :confirm="$student->visitor" nome="visitante"/>
                </div>
            </div>
            <div>
                <x-form.submit-button>Atualizar Dados</x-form.submit-button>
                <small class="float-right text-secondary">Se o CEP digitado no campo for válido o sistema irá automaticamente procurar os dados referentes</small>
            </div>
        </div>
    </x-admin.form>

</x-admin.layout>

