@extends('layouts.auth')
@section('title', config('app.name') . ' - Lista de empleados')
@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection
@section('title-view', 'Lista de empleados')
@section('content')


@section('css')

@endsection





<div class="row">
    {{-- Barra de información --}}
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body d-flex align-items-baseline align-items-start flex-wrap">
                {{-- Información --}}
                {{-- TODO: Cuadros informativos, search, filtros --}}
                {{-- <div class="card-title mt-1"> --}}
                
                {{-- </div>                 --}}
                <div class="flex-fill">
                    {{-- <span class="mb-0 fs-14 text-muted">Empleados</span> --}}
                    <span id="totActivos" class="badge bg-outline-success ms-2" title="Activos">10</span>
                    <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Suspendidos">4</span>
                    <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja">1</span>

                </div>
                <div class="align-baseline  justify-content-start ">
                    <a href="{{ route('rh.empleados.create') }}" type="button"
                        class="btn btn-sm btn-success-transparent">
                        <i class="bi bi-plus"></i>
                        Agregar Empleado
                    </a>
                </div>

                {{-- Agregar Empleado --}}


            </div>
        </div>
    </div>
    {{-- Tabla de empleados --}}
    <div class="col-xl-8">
        <div class="card custom-card overflow-hidden">
            <div class="card-header  justify-content-between">
                <x-inputs.search-table name="tblEmpleadosInput" />
                <div class="d-flex " id="tblEmpleadosBtn"></div>

            </div>

            {{-- Tabla de empleados --}}
            <div class="card-body">
                <div class="row table-responsive">
                    <table id="tblEmpleados" class="table table-hover text-nowrap"></table>

                </div>
            </div>

        </div>
    </div>

    {{-- TABS de información --}}
    <div class="col-xl-4">
        {{-- <div class="col-12 col-xl-4 col-lg-6 col-md-6 col-sm-8 order-0 order-xl-1"> --}}
        <div class="card custom-card ">
            <div class="">
                {{-- Tabs --}}
                <ul class="nav nav-tabs tab-style-2 nav-justified mb-0 border-bottom d-flex" role="tablist">
                    <li class="nav-item border-end me-0" role="tab">
                        <button class="nav-link active h-100" data-bs-toggle="tab" data-bs-target="#sucursales-tab-pane"
                            type="button" role="tab" aria-controls="sucursales-tab-pane" aria-selected="true"><i
                                class="bi bi-building me-1 align-middle d-inline-block"></i>Sucursales</button>
                    </li>
                    <li class="nav-item border-end me-0" role="tab">
                        <button class="nav-link h-100" data-bs-toggle="tab" data-bs-target="#puestos-tab-pane"
                            type="button" role="tab" aria-controls="puestos-tab-pane" aria-selected="false">
                            <i class="ri-chat-smile-2-line  me-1 align-middle d-inline-block"></i>Puestos</button>
                    </li>
                </ul>
                {{-- Tabs - content --}}
                <div class="tab-content">
                    {{-- Sucursales --}}
                    <div id="sucursales-tab-pane" class="tab-pane fade show active border-0" role="tabpanel"
                        aria-labelledby="config-tab" tabindex="0">
                        {{-- <ul class="list-group list-group-flush list-unstyled ">
                                    @php
                                        $tipo = 0;
                                        $susp = false;
                                    @endphp
                                    @foreach ($sucursales as $sucursal)
                                        @if ($tipo != $sucursal->tipo)
                                            @switch($sucursal->tipo)
                                                @case('Almacén')
                                                    <li class="pb-0">
                                                        <p class="text-primary fs-12 fw-medium mb-2 op-7">Almacenes</p>
                                                    </li>
                                                @break

                                                @case('Tienda')
                                                    <li class="pb-0 mt-2">
                                                        <p class="text-secondary fs-12 fw-medium mb-0">Tiendas</p>
                                                    </li>
                                                @break
                                            @endswitch
                                            @php $tipo=$sucursal->tipo; @endphp
                                        @endif
                                        @if ($sucursal->estatus != 'activo' && $susp == false)
                                            @php $susp=true; @endphp
                                            <li class="pb-0 mt-3">
                                                <p class="text-danger fs-12 fw-medium mb-2 op-7">Suspendidas</p>
                                            </li>
                                        @endif
                                        <li class="">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="ms-3">{{ $sucursal->sucursal }}</span>
                                                <span
                                                    class="badge badge-lg bg-success-transparent rounded-circle ">{{ $sucursal->empleados }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul> --}}
                    </div>

                    {{-- Puestos --}}
                    <div id="puestos-tab-pane" class="tab-pane fade border-0 chat-groups-tab" role="tabpanel"
                        aria-labelledby="groups-tab" tabindex="0">
                        <ul class="list-unstyled mb-0 mt-2 ">
                            @foreach ($puestos as $puesto)
                                <li class="my-1">
                                    
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0">{{ $puesto->descripcion }}</p>
                                            <p class="mb-0">
                                                <span class="badge bg-success-transparent">
                                                    Total: {{ $puesto->empleados_por_puesto_count }}</span>
                                            </p>
                                        </div>
                                        <div puesto="{{ strtolower(str_replace(' ', '', $puesto->descripcion)) }}"
                                            class="avatar-list-stacked my-auto">
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </div>
</div>



@endsection

@section('js')
<!-- Grid JS -->

<x-scripts.jquery :tables="'true'">
    <script>
        const tableEmpleados =
            $('#tblEmpleados').DataTable({
                dom: 'Brtip',
                buttons: [
                    'copy', 'excel', 'print', 'colvis'
                ],
                "pageLength": 10,
                resposive: true,
                // processing: true,
                serverSide: true, 
                deferRender: true,
                "ajax": "../generales/getEmpleados",
                "columns": [{
                        "data": "nombre.nombre",
                        'title': 'Nombre',
                        render: function(d, t, row) {
                            return `
                                <div class="d-flex">
                                    <picture class="avatar avatar-lg bg-primary-transparent me-2">
                                            <img src="{{ Vite::asset('resources/assets/images/faces/default.png') }}"
                                            alt="">
                                    </picture>
                                    <div class="ms-2">
                                        <p class="mb-0 d-flex align-items-center">
                                            <a href="javascript:void(0);">
                                                ${row.nombre.nombre}
                                            </a>
                                        </p>
                                        <p class="fs-12 text-muted my-1 mb-0">
                                            ${row.correo.correo}
                                        </p>
                                    </div>
                                </div>                    
                            `
                        }
                    },
                    {
                        "data": "sucursal.nombre",
                        'title': 'Sucursal',
                        render: function(d,t,row){
                            return `
                                <div class="d-flex flex-column fill ">
                                    <span>${row.sucursal.nombre}</span>
                                    <span class="text-info opacity-75">${row.puesto.descripcion}</span>
                                </div>
                            `
                        }
                    },
                    {
                        "data": "telefono.telefono",
                        'title': 'Teléfono'
                    },
                    {
                        "data": "estatus.estatus",
                        'title': 'Estatus',
                        render: function(d, t, row) {
                            return `<x-badge :text="'${row.estatus.estatus}'" class="bg-success-transparent" />`
                        }
                    },
                    {
                        "data": "id",
                        "title": "Acciones",
                        "render": function(data, type, row) {
                            var urlShow = '{{ route('rh.empleados.show', ':id') }}';
                            urlShow = urlShow.replace(':id', row.id);
                            var urlEdit = '{{ route('rh.empleados.edit', ':id') }}';
                            urlEdit = urlEdit.replace(':id', row.id);                            
                            return `
                            <a href="${urlShow}" class="btn btn-sm btn-icon btn-primary-light btn-wave waves-effect waves-light"><i class="ri-eye-line"></i></a>
                            <a href="${urlEdit}" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light"><i class="ri-edit-line"></i></a>
                            
                            `;
                        }

                    },
 
                ],

            });

        //   Se cambia de lugar el mostrar..
        // $('#tblMostrar').append($('.dataTables_length'));

        // Selecciona todos los botones en la tabla actual para cambiar estilos
        const buttons = Array.from(tableEmpleados.buttons().nodes());
        buttons.forEach(button => {
            button.classList.remove("btn-secondary");
            button.classList.add("btn-sm", "btn-outline-info", "btn-wave", "waves-effect", "waves-light");
        });

        // Cambia el color del texto de lso tds
        $('thead', tableEmpleados.table).addClass('text-info');
        $('.pagination', tableEmpleados.table).addClass('my-2');


        // Cambia de posición los botones
        tableEmpleados.buttons().container().appendTo('#tblEmpleadosBtn');

        // Cambia de posición el input de búsqueda
        $('#tblEmpleadosInput').on('keyup', function() {
            tableEmpleados.search(this.value).draw();
        });
    </script>
</x-scripts.jquery>



@endsection
