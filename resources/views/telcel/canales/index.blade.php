@extends('layouts.auth')
@section('title', config('app.name') . ' - Canales Telcel')
@section('vite-js')

@endsection
@section('title-view', 'Listado de canales')
@section('content')




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


    {{-- Tabla - Canales --}}
    <div class="col-xl-8">


        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <x-inputs.search-table :name="'src_telcel_canal'" />
                <div id="btnTelcelCanales" class=""></div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tblTelcelCanales" data-url="{{ route('tabla.telcel.canales') }}"
                        class="table table-borderless table-hover table-selected w-100">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- Acordeon: Vendedores, Sucursales --}}

    {{-- <div class="row"> --}}
    <div class="col-xl-4">
        <div class="card custom-card">
            {{-- <div class="card-header justify-content-between">
                    <div class="card-title">
                        Primary
                    </div>
                    <div class="prism-toggle">
                        <button class="btn btn-sm btn-primary-light">Show Code<i class="ri-code-line ms-2 d-inline-block align-middle"></i></button>
                    </div>
                </div> --}}
            <div class="card-body">
                <div class="accordion accordion-info" id="accordingInformacion">
                    {{-- Sucursales --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="Sucursales">
                            <button class="accordion-button " type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSucursales" aria-expanded="false"
                                aria-controls="collapseSucursales">
                                Sucursales
                            </button>
                        </h2>
                        <div id="collapseSucursales" class="accordion-collapse collapse show" aria-labelledby="Sucursales"
                            data-bs-parent="#accordingInformacion">
                            <div class="accordion-body">

                                <ul class="list-group">
                                    @foreach ($canalSucursal as $sucursal)
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
                        </div>
                    </div>

                    {{-- Vendedores --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="Vendedores">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseVendedores" aria-expanded="false"
                                aria-controls="collapseVendedores">
                                Vendedores
                            </button>
                        </h2>
                        <div id="collapseVendedores" class="accordion-collapse collapse  " aria-labelledby="Vendedores"
                            data-bs-parent="#accordingInformacion">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    @foreach ($vendedores as $vendedor)
                                        @if ($vendedor['concepto'] == 'Distribuidor')
                                            <li class="list-group-item list-group-flush list-group-item-action">
                                                <div class="d-sm-flex align-items-top flex-nowrap gap-3">
                                                    <div class="mt-sm-0 mt-1 fw-medium flex-wrap">
                                                        <div class="flex-nowrap">
                                                            <span class="badge bg-orange-transparent rounded-pill">
                                                                {{ $vendedor['canal'] }}
                                                            </span>
                                                            <span
                                                                class="mb-0 lh-1">{{ ucfirst($vendedor['sucursal']) }}</span>
                                                        </div>
                                                        <span class="fs-11 text-muted op-7 text-wrap">
                                                            {{ $vendedor['vendedores'] }}
                                                        </span>
                                                    </div>

                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>



                            </div>
                        </div>
                    </div>
                    {{-- Subs --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="Subs">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSubs" aria-expanded="false" aria-controls="collapseSubs">
                                Subs
                            </button>
                        </h2>
                        <div id="collapseSubs" class="accordion-collapse collapse" aria-labelledby="Subs"
                            data-bs-parent="#accordingInformacion">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    @foreach ($vendedores as $vendedor)
                                        @if ($vendedor['concepto'] == 'Subs')
                                            <li class="list-group-item list-group-flush list-group-item-action">
                                                <div class="d-sm-flex align-items-top flex-nowrap gap-3">

                                                    <div class="mt-sm-0 mt-1 fw-medium flex-wrap">
                                                        <div class="flex-nowrap">
                                                            <span class="badge bg-orange-transparent rounded-pill">
                                                                {{ $vendedor['canal'] }}
                                                            </span>
                                                            <span
                                                                class="mb-0 lh-1">{{ ucfirst($vendedor['sucursal']) }}</span>
                                                        </div>
                                                        <span class="fs-11 text-muted op-7 text-wrap">
                                                            {{ $vendedor['vendedores'] }}
                                                        </span>
                                                    </div>

                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- Cadenas --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="Cadenas">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseCadenas" aria-expanded="false" aria-controls="collapseCadenas">
                                Cadenas
                            </button>
                        </h2>
                        <div id="collapseCadenas" class="accordion-collapse collapse" aria-labelledby="Cadenas"
                            data-bs-parent="#accordingInformacion">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    @foreach ($vendedores as $vendedor)
                                        @if ($vendedor['concepto'] == 'Cadena')
                                            <li class="list-group-item list-group-flush list-group-item-action">
                                                <div class="d-sm-flex align-items-top flex-nowrap gap-3">

                                                    <div class="mt-sm-0 mt-1 fw-medium flex-wrap">
                                                        <div class="flex-nowrap">
                                                            <span class="badge bg-orange-transparent rounded-pill">
                                                                {{ $vendedor['canal'] }}
                                                            </span>
                                                            <span
                                                                class="mb-0 lh-1">{{ ucfirst($vendedor['sucursal']) }}</span>
                                                        </div>
                                                        <span class="fs-11 text-muted op-7 text-wrap">
                                                            {{ $vendedor['vendedores'] }}
                                                        </span>
                                                    </div>

                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="card-footer d-none border-top-0">

            </div>
        </div>
    </div>

    {{-- </div>     --}}

    {{-- Sucursales --}}
    {{-- <div class="col-xl-4">
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
            <div class="card-" style="overflow-y: auto; max-height: 50vh;">
                <ul class="list-group">
                    @foreach ($canalSucursal as $sucursal)
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



    </div> --}}
    {{-- </div> --}}

    <!-- Modal::Editar Canal -->
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

@endsection
