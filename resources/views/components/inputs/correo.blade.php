
@props(['name'=>'correo', 'icon'=>'bi bi-envelope-at','value'=>''])

<div class="form-group mb-2">
    <label class="form-label">Correo</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{$icon}}"></i>
        </div>
        <input type="email" name="{{$name}}" id="{{$name}}" class="form-control" placeholder="" 
        value="{{ $value!='' ? $value : (isset($request->name) ? $request->name : old($name)) }}">
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>