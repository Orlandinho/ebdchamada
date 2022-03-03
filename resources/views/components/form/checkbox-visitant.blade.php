@props(['name', 'nome', 'confirm' => null])

<div class="form-check">
    <input type="checkbox" class="form-check-input" name="{{ $name }}" {{ $confirm ? 'checked' : null }} value="1" id="{{ $name }}">
    <label class="form-check-label" for="{{ $name }}">{{ ucwords($nome) }}</label>
</div>
