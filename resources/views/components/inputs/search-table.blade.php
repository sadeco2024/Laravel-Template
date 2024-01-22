
@props(['name'=>'searchDatatable', 'icon'=>'bi bi-search'])

<div class="form-group">
    {{-- <label class="form-label">Nombre</label> --}}
    <div class="input-group">
        <div class="input-group-text bg-info-transparent">
            <i class="  {{$icon}}"></i>
        </div>
        <input
            name="{{$name}}"
            id="{{$name}}"
            {{-- value="{{isset($request->name) ? $request->name : old($name) }}" --}}
            class="form-control form-control-sm" 
            type="text" 
            placeholder="Busca aquí" 
            aria-label="Buscar empleado"
        >
        {{-- <input type="text" name="{{$name}}" id="{{$name}}" class="form-control" placeholder="" value="{{isset($request->name) ? $request->name : old($name) }}"> --}}
    </div>
    {{-- <x-input-error-line :messages="$errors->get($name)" /> --}}
</div>