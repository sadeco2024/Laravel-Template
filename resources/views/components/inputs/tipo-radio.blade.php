@props([
    'name'=>'tipo_concepto_id',
    'text'=>'Sucursal',
    'tipos'=>[],
    'color'=>['primary','secondary','success','danger','warning','info','light','dark'],
    'checked'=>''
])


<div class="form-group mb-2">
    <label class="form-label">{{$text}}</label>
    <div class="input-group">


        <div class="btn-group" role="group" aria-label="Basic outlined example">
        @foreach ($tipos as $index => $tipo) 
            <input type="radio" class="btn-check" @if($checked == $tipo || (isset($sucursal) && $sucursal->tipo->concepto == $tipo)) checked @endif name="{{$name}}" id="btn-check-{{$tipo}}"
                autocomplete="off" value="{{$tipo}}">
            <label class="btn btn-outline-{{$color[$index]}} btn-wave" for="btn-check-{{$tipo}}">{{$tipo}}</label>        
        @endforeach
        </div>
    </div>
</div>