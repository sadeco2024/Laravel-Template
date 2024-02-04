@extends('layouts.auth')
@section('title', config('app.name') . ' - Activaciones prepago')
@section('vite-js')

@endsection
@section('title-view', 'Activaciones prepago')
@section('content')



    <div class="row">
        {{-- Barra de información --}}


        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body d-flex align-items-baseline align-items-center justify-content-between flex-wrap">


                    <div class="">

                        {{-- <span class="mb-0 fs-14 text-muted">Empleados</span> --}}
                        {{-- <span id="totActivos" class="badge bg-outline-success ms-2" title="Distribuidora">10</span> --}}
                        {{-- <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Cadenas">4</span> --}}
                        {{-- <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja">1</span> --}}

                    </div>
                    <div>
                        <a class="modal-effect btn btn-warning-light btn-sm " data-bs-effect="effect-slide-in-right"
                            data-bs-toggle="modal" href="#modaActivacionesCarga"
                            data-url="{{ route('telcel.activaciones.download.create') }}" data-title="Carga de activaciones">
                            <i class="bi bi-gear-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9">
            <div class="d-flex justify-content-between">
                {{-- <span class="text-muted">Mes actual</span> --}}


            </div>
            <div class="card custom-card mt-2">
                <div class="card-header align-items-start">
                    <div id="comparaMensual" class=" d-sm-flex align-items-top justify-content-between mb-3">

                        @foreach ($compara['current'] as $row)
                            <div class="d-flex align-items-center me-5">

                                <span class="fs-8 text-secondary">
                                    <i class="mdi mdi-circle"></i>

                                </span>
                                <div class="ms-2 align-content-top  text-center">
                                    <p class="mb-0 fs-15">{{ $row['total'] }}</p>
                                    <p class="mb-0 me-2 fs-13 text-muted">{{ $row['concepto'] }}</p>
                                    @foreach ($compara['last'] as $last)
                                        @if ($last['concepto'] == $row['concepto'])
                                            @if ($last['total'] > $row['total'])
                                                <span class="fs-12 text-danger d-inline-flex align-items-center"
                                                    title="Mes anterior: {{ $last['total'] }}">
                                                    <i class="ti ti-trending-down me-1"></i>
                                                    {{ number_format((($last['total'] - $row['total']) / $last['total']) * 100, 2) }}%
                                                </span>
                                            @else
                                                <span class="fs-12 text-success d-inline-flex align-items-center"
                                                    title="Mes anterior: {{ $last['total'] }}">
                                                    <i class="ti ti-trending-up me-1"></i>
                                                    {{ number_format((($row['total'] - $last['total']) / $last['total']) * 100, 2) }}%
                                                </span>
                                            @endif
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-xl-3">
                            <div class="form-group mb-2">
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
                        <div class="col-xl-3 ms-auto text-right">
                            <div class="form-group mb-2">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class='bi bi-calendar4'></i>
                                    </div>
                                    <select id="slcActivacionesAnio" class="form-select form-select-sm">
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- Gráfica activaciones --}}
                        <div id="grafica-activaciones-mensuales"></div>
                    </div>


                </div>
                {{-- <div class="card-footer">
                    <div class="d-flex align-items-center justify-content-between gap-1 flex-wrap">
                        <div>
                            <span class="d-block text-muted fs-12">Apertura</span>
                            <span class="d-block fs-14 fw-medium">22,Dec 2023</span>
                        </div>
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
                        </div>

                        <div>
                            <span class="d-block text-muted fs-12">Empleados</span>
                            <div class="avatar-list-stacked">
                                <span class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-primary" data-bs-original-title="Simon">
                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                </span>
                                <span class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-primary" data-bs-original-title="Sasha">
                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                </span>
                                <span class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-primary" data-bs-original-title="Anagha">
                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                </span>
                                <span class="avatar avatar-sm avatar-rounded" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-primary" data-bs-original-title="Hishen">
                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                </span>
                            </div>
                        </div>
                        <div>
                            <span class="d-block text-muted fs-12">Estatus</span>
                            <span class="d-block"><span class="badge bg-success-transparent">Abierta</span></span>
                        </div>
                        <div>
                            <span class="d-block text-muted fs-12">Priority</span>
                            <span class="d-block fs-14 fw-medium"><span
                                    class="badge bg-success-transparent">Alta</span></span>
                        </div>
                    </div>
                </div> --}}
            </div>
            {{-- Time-line --}}
            {{-- <div class="card custom-card">
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

            </div> --}}
        </div>

        <div class="col-xxl-3">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Por Sucursal</div>
                    <span id="spnTotalActivas" class="fs-12 text-muted">0</span>
                    {{-- <div class="dropdown">
                        <a aria-label="anchor" href="javascript:void(0);" class="btn btn-icon btn-sm btn-light"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fe fe-more-vertical"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);">Week</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Month</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Year</a></li>
                        </ul>
                    </div> --}}
                </div>
                <div class="card-body">
                    <ul id="liActivaSucursales" class="list-unstyled crm-top-deals mb-0">
                        {{-- <li>
                            <div class="d-flex align-items-center flex-wrap">
            
                                <div class="flex-fill">
                                    <span class="fs-14 d-block mb-1">Almacén General</span>
                                    <span class="text-muted fs-12"></span>
                                </div>
                                <div>
                                    <span class="bg-warning-transparent">1,500</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="me-2 lh-1">
                                    <span class="avatar avatar-rounded bg-warning-transparent">
                                        <img src="../assets/images/faces/6.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <span class="fs-14 d-block mb-1">Emigo Kiaren</span>
                                    <span class="text-muted fs-12">emigo.kiaren@gmail.com</span>
                                </div>
                                <div>
                                    <span class="badge bg-info-transparent">Hot Leads</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="me-2 lh-1">
                                    <span class="avatar avatar-rounded">
                                        <img src="../assets/images/faces/12.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <span class="fs-14 d-block mb-1">Randy Origoan</span>
                                    <span class="text-muted fs-12">randy.origoan@gmail.com</span>
                                </div>
                                <div>
                                    <span class="badge bg-success-transparent">Cold Leads</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="me-2 lh-1">
                                    <span class="avatar avatar-rounded bg-success-transparent">
                                        GP
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <span class="fs-14 d-block mb-1">George Pieterson</span>
                                    <span class="text-muted fs-12">george.pieterson@gmail.com</span>
                                </div>
                                <div>
                                    <span class="badge bg-danger-transparent">Lost Leads</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="me-2 lh-1">
                                    <span class="avatar avatar-rounded bg-primary-transparent">
                                        <img src="../assets/images/faces/5.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <span class="fs-14 d-block mb-1">Kiara Advain</span>
                                    <span class="text-muted fs-12">kiaraadvain214@gmail.com</span>
                                </div>
                                <div>
                                    <span class="badge bg-secondary-transparent">New Leads</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center flex-wrap">
                                <div class="me-2 lh-1">
                                    <span class="avatar avatar-rounded bg-primary-transparent">
                                        <img src="../assets/images/faces/14.jpg" alt="">
                                    </span>
                                </div>
                                <div class="flex-fill">
                                    <span class="fs-14 d-block mb-1">Jason Momoa</span>
                                    <span class="text-muted fs-12">jsonmomoa2132@gmail.com</span>
                                </div>
                                <div>
                                    <span class="badge bg-success-transparent">Cold Leads</span>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal::Agregar menú -->
    <div class="modal fade sd-modalForm" id="modaActivacionesCarga" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar menu</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body text-start">
                    {{-- //** La clase: "sd-modalForm" - hace carga el form-menu (create, edit) --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" form="cargaActivaciones" type="submit">Descargar</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <x-scripts.flatpickr />
    <x-scripts.sweetalert />
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

@endsection
