<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar />

    <x-admin.form method="PATCH" route="/admin/classrooms/{{ $classroom->slug }}" name="Editando a classe {{ $classroom->class }}">
        <div class="card-body d-flex">
            <div class="col-md-4">
                <x-form.input name="class" nome="classe" :value="old('class', $classroom->class)" autofocus />
                <x-form.input name="description" nome="descrição" :value="old('description', $classroom->description)"/>
                <div class="form-group">
                    <x-form.label name="name">{{ $classroom->id === 1 ? 'Superintendente' : 'Professores' }}</x-form.label>
                    <small class="text-secondary float-right">É possível selecionar mais de um professor</small>
                    <select class="select2" name="name[]"
                            {{ $teachers->count() < 1 ? 'disabled' : '' }} style="width: 100%"
                            data-placeholder="{{ $teachers->count() < 1 ? 'Não há professores disponíveis' : 'Professores disponíveis' }}"
                            multiple>
                        @foreach($teachers as $teacher)
                            <option
                                value="{{ $teacher->id }}" {{ ($teacher->classroom_id === $classroom->id) ? 'selected' : '' }}>{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-form.submit-button>Atualizar</x-form.submit-button>
            </div>
            <div class="col-md-8">
                <label>Alunos</label>
                <div class="container rounded-sm pt-2 pl-2" style="height: 260px; border: solid 1px #ccc; overflow: auto">
                    <div class="row">
                        <div class="col-md-6">
                            @foreach($students as $student)
                                @if($loop->odd)
                                    <x-form.checkbox :student="$student" />
                                @endif
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            @foreach($students as $student)
                                @if($loop->even)
                                    <x-form.checkbox :student="$student" />
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-admin.form>

</x-admin.layout>
