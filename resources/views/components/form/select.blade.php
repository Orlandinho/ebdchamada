@props(['name','nome','teachers'])

<div class="form-group">
    <x-form.label name="{{ $name }}">{{ ucwords($nome) }}</x-form.label><small class="text-info float-right">É possível selecionar mais de um professor</small>
    <select class="select2" name="{{ $name }}[]" {{ $teachers->count() < 1 ? 'disabled' : '' }} style="width: 100%" data-placeholder="{{ $teachers->count() < 1 ? 'Não há professores disponíveis' : 'Clique para ver uma lista de professores disponíveis' }}" multiple>
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}" {{ old($name) }}>{{ $teacher->name }}</option>
        @endforeach
    </select>
</div>
