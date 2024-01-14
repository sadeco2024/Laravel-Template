@props(['name'=>'nombre','text'=>'Sucursal','icon'=>'bi bi-shop', 'value'=>''])


<div class="form-group mb-2">
    <label class="form-label">{{$text}}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control" placeholder=""
            value="{{ $value!='' ? $value : (isset($request->nombre) ? $request->nombre : old($name)) }}">
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>