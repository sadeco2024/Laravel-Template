@props(['name'=>'nombre','text'=>'Importe','icon'=>'bi bi-coin', 'value'=>''])

<div class="form-group mb-2">
    <label class="form-label mb-0">{{$text}}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control importe" placeholder=""
            value="{{ $value }}" pattern="[0-9.]" >
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>

