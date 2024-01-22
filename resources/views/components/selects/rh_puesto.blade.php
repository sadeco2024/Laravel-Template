@props([
    'conceptos' => [],
    'name' => 'puesto_rh_extra_id',
    'text' => 'Puesto',
    'icono' => 'bi bi-people-fill',
    'value' => '',
])

<div class="form-group mb-2">
    <label class="form-label mb-0">{{ $text }}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icono }}"></i>
        </div>
        <select class="form-select" id="{{ $name }}" name="{{ $name }}">
            <option value="" @if (!old($name)) selected @endif>- Selecciona - </option>
            @foreach ($conceptos['puesto'] as $concepto)
                <option @if ($value == $concepto['id']) selected @endif value="{{ $concepto['id'] }}">
                    {{ $concepto['descripcion'] }}</option>
            @endforeach
        </select>
        </select>
        <button type="button" data-concepto="puesto" class="rhExtras btn btn-sm btn-secondary-transparent">
            <i class="bi bi-plus-circle"></i>
        </button>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
