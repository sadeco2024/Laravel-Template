@props(['empleados'=>[], 'name'=>'empleado_id','text'=>'Empleado','icono'=>'bi bi-person-badge'])

<div class="form-group mb-2">
    <label class="form-label">{{$text}}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icono}}"></i>
        </div>
        <select class="form-select" id="{{$name}}" name="{{ $name }}" required>
            
            <option value="" @if (!old($name)) selected @endif>- Selecciona - </option>
            @foreach ($empleados as $empleado)
                <option @if (old($name) == $empleado->id) selected @endif value="{{ $empleado->id }}">
                    {{ $empleado->nombre }}</option>
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>