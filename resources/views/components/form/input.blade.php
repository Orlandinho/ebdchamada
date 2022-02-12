@props(['name', 'nome', 'type' => ''])

<div {{ $attributes->merge(['class' => 'form-group']) }}>
    <x-form.label name="{{ $name }}">{{ ucwords($nome) }}</x-form.label>
    <input id="{{ $name }}" class="form-control" type="{{ empty($type) ? 'text' : $type }}" {{ $nome = 'nome' ? 'autofocus' : '' }} value="{{ old($name) }}" name="{{ $name }}">
    <x-form.errors name="{{ $name }}" />
</div>
