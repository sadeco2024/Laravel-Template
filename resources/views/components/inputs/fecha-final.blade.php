@props(['name' => 'fecha', 'text' => 'Fecha', 'icon' => 'bi bi-calendar2-event', 'value'=>''])

<div class="form-group mb-2">
    <label class="form-label mb-0">{{ $text }}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="date" name="{{ $name }}" id="{{ $name }}" class="form-control flatpickr-input active" placeholder=""
            aria-label="Fecha Apertura" value="{{ $value }}">
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>

