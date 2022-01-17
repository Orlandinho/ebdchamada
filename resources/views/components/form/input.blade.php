@props(['name', 'nome'])

<div class="form-group">
    <x-form.label name="{{ $name }}">{{ ucwords($nome) }}</x-form.label>
    <input class="form-control" id="{{ $name }}" {{ $attributes([ 'value' => old($name)]) }} name="{{ $name }}" placeholder="{{ ucwords($nome) }}">
    <x-form.errors name="{{ $name }}" />
</div>
