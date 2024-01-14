@props(['maximo', 'name'=>'orden'])

<div class="form-group mb-2">
    <label for="form-text1" class="form-label fs-14 text-dark">Orden</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="bi bi-list-ol"></i>
        </div>
        <select class="form-select" name="{{ $name }}">
            //recorrer de 1 hasta el valor de $maximo
            @for ($i = 1; $i <= $maximo; $i++)
                <option @if (old($name) == $i) selected @endif value="{{ $i }}">{{ $i }}</option>
            @endfor

            
            {{-- @foreach ($conceptos as $concepto)
                <option @if (old($name) == $concepto->id) selected @endif value="{{ $concepto->id }}">
                    {{ $concepto->concepto }}</option>
            @endforeach --}}
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
