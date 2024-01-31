@props([
    'sucursales'=>[],
    'name'=>'sucursal_id',
    'text'=>'Sucursal',
    'icono'=>'bi bi-shop',
    'value'=>''
])



<div class="form-group mb-2">
    <label class="form-label mb-0">{{$text}}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icono}}"></i>
        </div>
        <select class="form-select" id="{{$name}}" name="{{ $name }}" >
            
            {{-- <option value="" @if (!old($name)) selected @endif>- Selecciona - </option> --}}
            @foreach ($sucursales->sortBy('nombre') as $sucursal)
                <option @if ($value == $sucursal->id) selected @endif value="{{ $sucursal->id }}">
                    {{ $sucursal->nombre }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>
