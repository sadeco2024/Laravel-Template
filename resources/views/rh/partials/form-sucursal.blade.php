
@php 
    $formGet =  $sucursal ?? old() ?? null; 
@endphp

<div class="row">
    <div class="col-xxl-6 col-xl-6 col-md-12">
        <div class="row order-1">
            <x-hr-form :text="'Generales'" />
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.sucursal :text="'Nombre'" name:="'nombre" value="{{ old('nombre', $formGet->nombre ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.telefono :text="'Teléfono'" value="{{ old('telefono', $formGet->telefono->telefono ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.correo :text="'Correo'" value="{{old('correo', $formGet->correo->correo ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.fecha :name="'fecha_apertura'" :text="'Fecha apertura'"
                value="{{old('fecha_apertura', $formGet->fecha_apertura ?? '') }}" />
                    
            </div>
        </div>
        <div class="row order-3">
            <x-hr-form :text="'Recursos Humanos'" />
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.rh_gerente value="{{old('gerente_empleado_id', $formGet->gerente_empleado_id ?? '') }}" />

            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.rh_supervisor value="{{old('supervisor_empleado_id', $formGet->supervisor_empleado_id ?? '') }}" />

            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.rh_encargado value="{{old('encargado_empleado_id', $formGet->encargado_empleado_id ?? '') }}" />
            </div>
        </div>
        <div class="row order-2 ">
            <x-hr-form :text="'Configuraciones'" />
            <div class="col-xxl-6 col-md-6">
                @php $concepto = old('tipo_concepto', $formGet->tipo->concepto ?? 'Tienda'); @endphp
                <x-inputs.tipo-radio :text="'Tipo'" :tipos="['Almacén', 'Tienda']" :color="['warning', 'info']"
                    checked="{{ $concepto }}" :name="'tipo_concepto'"
                    value="{{old('tipo_concepto',$formGet->tipo->concepto ?? 'Tienda') }}" />
            </div>
            <div class="col-xxl-6 col-md-6">
                @php $estatus = old('estatus',$formGet->estatus->estatus ?? 'Abierta'); @endphp
                <x-inputs.tipo-radio :text="'Estatus'" :tipos="['Abierta', 'Suspendida', 'Cerrada']" :color="['success', 'warning', 'danger']"
                    checked="{{ $estatus }}" :name="'estatus'"
                    value="{{old('estatus', $formGet->estatus->estatus ?? 'Abierta') }}" />
            </div>
            <div class="col-xxl-12 col-md-12 mt-xxl-3">
                @php $comentario = old('comentario', $formGet->comentario->comentario ?? '') ; @endphp
                <x-inputs.descripcion-textarea :name="'comentario'" :text="'Comentarios'"
                value="{{old('comentario', $comentario) }}" />                
                  
            </div>
        </div>
    </div>

    <div class="col-xxl-6 col-md-12">
        <div class="row order-2">
            <x-hr-form :text="'Dirección'" />
            <div class="col-xxl-12">
                @include('rh.partials.form-direccion')
            </div>
        </div>
    </div>

    <hr class="col-xxl-12 mt-0" />

    <div class="col-md-12 d-flex justify-content-end justify-content-xl-start">
        <button class="btn btn-primary btn-submit me-2" type="submit">
            {{ $btnText }}
        </button>
        <a href="{{ route('rh.sucursales.index') }}" class="btn btn-light">Cancelar</a>
        {{-- <button type="close" class="btn btn-light">Cancelar</button> --}}
    </div>

</div>
