@props(['name' => 'fecha', 'text' => 'Fecha', 'icon' => 'bi bi-calendar-week', 'value'=>''])

<div class="form-group mb-2">
    <label class="form-label">{{ $text }}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="date" name="{{ $name }}" id="{{ $name }}" class="form-control flatpickr-input active" placeholder=""
            aria-label="Fecha Apertura" value="{{ $value!='' ? $value : (isset($request->name) ? $request->name : old($name)) }}">
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>

