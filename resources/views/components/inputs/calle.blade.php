
@props(['name'=>'calle', 'icon'=>'bi bi-signpost', 'value'=>''])

<div class="form-group mb-2">
    <label class="form-label mb-0">Calle</label>
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
        >
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>