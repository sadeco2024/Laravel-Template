@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('vite-js')

@endsection
@section('title-view', 'Datos de la Sucursal')
@section('content')

    <div class="row">
        <div class="col-xl-9">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title align-items-center ">
                        <span class="avatar avatar-md avatar-rounded team-avatar ">
                            <i class="bi bi-shop bg-primary-transparent fs-4"></i>
                        </span>
                        <span>
                            {{ $sucursal->nombre }}
                        </span>
                    </div>
                    <div>
                        <select class="form-select form-select-sm">
                            <option value="1">Activaciones</option>
                            <option value="2">Pospago</option>
                            <option value="3">Paguitos</option>
                            <option value="4">Payjoy</option>
                            <option value="5">Microsip</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Datos mensuales --}}
                    <div class="d-sm-flex align-items-center mb-3">
                        <div class="d-flex align-items-center me-5">
                            <span class="fs-8 text-primary">
                                <i class="mdi mdi-circle"></i>
                            </span>
                            <div class="ms-2">
                                <p class="mb-0 fs-15">742</p>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-2 fs-13 text-muted">Kits</p>
                                    <span class="fs-12 text-success d-inline-flex align-items-center"><i
                                            class="ti ti-trending-up me-1"></i>2.5%</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center me-5">
                            <span class="fs-8 text-secondary">
                                <i class="mdi mdi-circle"></i>
                            </span>
                            <div class="ms-2">
                                <p class="mb-0 fs-15">125</p>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-2 fs-13 text-muted">Chips</p>
                                    <span class="fs-12 text-danger d-inline-flex align-items-center">
                                        <i class="ti ti-trending-down me-1"></i>
                                        0.2%
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center me-5">
                            <span class="fs-8 text-success">
                                <i class="mdi mdi-circle"></i>
                            </span>
                            <div class="ms-2">
                                <p class="mb-0 fs-15">369</p>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-2 fs-13 text-muted">Portas</p>
                                    <span class="fs-12 text-success d-inline-flex align-items-center"><i
                                            class="ti ti-trending-up me-1"></i>1.7%</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center me-5">
                            <span class="fs-8 text-success">
                                <i class="mdi mdi-circle"></i>
                            </span>
                            <div class="ms-2">
                                <p class="mb-0 fs-15">12</p>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0 me-2 fs-13 text-muted">Otros</p>
                                    <span class="fs-12 text-success d-inline-flex align-items-center"><i
                                            class="ti ti-trending-up me-1"></i>0.7%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Gráfica activaciones --}}
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
                <div class="card-footer">
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
        <div class="col-xl-3">
            {{-- Gráfica Anual --}}
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
                    <div class="leads-source-chart d-flex align-items-center justify-content-center p-3 border-bottom border-block-end-dashed">
                        <div id="leads-source"></div>
                    </div>
                    <div class="row row-cols-12">
                        <div class="col-6 p-0">
                            <div class="ps-4 py-3 pe-3 d-flex align-items-center flex-wrap justify-content-center gap-3">
                                <div>
                                    <span class="avatar bg-primary-transparent svg-primary">
                                        
                                        <i class="bi bi-phone fs-4"></i>
                                    </span>
                                </div>
                                <div>
                                    <span class="text-muted fs-12 mb-1 d-inline-block">Kits
                                    </span>
                                    <div><span class="fs-16">1,748</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <div class="p-3 d-flex align-items-center flex-wrap justify-content-center gap-3">
                                <div>
                                    <span class="avatar bg-success-transparent svg-secondary">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M3 4h18v12H3z" opacity=".3"/><path d="M21 2H3c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h7v2H8v2h8v-2h-2v-2h7c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H3V4h18v12z"/></svg> --}}
                                            <i class="bi bi-sd-card fs-4"></i>                                        
                                    </span>
                                </div>
                                <div>
                                    <span class="text-muted fs-12 mb-1 d-inline-block">Chips
                                    </span>
                                    <div><span class="fs-16">1,267</span>
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
                                    <div><span class="fs-16">1,153</span>
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
                                    <div><span class="fs-16">679</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">Configuraciones</div>
                    {{-- <div class="btn btn-sm btn-light btn-wave"><i class="ri-add-line align-middle me-1 fw-medium"></i>Add
                        Goal</div> --}}
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="d-flex align-items-betwen">
                                <div class="me-2">
                                    <input class="form-check-input form-checked-success" type="checkbox" disabled
                                        value="" id="successChecked1" checked="">
                                </div>
                                <div class="fw-medium">
                                    Activaciones
                                </div>
                                <div class="text-muted ms-auto">
                                    RCLAUCAM12
                                    <button class="btn btn-sm ">
                                        <i class="bi bi-pencil text-info"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-nowrap align-items-center">
                                <div class="me-2">
                                    <input class="form-check-input form-checked-success" type="checkbox" disabled
                                        value="" id="successChecked2">
                                </div>
                                <div class="fw-medium">
                                    Portal
                                </div>
                                <div class="text-muted ms-auto">
                                    <button class="btn btn-sm ">
                                        <i class="bi bi-pencil text-info"></i>
                                    </button>
                                </div>

                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="me-2"><input class="form-check-input form-checked-success" disabled
                                        type="checkbox" value="" id="successChecked3"></div>
                                <div class="fw-medium">Payjoy</div>
                                <div class="text-muted ms-auto">
                                    <button class="btn btn-sm ">
                                        <i class="bi bi-pencil text-info"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="me-2"><input class="form-check-input form-checked-success" disabled
                                        type="checkbox" value="" id="successChecked4"></div>
                                <div class="fw-medium">Canal Amigo Paguitos</div>
                                <div class="text-muted ms-auto">
                                    <button class="btn btn-sm ">
                                        <i class="bi bi-pencil text-info"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="me-2"><input class="form-check-input form-checked-success" disabled
                                        type="checkbox" value="" id="successChecked5" checked=""></div>
                                <div class="fw-medium">RAM</div>
                                <div class="text-muted ms-auto">
                                    9993665532
                                    <button class="btn btn-sm ">
                                        <i class="bi bi-pencil text-info"></i>
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <div class="me-2"><input class="form-check-input form-checked-success" disabled
                                        type="checkbox" value="" id="successChecked6" checked=""></div>
                                <div class="fw-medium">Microsip</div>
                                <div class="text-muted ms-auto">
                                    CEDIS
                                    <button class="btn btn-sm ">
                                        <i class="bi bi-pencil text-info"></i>
                                    </button>
                                </div>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
     
            {{-- Empleados --}}
            <div class="card custom-card overflow-hidden">
                <div class="card-header justify-content-between">
                    <div class="card-title">Empleados</div>
                    {{-- <a href="javascript:void(0);" class="btn btn-sm btn-primary-light">View All</a> --}}
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover card-table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-3">Nombre</th>
                                    <th>Puesto</th>
                                    {{-- <th class="pe-3">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-items-top">
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center position-relative">
                                            <a href="javascript:void(0);" class="stretched-link" title="recruiter"></a>
                                            <span class="me-2 min-w-fit-content">
                                                <span class="avatar avatar-sm rounded-circle bg-secondary">T</span>
                                            </span>
                                            <div class="flex-grow-1">
                                                <p class="mb-0">Hermilo Sánchez</p>
                                                <p class="text-muted">sadecoqr@gmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span>Gerente</span>
                                    </td>
                                </tr>
                                {{-- <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center position-relative">
                                        <a href="javascript:void(0);" class="stretched-link" title="recruiter"></a>
                                        <span class="me-2 min-w-fit-content">
                                            <img src="../assets/images/faces/13.jpg" alt="logo" class="avatar avatar-sm rounded-circle">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="mb-0">Dia Xclose</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>History</span>
                                </td>
                                <td class="pe-3">
                                    <a href="javascript:void(0);" class="ms-3 pe-4 text-primary" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);" class="dropdown-item">Follow</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">like</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">Share</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center position-relative">
                                        <a href="javascript:void(0);" class="stretched-link" title="recruiter"></a>
                                        <span class="me-2 min-w-fit-content">
                                            <span class="avatar avatar-sm rounded-circle bg-success"><i class="bi bi-lightning-fill"></i></span>
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="mb-0">Geroge P</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>Science and Nature</span>
                                </td>
                                <td class="pe-3">
                                    <a href="javascript:void(0);" class="ms-3 pe-4 text-primary" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);" class="dropdown-item">Follow</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">like</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">Share</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center position-relative">
                                        <a href="javascript:void(0);" class="stretched-link" title="recruiter"></a>
                                        <span class="me-2 min-w-fit-content">
                                            <img src="../assets/images/faces/16.jpg" alt="logo" class="avatar avatar-sm rounded-circle">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="mb-0">TLV James</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>Design and Creativity</span>
                                </td>
                                <td class="pe-3">
                                    <a href="javascript:void(0);" class="ms-3 pe-4 text-primary" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);" class="dropdown-item">Follow</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">like</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">Share</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-3">
                                    <div class="d-flex align-items-center position-relative">
                                        <a href="javascript:void(0);" class="stretched-link" title="recruiter"></a>
                                        <span class="me-2 min-w-fit-content">
                                            <img src="../assets/images/faces/15.jpg" alt="logo" class="avatar avatar-sm rounded-circle">
                                        </span>
                                        <div class="flex-grow-1">
                                            <p class="mb-0">Techmortom</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>Math and Statistics</span>
                                </td>
                                <td class="pe-3">
                                    <a href="javascript:void(0);" class="ms-3 pe-4 text-primary" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);" class="dropdown-item">Follow</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">like</a></li>
                                        <li><a href="javascript:void(0);" class="dropdown-item">Share</a></li>
                                    </ul>
                                </td>
                            </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-xl-5">

    </div>

@endsection

@section('js')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    

@endsection
