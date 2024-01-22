
@props(['name'=>'numero_exterior', 'icon'=>'bi bi-hash', 'value'=>''])

<div class="form-group mb-2">
    <label class="form-label mb-0">No. Exterior</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{$icon}}"></i>
        </div>
        <input
            type="text" 
            name="{{$name}}" 
            id="{{$name}}"
            class="form-control"
            placeholder=""         
            value="{{ $value }}"
            maxlength="20"
        >
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>