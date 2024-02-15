@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('vite-js')

@endsection
@section('title-view', 'Datos de la Sucursal')
@section('content')


    {{-- GRÁFICAS PRINCIPALES. --}}
    <div class="col-xl-9">
        <div class="card custom-card">
            {{-- Tienda y Opciones gráficas --}}
            <div class="card-header  justify-content-between">
                <div class="card-title align-items-center ">
                    <span class="avatar avatar-md bg-primary-transparent text-fixed-dark ">
                        <i class="bi bi-shop fs-4"></i>
                    </span>
                    <span>
                        {{ $sucursal->nombre }}
                    </span>
                </div>
                <div class="align-items-center ">
                    <select class="form-select form-select-sm mt-2">
                        <option value="1">Activaciones</option>
                        <option value="2">Pospago</option>
                        <option value="3">Paguitos</option>
                        <option value="4">Payjoy</option>
                        <option value="5">Microsip</option>
                    </select>
                    <input type="hidden" name="slcActivacionesSucursal" id="slcActivacionesSucursal"
                        value="{{ $sucursal->id }}">
                </div>
            </div>

            {{-- Controles gráfica activaciones y Tabs --}}
            <div class="card-header justify-content-between">
                <div class="row d-flex  gap-2">
                    {{-- Año --}}
                    <div class="form-group col-12 col-md">
                        <div class="input-group ">
                            <div class="input-group-text">
                                <i class='bi bi-calendar-range'></i>
                            </div>
                            <select id="slcActivacionesAnio" class="form-select form-select-sm">
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                    </div>
                    {{-- Meses --}}
                    <div class="form-group col-12 col-md">
                        <div class="input-group ">
                            <div class="input-group-text">
                                <i class='bi bi-calendar-month'></i>
                            </div>
                            <select id="slcActivacionesMes" class="form-select form-select-sm ">
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                    </div>
                    {{-- Fechas --}}
                    <div class="form-group col-12 col-md">
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class='bi bi-calendar-check-fill'></i>
                            </div>
                            <select id="slcActivacionesFecha" class="form-select form-select-sm">
                                <option value="preactivacion">Fecha preactivación</option>
                                <option value="activacion">Fecha Activación</option>
                                <option value="primera_llamada">Fecha Primera llamada</option>
                                <option value="rep_venta">Fecha Reporte ventas</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- TABS - Activaciones --}}
                <div class="row col-12 col-md mt-2">
                    {{-- UL:tabs  --}}
                    <ul class="nav nav-pills justify-content-end nav-style-3 mb-3 border-0 " role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                                href="#activaMensual" aria-selected="true">Mensual</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#activaAnual"
                                aria-selected="true">Anual</a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Tabs Contents --}}
            <div class="card-body">
                {{-- TABS:concent --}}
                <div class="tab-content">
                    {{-- TAB::Mensual --}}
                    <div class="tab-pane show active p-1 border-0  text-muted" id="activaMensual" role="tabpanel">
                        {{-- Análisis por producto --}}
                        <div class="card custom-card mt-2">
                            {{-- <div class="card-header align-items-start"> --}}
                                <div id="compara-mensual-diario" class=" d-flex align-items-top justify-content-center">
                                </div>
                            {{-- </div> --}}
                            <div class="card-body">
                                {{-- Gráfica diario --}}
                                <div id="grafica-activaciones-diario" class="mt-3 "></div>
                            </div>
                        </div>
                    </div>

                    {{-- TAB::Anual --}}
                    <div class="tab-pane text-muted p-1 border-0  " id="activaAnual" role="tabpanel">
                        <div class="card custom-card mt-2">
                            {{-- Análisis anual --}}
                            {{-- <div class="card-header align-items-start"> --}}
                                <div id="compara-mensual-anual" class=" d-flex align-items-top justify-content-center">
                                </div>
                            {{-- </div> --}}
                            {{-- Grafica --}}
                            <div class="card-body">
                                <div id="grafica-activaciones-mensuales"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="d-flex align-items-center justify-content-between gap-1 flex-wrap">
                    <div>
                        <span class="d-block text-muted fs-12">Apertura</span>
                        <span
                            class="d-block fs-14 fw-medium">{{ $sucursal->fecha_apertura ? date('d, M Y', strtotime($sucursal->fecha_apertura)) : '' }}</span>
                    </div>
                    {{--                     
                    <div>
                        <span class="d-block text-muted fs-12 mb-1">Gerente</span>
                        <div class="d-flex align-items-center">
                            <div class="me-2 lh-1">
                                <span class="avatar avatar-xs avatar-rounded">
                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                </span>
                            </div>
                            <span class="d-block fs-14 fw-medium">S.K.Jacob</span>
                        </div>
                    </div>
                    <div>
                        <span class="d-block text-muted fs-12 mb-1">Supervisor</span>
                        <div class="d-flex align-items-center">
                            <div class="me-2 lh-1">
                                <span class="avatar avatar-xs avatar-rounded">
                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                </span>
                            </div>
                            <span class="d-block fs-14 fw-medium">H.A.Sanchez</span>
                        </div>
                    </div> --}}
                    {{-- <div>
                        <span class="d-block text-muted fs-12">Empleados</span>
                        <div class="avatar-list-stacked">
                            @foreach ($sucursal->empleados as $empleado)
                                <span class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-primary"
                                    data-bs-original-title="{{ $empleado->nombre->nombre }}">
                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                </span>
                            @endforeach
                        </div>
                    </div> --}}
                    <div>
                        <span class="d-block text-muted fs-12">Estatus</span>
                        <span class="d-block">
                            <span class="badge bg-success-transparent">
                                {{ $sucursal->estatus->estatus }}
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {{-- Time-line --}}
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Última actividad</div>
            </div>
            <div class="card-body">
                <ul class="list-unstyled profile-timeline">

                    <li>
                        <div>
                            <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                            </span>
                            <p class="text-muted mb-2">
                                <span class="text-default">
                                    <b>Federico Hernandez</b>
                                    <span class="text-primary">
                                        - Activación KIT
                                    </span>

                                </span>
                                <span class="float-end fs-11 text-muted">17/Enero/2024 -
                                    15:32</span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                            </span>
                            <p class="text-muted mb-2">
                                <span class="text-default">
                                    <b>Federico Hernandez</b>
                                    <span class="text-warning">
                                        - Activación CHIP
                                    </span>

                                </span>
                                <span class="float-end fs-11 text-muted">17/Enero/2024 -
                                    14:01</span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                            </span>
                            <p class="text-muted mb-2">
                                <span class="text-default">
                                    <b>Jorge Ramos</b>
                                    <span class="text-warning">
                                        - Activación CHIP
                                    </span>

                                </span>
                                <span class="float-end fs-11 text-muted">16/Enero/2024 -
                                    08:37</span>
                            </p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="avatar avatar-sm avatar-rounded profile-timeline-avatar">
                                <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                            </span>
                            <p class="text-muted mb-2">
                                <span class="text-default">
                                    <b>Jorge Ramos</b>
                                    <span class="text-secondary">
                                        - Renovacion
                                    </span>

                                </span>
                                <span class="float-end fs-11 text-muted">12/Enero/2024 -
                                    11:21</span>
                            </p>
                        </div>
                    </li>

                </ul>
            </div>

        </div>
    </div>
    {{-- Otra información --}}
    <div class="col-xl-3">

        {{-- Gráfica Anual x Producto --}}
        <div class="card custom-card">
            <div class="card-header justify-content-between">
                <div class="card-title">
                    Por producto
                </div>
                <div class="dropdown">
                    <span class="text-muted me-2">Anual</span>
                </div>
            </div>
            <div class="card-body p-0 overflow-hidden">
                {{-- Gráfica --}}
                <div
                    class="leads-source-chart d-flex align-items-center justify-content-center p-3 border-bottom border-block-end-dashed">
                    <div id="grafica-activaciones-producto"></div>
                </div>
                {{-- Totales de la gráfica --}}
                <div class="row row-cols-12">
                    <div class="col-6 p-0">
                        <div class="ps-4 py-3 pe-3 d-flex align-items-center flex-wrap justify-content-center gap-3">
                            <div>
                                <span class="avatar bg-primary-transparent svg-primary">

                                    <i class="bi bi-phone fs-4"></i>
                                </span>
                            </div>
                            <div>
                                <span class="text-muted fs-12 mb-1 d-inline-block">Equipos
                                </span>
                                <div><span id="spmActivaKIT" class="fs-16">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div class="p-3 d-flex align-items-center flex-wrap justify-content-center gap-3">
                            <div>
                                <span class="avatar bg-success-transparent svg-secondary">
                                    <i class="bi bi-sd-card fs-4"></i>
                                </span>
                            </div>
                            <div>
                                <span class="text-muted fs-12 mb-1 d-inline-block">Chips
                                </span>
                                <div><span id="spmActivaChips" class="fs-16">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div class="p-3 d-flex align-items-center flex-wrap justify-content-center gap-3">
                            <div>
                                <span class="avatar bg-warning-transparent svg-success">
                                    <i class="bi bi-recycle fs-4"></i>
                                </span>
                            </div>
                            <div>
                                <span class="text-muted fs-12 mb-1 d-inline-block">Portas
                                </span>
                                <div><span id="spmActivaPortas" class="fs-16">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-0">
                        <div class="p-3 d-flex align-items-center flex-wrap justify-content-center gap-3">
                            <div>
                                <span class="avatar bg-danger-transparent svg-danger">

                                    <i class="bi bi-app-indicator fs-4"></i>
                                </span>
                            </div>
                            <div>
                                <span class="text-muted fs-12 mb-1 d-inline-block">Otros
                                </span>
                                <div><span id="spmActivaOtros" class="fs-16">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Empleados --}}
        <div class="card custom-card overflow-hidden">
            <div class="card-header justify-content-between">
                <div class="card-title">Empleados</div>
            </div>
            @foreach ($sucursal->empleados as $empleado)
                <div class="card-body p-3">
                    <div class="float-end">
                        <a href="javascript:void(0);" class="text-info me-2 fs-12"><u>Ver</u></a>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="avatar avatar-lg">
                            <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                        </span>
                        <div>
                            <p class="mb-0">
                                {{ $empleado->nombre->nombre }}
                            </p>
                            <p class="mb-0 fs-12 text-dark">{{ $empleado->correo->correo }}</p>
                            <div class="d-flex align-items-center">
                                <span class="text-muted fs-11 me-3">{{ $empleado->puesto->descripcion }}</span>
                                <span class="text-muted fs-11 me-3">
                                    {{ $empleado->fecha_ingreso ? date('d, M Y', strtotime($empleado->fecha_ingreso)) : '' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>


@endsection
