@props(['conceptos', 'name'=>'tipo_concepto_id', 'selected'=>''])
<div class="form-group mb-2">
    <label for="form-text mb-0" class="form-label fs-14 text-dark">Tipo</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="bi bi-check2-square"></i>
        </div>
        <select class="form-select habilita" name="{{ $name }}">
            @foreach ($conceptos as $concepto)
                <option @if ($selected == $concepto->id) selected @endif value="{{ $concepto->id }}">
                    {{ $concepto->concepto }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
