@props(['name'=>'colonia', 'icon'=>'ri-bank-line', 'value'=>'', 'max'=>'100'])

<div class="form-group mb-2">
    <label class="form-label mb-0">Colonia</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{$icon}}"></i>
        </div>
        <input 
            type="text" 
            name="{{$name}}" 
            id="{{$name}}" 
            {{$attributes->merge(['class' => 'form-control'])}}
            placeholder="" 
            value="{{ $value }}"
            maxlength="{{$max}}"
        >        
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>