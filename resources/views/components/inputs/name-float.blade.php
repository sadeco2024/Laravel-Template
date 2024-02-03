@props(['name'=>'name', 'text'=>'Nombre', 'value'=>'', 'disabled'=>false])
<div class="form-floating">
    <input 
        type="text"
        class="form-control @error($name) is-invalid @enderror"
        name="{{$name}}" 
        id="{{$name}}"        
        placeholder="Nombre del rol" 
        value="{{$value}}"
        {{ empty($disabled) ? '' : 'disabled'}}
    >
    <label for="floatingInput">
        {{$text }}
    </label>
    <x-input-error-line :messages="$errors->get($name)" />

</div>