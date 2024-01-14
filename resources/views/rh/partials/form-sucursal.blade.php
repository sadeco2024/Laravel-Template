

{{-- <br>{{$sucursales}} --}}


<div class="row">
    <div class="col-xxl-6 col-xl-6 col-md-12">
        <div class="row order-1">
            <x-hr-form :text="'Generales'" />
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.sucursal :text="'Nombre'" name:="'nombre" value="{{ isset($sucursal) ? $sucursal->nombre : ''}}"/>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.telefono :text="'Teléfono'" value="{{ isset($sucursal) ? $sucursal->telefono->telefono : ''}}"/>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.correo :text="'Correo'" value="{{isset($sucursal) ? $sucursal->correo->correo : null}}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.fecha :name="'fecha_apertura'" :text="'Fecha apertura'" value="{{isset($sucursal) ? $sucursal->fecha_apertura : ''}}" />
            </div>
        </div>
        <div class="row order-3">
            <x-hr-form :text="'Recursos Humanos'" />
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.empleado :text="'Gerente'" :icono="'bi bi-person-bounding-box'" :name="'gerente_empleado_id'" value="{{isset($sucursal) ? $sucursal->gerente_empleado_id : ''}}" />
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.empleado :text="'Supervisor'" :icono="'bi bi-person-check'" :name="'supervisor_empleado_id'" value="{{isset($sucursal) ? $sucursal->supervisor_empleado_id : ''}}" />
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.empleado :text="'Encargado'" :icono="'bi bi-person-circle'" :name="'encargado_empleado_id'" value="{{isset($sucursal) ? $sucursal->encargado_empleado_id : ''}}" />
            </div>
        </div>
        <div class="row order-2 align-bottom">
            <x-hr-form :text="'Configuraciones'" />
            <div class="col-xxl-6 col-md-6">
                @php $tipo = isset($sucursal) ? $sucursal->tipo->concepto : "Tienda"; @endphp
                <x-inputs.tipo-radio :text="'Tipo sucursal'" :tipos="['Almacén', 'Tienda']" :color="['warning', 'info']"
                    checked="{{$tipo}}" :name="'tipo_concepto'" value="{{isset($sucursal) ? $sucursal->tipo->concepto : ''}}" />
            </div>
            <div class="col-xxl-6 col-md-6">
                @php $estatus = isset($sucursal) ? $sucursal->estatus->estatus : "Abierta"; @endphp
                <x-inputs.tipo-radio :text="'Estatus'" :tipos="['Abierta', 'Suspendida', 'Cerrada']" :color="['success', 'warning', 'danger']"
                    checked="{{$estatus}}" :name="'estatus'" value="{{isset($sucursal) ? $sucursal->estatus->estatus : ''}}" />
            </div>
            <div class="col-xxl-12 col-md-12 mt-xxl-3">
                <x-inputs.descripcion-textarea :name="'comentario'" :text="'Comentarios'" 
                value="{{isset($sucursal->comentario) ? $sucursal->comentario->comentario : ''}}" />
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
        <button class="btn btn-primary me-2" type="submit">
            {{ $btnText }}
        </button>
        <button type="close" class="btn btn-light">Cancelar</button>
    </div>

</div>