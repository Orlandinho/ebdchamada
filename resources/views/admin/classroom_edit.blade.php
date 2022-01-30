<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form method="PATCH" route="/admin/classrooms/{{ $classroom->slug }}" name="Editando a classe {{ $classroom->class }}">
        <div class="card-body">
            <div class="col-md-6">
                <x-form.input name="class" nome="classe" :value="old('class', $classroom->class)" autofocus/>
                <x-form.input name="description" nome="descrição" :value="old('slug', $classroom->description)"/>
                <div class="form-group">
                    <x-form.label name="name">{{ $classroom->id === 1 ? 'Superintendente' : 'Professores' }}</x-form.label>
                    <small class="text-info float-right">É possível selecionar mais de um professor</small>
                    <select class="select2" name="name[]"
                            {{ $teachers->count() < 1 ? 'disabled' : '' }} style="width: 100%"
                            data-placeholder="{{ $teachers->count() < 1 ? 'Não há professores disponíveis' : 'Clique para ver uma lista de professores disponíveis' }}"
                            multiple>
                        @foreach($teachers as $teacher)
                            <option
                                value="{{ $teacher->id }}" {{ ($teacher->classroom_id === $classroom->id) ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-form.submit-button>Atualizar</x-form.submit-button>
            </div>
            <div class="col-md-6">
                <p class="h5">Alunos sem classe definida</p>
            </div>
        </div>
    </x-admin.form>

</x-admin.layout>
