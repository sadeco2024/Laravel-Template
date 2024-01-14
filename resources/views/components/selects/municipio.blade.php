@props(['municipios'=>[], 'name'=>'municipio_id', 'value'=>''])

<div class="form-group mb-2">
    <label class="form-label">Municipio</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="ri-government-line"></i>
        </div>
        <select class="form-select" id="{{$name}}" name="{{ $name }}" required edit-id="{{ old($name) ? old($name) : $value}}">
            <option @if (!old($name)) selected @endif>- Selecciona -</option>
            @foreach ($municipios as $municipio)
                <option @if (old($name) == $municipio->id || $value == $municipio->id || $request->id==$municipio->id) selected @endif 
                value="{{ $municipio->id }}"> {{ $municipio->municipio }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>


