@props(['name','nome','bsclass' => null,'classrooms'])

<div class="form-group {{ $bsclass }}">
    <x-form.label name="{{ $name }}">{{ ucwords($nome) }}</x-form.label>
    <select {{ $attributes->merge(['class' => 'form-control']) }} id="{{ $name }}" name="{{ $name }}">
        @foreach($classrooms as $classroom)
            <option value="{{ $classroom->id }}">{{ $classroom->class }}</option>
        @endforeach
    </select>
</div>
