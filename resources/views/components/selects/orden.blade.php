@props(['maximo', 'name'=>'orden', 'selected'=>''])
<div class="form-group mb-2">
    <label for="form-text1" class="form-label fs-14 text-dark">Orden</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="bi bi-list-ol"></i>
        </div>
        <select class="form-select" name="{{ $name }}">
            //recorrer de 1 hasta el valor de $maximo
            @for ($i = 0; $i <= $maximo; $i++)
                <option @if ($selected == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
