<x-admin.layout>
    <x-admin.navbar />

    <x-admin.sidebar :data="$data" />

    <x-admin.form method="PATCH" route="/admin/classrooms/{{ $classroom->slug }}" button="Atualizar" name="{{ $classroom->class }}" header="Editando a classe {{ $classroom->class }}">
        <x-form.input name="class" nome="classe" :value="old('class', $classroom->class)" autofocus />
        <x-form.input name="description" nome="descrição" :value="old('slug', $classroom->description)" />
        <div class="form-group">
            <x-form.label name="name">{{ $classroom->id === 1 ? 'Superintendente' : 'Professores' }}</x-form.label><small class="text-info float-right">É possível selecionar mais de um professor</small>
            <select class="select2" name="name[]" {{ $teachers->count() < 1 ? 'disabled' : '' }} style="width: 100%" data-placeholder="{{ $teachers->count() < 1 ? 'Não há professores disponíveis' : 'Clique para ver uma lista de professores disponíveis' }}" multiple>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ ($teacher->classroom_id === $classroom->id) ? 'selected' : '' }}>{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>
    </x-admin.form>
</x-admin.layout>
