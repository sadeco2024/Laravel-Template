@props(['modulos', 'name'=>'cg_modulo_id', 'selected'=>''])

<div class="form-group mb-2">
    <label for="form-text1" class="form-label fs-14 text-dark">Módulo</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="bi bi-collection-fill"></i>
        </div>
        <select class="form-select" name="{{ $name }}" required>
            <option @if (!old($name)) selected @endif>Selecciona un módulo</option>
            @foreach ($modulos as $modulo)
                <option @if ($selected == $modulo->id) selected @endif value="{{ $modulo->id }}">
                    {{ $modulo->nombre }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
