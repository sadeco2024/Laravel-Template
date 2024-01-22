@props([
    'name' => 'telefono',
    'text' => 'Teléfono',
    'icon' => 'bi bi-telephone',
    'value' => '',
])


<div class="form-group mb-2">
    <label class="form-label mb-0">{{ $text }}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="number" name="{{ $name }}" id="{{ $name }}" class="form-control numeros" placeholder=""
            value="{{ $value }}" maxlength="10">
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
