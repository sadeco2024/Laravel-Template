
@props(['name'=>'correo', 'icon'=>'bi bi-envelope-at','value'=>'','text'=>'Correo'])

<div class="form-group mb-2">
    <label class="form-label mb-0">{{$text}}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{$icon}}"></i>
        </div>
        <input type="email" name="{{$name}}" id="{{$name}}" class="form-control" placeholder="" 
        value="{{ $value }}">
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>