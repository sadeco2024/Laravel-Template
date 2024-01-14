@props(['estados', 'name'=>'estado_id','value'=>''])

<div class="form-group mb-2">
    <label class="form-label">Estado</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="ri-community-line"></i>
        </div>
        <select class="form-select" id="{{$name}}" name="{{ $name }}" required>
            
            <option @if (!old($name)) selected @endif>- Selecciona - </option>
            @foreach ($estados as $estado)
                <option @if (old($name) == $estado->id || $value==$estado->id) selected @endif value="{{ $estado->id }}">
                    {{ $estado->estado }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>


