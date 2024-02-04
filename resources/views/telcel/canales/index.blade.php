@extends('layouts.auth')
@section('title', config('app.name') . ' - Canales Telcel')
@section('vite-js')

@endsection
@section('title-view', 'Listado de canales')
@section('content')



    {{-- <div class="row"> --}}
    {{-- Barra de información --}}


    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body d-flex align-items-baseline align-items-start flex-wrap">


                <div class="flex-fill">

                    {{-- <span class="mb-0 fs-14 text-muted">Empleados</span> --}}
                    {{-- <span id="totActivos" class="badge bg-outline-success ms-2" title="Distribuidora">10</span> --}}
                    {{-- <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Cadenas">4</span> --}}
                    {{-- <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja">1</span> --}}

                </div>
                <div class="align-baseline  justify-content-start ">
                    <a class="modal-effect btn btn-success-light btn-sm " data-bs-effect="effect-slide-in-right"
                        data-bs-toggle="modal" href="#">
                        <i class="bi bi-plus"></i>
                        Agregar canal
                    </a>

                    <button id="btnActualizaCanales" class="btn btn-sm btn-outline-primary ms-2 save-link"
                        data-link="{{ route('telcel.canales.refresh') }}" title="Cargar lista de canales">
                        <i class="bi bi-arrow-clockwise fs-11"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}


    {{-- <div class="row"> --}}
    <div class="col-xl-8">
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <x-inputs.search-table :name="'src_telcel_canal'" />
                <div id="btnTelcelCanales" class="">
                    {{-- {{ $canales->links() }} --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tblTelcelCanales" class="table table-borderless table-hover table-selected">
                        <thead class="text-info text-center">
                            <tr>
                                <th>Nombre</th>
                                <th>Clave</th>
                                <th>Acox</th>
                                <th>Tipo</th>
                                <th>Sucursal</th>
                                <th>
                                    <i class="bi bi-people-fill text-info fs-16"></i>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($canales) --}}
                            @foreach ($canales as $canal)
                                <tr>
                                    <td>{{ $canal->nombre }}</td>
                                    <td>
                                        <x-badges.modulo :icon="'bi bi-bracesss'" class="badge bg-light text-dark">
                                            {{ $canal->clave }}
                                        </x-badges.modulo>
                                        {{-- {{ $canal->clave }} --}}
                                    </td>
                                    <td>{{ $canal->acox }}</td>
                                    <td>
                                        {{-- @debug($canal); --}}
                                        {{-- @php Debug::info($canal); @endphp --}}
                                        {{-- @dump($canal->concepto->concepto ?? '') --}}
                                        @switch($canal->concepto->concepto ?? '')
                                            @case('Distribuidor')
                                                @if ($canal->id === 1)
                                                    <span
                                                        class="badge bg-danger-transparent">{{ $canal->concepto->concepto ?? '' }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-primary-transparent">{{ $canal->concepto->concepto ?? '' }}</span>
                                                @endif
                                            @break

                                            @case('Cadena')
                                                <span
                                                    class="badge bg-warning-transparent">{{ $canal->concepto->concepto ?? '' }}</span>
                                            @break

                                            @case('Subs')
                                                <span
                                                    class="badge bg-success-transparent">{{ $canal->concepto->concepto ?? '' }}</span>
                                            @break

                                            @default
                                                <span class="badge">{{ $canal->concepto->concepto ?? '' }}</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $canal->sucursal->nombre }}</td>
                                    <td>{{ $canal->sucursal->empleados->count() }}</td>
                                    <td class="text-center">
                                        <x-buttons.modal-crud class="btn btn-sm btn-outline-warning" href="#modalCanales"
                                            :url="route('telcel.canales.edit', $canal->id)" :title="'Editar canal'">
                                            <i class="bi bi-gear"></i>
                                        </x-buttons.modal-crud>

                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>
    <div class="col-xl-4">
        <div class="card custom-card overflow-hidden">
            <div class="card-header">
                <div class="card-title d-flex flex-nowrap flex-fill justify-content-between">
                    <div>
                    <span class="me-2">
                        Sucursales
                    </span>
                </div>
                <div>
                    <span class="avatar avatar-sm bg-info-transparent ms-auto">
                        <i class="bi bi-shop my-1 fs-4 text-info"></i>
                    </span>
                </div>

                </div>
            </div>
            <div class="card-"  style="overflow-y: auto; max-height: 50vh;">
                <ul class="list-group">
                    @foreach ($canalSucursal as $sucursal)
                        {{-- @dump($sucursal) --}}
                        <li class="list-group-item list-group-flush list-group-item-action">
                            <div class="d-sm-flex align-items-top flex-nowrap gap-3">

                                <div>
                                    <span class="avatar avatar-md bg-primary-transparent">
                                        {{ $sucursal['abreviatura'] }}
                                    </span>
                                </div>
                                <div class="mt-sm-0 mt-1 fw-medium flex-wrap">
                                    <p class="mb-0 lh-1">{{ ucfirst($sucursal['sucursal']) }}</p>
                                    <span class="fs-11 text-muted op-7 text-wrap">
                                        {{ $sucursal['listado'] }}
                                    </span>
                                </div>
                                {{-- <div class="mt-sm-0 mt-1 fw-medium flex-fill">
                                        <p class="mb-0 lh-1">{{ ucfirst($sucursal['sucursal'])}}</p>
                                        <span class="fs-11 text-muted op-7 text-wrap">
                                            {{ $sucursal["listado"] }}
                                        </span>
                                    </div> --}}
                                <div class="ms-auto">
                                    <span class="badge bg-orange-transparent fs-14 rounded-pill">
                                        {{ $sucursal['canales'] }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer"></div>
        </div>



    </div>
    {{-- </div> --}}

    <!-- Modal::Agregar Permiso -->
    <div class="modal fade sd-modalForm" id="modalCanales" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nuevo canal</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    {{-- //** La clase: "sd-modalForm" - hace carga el form-menu (create, edit) --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" form="frmCanalesAdd" type="submit">Guardar</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <x-scripts.jquery :sweetAlert="true" :tables="true" />
    <script>
        $(document).ready(function() {
            // $('#tblTelcelCanales').DataTable();
        });
    </script>

    <script>
        // var table = $('#tblTelcelCanales').DataTable();
    </script>

@endsection
