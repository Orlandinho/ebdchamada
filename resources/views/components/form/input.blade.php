@props(['name', 'nome', 'bsclass' => null])

<div class="form-group {{ $bsclass }}">
    <x-form.label name="{{ $name }}">{{ ucwords($nome) }}</x-form.label>
    <input id="{{ $name }}" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}">
    <x-form.errors name="{{ $name }}" />
</div>
