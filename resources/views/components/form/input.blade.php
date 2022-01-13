@props(['name', 'nome'])

<div class="form-group">
    <x-form.label name="{{ $name }}" nome="{{ $nome }}" />
    <input class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{ ucwords($nome) }}">
    <x-form.errors name="{{ $name }}" />
</div>
