
@props(['name'=>'passwd', 'icon'=>'bi bi-unlock','text'=>'Contraseña', 'value'=>''])

<div class="form-group mb-2">
    <label class="form-label mb-0">{{$text}}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{$icon}}"></i>
        </div>
        <input
            type="text"
            name="{{$name}}" 
            id="{{$name}}"
            {{ $attributes->merge(['class' => 'form-control']) }}
            {{-- class= "form-control" --}}
            placeholder="" 
            value="{{ $value }}"
            {{-- value="{{isset($request->name) ? $request->name : old($name) }}"> --}}
            >
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>