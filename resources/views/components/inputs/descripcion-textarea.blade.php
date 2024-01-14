@props([
    'name'=>'descripcion',
    'icon'=>'bi bi-pencil-square',
    'enter'=>false,
    'text'=>'Descripción',
    'value'=>''
    ])
@php
if ($value!='') {
    $value=$value;
} elseif (isset($request->$name)) {
    $value=$request->$name;
} else {
    $value=old($name);
}
    
@endphp

{{-- @if(isset($request->descripcion)){{$request->descripcion}}@elseif($value){{$value}}@else{{old($name)}}@endif --}}
<div class="form-group mb-2">
    <label class="form-label">{{$text}}</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{$icon}}"></i>
        </div>
        <textarea name="{{$name}}" id="pdescripcion" class="form-control {{ $enter ? '' : 'noenter' }}" rows="3" >{{$value}}</textarea>

  
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>