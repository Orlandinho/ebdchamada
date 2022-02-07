@props(['name','nome','classrooms'])

<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <x-form.label name="{{ $name }}">{{ ucwords($nome) }}</x-form.label>
    <select class="form-control select2" id="{{ $name }}" name="{{ $name }}">
        @foreach($classrooms as $classroom)
            <option value="{{ $classroom->id }}">{{ $classroom->class }}</option>
        @endforeach
    </select>
</div>
