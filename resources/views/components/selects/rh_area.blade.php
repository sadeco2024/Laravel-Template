@props([
    'conceptos' => [],
    'name' => 'area_rh_extra_id',
    'text' => 'Área',
    'icono' => 'bi bi-textarea-t',
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
            @foreach ($conceptos['area'] as $concepto)
                <option @if ($value == $concepto['id']) selected @endif value="{{ $concepto['id'] }}">
                    {{ $concepto['descripcion'] }}</option>
            @endforeach
        </select>
        </select>
        <button type="button" data-concepto="area" class="rhExtras btn btn-sm btn-secondary-transparent">
            <i class="bi bi-plus-circle"></i>
        </button>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
