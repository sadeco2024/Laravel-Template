@extends('layouts.auth')
@section('title', config('app.name') . ' - Activaciones prepago')
@section('vite-js')

@endsection
@section('title-view', 'Activaciones')
@section('content')



    <div class="row">
        {{-- Barra de información --}}
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body d-flex align-items-baseline align-items-center justify-content-between flex-wrap">

                    <div class="d-flex flex-nowrap">
                        {{-- Año --}}
                        <div class="form-group ms-2">
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
                        <div class="form-group ms-2">
                            <div class="input-group">
                                <div class="input-group-text">
                                    <i class='bi bi-calendar-month'></i>
                                </div>
                                <select id="slcActivacionesMes" class="form-select form-select-sm">
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
                        <div class="form-group ms-2">
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
                    {{-- Descarga --}}
                    <div>
                        <a class="modal-effect btn btn-warning-light btn-sm " data-bs-effect="effect-slide-in-right"
                            data-bs-toggle="modal" href="#modaActivacionesCarga"
                            data-url="{{ route('telcel.activaciones.download.create') }}"
                            data-title="Carga de activaciones">
                            <i class="bi bi-gear-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabs y gráficas --}}
        <div class="col-xl-9">
            {{-- UL:tabs  --}}
            <ul class="nav nav-pills justify-content-center nav-style-3 mb-3 border-0 " role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page" href="#activaMensual"
                        aria-selected="true">Mensual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#activaAnual"
                        aria-selected="true">Anual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#activaCadenas"
                        aria-selected="true">Cadenas</a>
                </li>
            </ul>
            {{-- TABS:concent --}}
            <div class="tab-content">
                {{-- TAB::Mensual --}}
                <div class="tab-pane show active p-1 border-0  text-muted" id="activaMensual" role="tabpanel">
                    {{-- Análisis por producto --}}
                    <div class="card custom-card mt-2">
                        <div class="card-header align-items-start">
                            <div id="compara-mensual-diario"
                                class=" d-sm-flex align-items-top justify-content-between mb-3">
                            </div>

                        </div>
                        <div class="card-body">
                            {{-- Gráfica diario --}}
                            <div id="grafica-activaciones-diario" class="mt-3 "></div>
                        </div>
                    </div>
                </div>

                {{-- TAB::Anual --}}
                <div class="tab-pane text-muted p-1 border-0  " id="activaAnual" role="tabpanel">
                    <div class="card custom-card mt-2">
                        <div class="card-header align-items-start">
                            <div id="compara-mensual-anual" class=" d-sm-flex align-items-top justify-content-between mb-3">

                            </div>

                        </div>

                        <div class="card-body">

                            <div id="grafica-activaciones-mensuales"></div>
                        </div>

                    </div>

                </div>

                {{-- TAB::Cadenas --}}
                <div class="tab-pane text-muted p-1 border-0  " id="activaCadenas" role="tabpanel">

                    <div class="card custom-card mt-2">
                        <div class="card-body">
                            {{-- Gráfica activaciones --}}
                            <div id="grafica-activaciones-mensuales-cadenas"></div>
                        </div>

                    </div>

                </div>
            </div>


        </div>

        {{-- Por sucursal --}}
        <div class="col-xl-3">
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

                    </ul>
                </div>
            </div>
        </div>

    </div>


    <!-- Modal::Descarga Activaciones -->
    <div class="modal fade sd-modalForm" id="modaActivacionesCarga" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Activaciones</h6>
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
    <x-scripts.apexchart />

@endsection
