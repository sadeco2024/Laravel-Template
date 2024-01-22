

@php
    $formGet = $empleado ?? (old() ?? null);
    
@endphp
<div class="row">
    {{-- Información personal --}}
    <div class="col-6  order-1">
        <x-hr-form :text="'Información personal'" />
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.name :text="'Nombre'" :name="'primer_nombre'" :icon="'bi bi-person-video'"
                    value="{{ old('primer_nombre', $formGet->nombre->primer_nombre ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.name :text="'Segundo nombre'" :name="'segundo_nombre'" :icon="'bi bi-person-video3'"
                    value="{{ old('segundo_nombre', $formGet->nombre->segundo_nombre ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.name :text="'Apellido paterno'" :name="'paterno'" :icon="'bi-person-vcard'"
                    value="{{ old('paterno', $formGet->nombre->paterno ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">

                <x-inputs.name :text="'Apelido materno'" :name="'materno'" :icon="'bi-person-video2'"
                    value="{{ old('materno', $formGet->nombre->materno ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.fecha :name="'fecha_nacimiento'" :text="'Fecha nacimiento'"
                    value="{{ old('fecha_nacimiento', $formGet->fecha_nacimiento ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-md-6">
                <x-inputs.genero-radio value="{{ old('genero', $formGet->genero ?? 'F') }}" />
            </div>
        </div>
    </div>
    {{-- Dirección --}}
    <div class="col-6 order-3">
        <x-hr-form :text="'Dirección'" />
        {{-- Form::direccion --}}
        <div class="row">
            @include('rh.partials.form-direccion')
        </div>
    </div>
    {{-- Contacto --}}
    <div class="col-6 order-2">
        <x-hr-form :text="'Datos de contacto'" />
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.telefono :text="'Teléfono'"
                    value="{{ old('telefono', $formGet->telefono->telefono ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.correo :text="'Correo'" value="{{ old('correo', $formGet->correo->correo ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.telefono :text="'Teléfono corporativo'" :name="'telefono_corporativo'"
                    value="{{ old('telefono_corporativo', $formGet->telefonoCorporativo->telefono ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.correo :text="'Correo corporativo'"  :name="'correo_corporativo'"
                value="{{ old('correo_corporativo', $formGet->correoCorporativo->correo ?? '') }}" />
                
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.name :text="'CURP'" :name="'curp'" :icon="'ri-file-paper-line'" class="upper"
                    value="{{ old('curp', $formGet->nombre->curp->curp ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 mb-2">
                <x-inputs.name :text="'RFC'" :name="'rfc'" :icon="'bi bi-card-checklist'" class="upper"
                    value="{{ old('rfc', $formGet->rfc->rfc ?? '') }}" />
            </div>            
        </div>
    </div>
    {{-- Recursos Humanos --}}
    <div class="col-6 order-4">
        <x-hr-form :text="'Recursos Humanos'" />
        <div class="row">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.rh_departamento :conceptos="$rhextras"
                    value="{{ old('departamento_rh_extra_id', $formGet->departamento_rh_extra_id ?? '') }}" />
            </div>
            {{-- @dd($rhextras) --}}
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.rh_area :conceptos="$rhextras"
                    value="{{ old('area_rh_extra_id', $formGet->area_rh_extra_id ?? '') }}" />
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2 align-items-end">
                <x-selects.rh_puesto :conceptos="$rhextras"
                    value="{{ old('puesto_rh_extra_id', $formGet->puesto_rh_extra_id ?? '') }}" />
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2 align-items-end">
                <x-selects.sucursal :sucursales="$sucursales" value="{{ old('sucursal_id', $formGet->sucursal_id ?? '') }}" />
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 mb-2">
                <x-selects.rh_contrato :conceptos="$rhextras"
                    value="{{ old('tipo_contrato_rh_extra_id', $formGet->tipo_contrato_rh_extra_id ?? '') }}" />
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 mb-2">
                <x-inputs.fecha :name="'fecha_ingreso'" :text="'Fecha Ingreso'" :icon="'bi bi-calendar-check'"
                    value="{{ old('fecha_ingreso', $formGet->fecha_ingreso ?? now()->format('Y-m-d')) }}" />
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-6 mb-2">
                <x-inputs.name :text="'No. Empleado'" :name="'no_empleado'" :icon="'bi bi-0-square'"
                    value="{{ old('no_empleado', $formGet->no_empleado ?? '') }}" />
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 mb-2">
                <x-inputs.importe :text="'Sueldo base'" :name="'sueldo'"
                    value="{{ old('sueldo', $formGet->sueldo ?? '') }}" />
            </div>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 mb-2">
                <x-inputs.importe :text="'Cuenta bancaria'" :name="'cuenta_banco'" :icon="'bi bi-cash-stack'"
                    value="{{ old('cuenta_banco', $formGet->cuenta_banco ?? '') }}" />
            </div>
            <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 mb-2">
                <x-inputs.descripcion-textarea :name="'observaciones'" :text="'Observaciones'" class="noenter"
                    value="{{ old('observaciones', $formGet->observaciones ?? '') }}" />
            </div>
        </div>
    </div>
</div>
