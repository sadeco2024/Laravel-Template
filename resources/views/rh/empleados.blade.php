@extends('layouts.auth')

@section('title', config('app.name') . ' - Dashboard')

@section('vite-js')
    @vite(['resources/css/app.css','resources/js/auth-app.js'])
@endsection

@section('title-view', 'Listado de empleados')

@section('css')
    <link rel="stylesheet" href="{{ Vite::asset('resources/assets/libs/gridjs/theme/mermaid.min.css') }}">
@endsection

@section('content')


    <div class="row">
        <div class="col-12 col-xl-8 col-md-12 order-1 order-xl-0">
            <div class="card custom-card">
                <div class="card-header align-baseline  justify-content-start ">
                    <span id="totActivos" class="badge bg-outline-success ms-2" title="Activos"></span>
                    <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Suspendidos"></span>
                    <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja"></span>
                    <a href="{{route('empleados.create')}}" class="ms-auto">
                        <i class='bx bx-message-square-add bx-flip-horizontal fs-2 text-primary ' role="button"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div id="grid-empleados"></div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-4 order-0 order-xl-1">
            <div class="card custom-card">
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
                    {{-- Tabs - contenct --}}
                    <div class="tab-content">
                        {{-- Sucursales --}}
                        <div id="sucursales-tab-pane" class="tab-pane fade show active border-0" role="tabpanel"
                            aria-labelledby="config-tab" tabindex="0">
                            <ul class="list-group list-group-flush list-unstyled ">
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
                            </ul>
                        </div>

                        {{-- Puestos --}}
                        {{-- @dump($puestos) --}}

                        <div id="puestos-tab-pane" class="tab-pane fade border-0 chat-groups-tab" role="tabpanel"
                            aria-labelledby="groups-tab" tabindex="0">
                            <ul class="list-unstyled mb-0 mt-2 ">
                                @foreach ($puestos as $puesto)
                                    <li class="my-1">

                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <p class="mb-0">{{ $puesto->puesto }}</p>
                                                <p class="mb-0">
                                                    <span class="badge bg-success-transparent">
                                                        Total: {{ $puesto->empleados }}</span>
                                                </p>
                                            </div>
                                            <div puesto="{{ strtolower(str_replace(' ', '', $puesto->puesto)) }}"
                                                class="avatar-list-stacked my-auto">

                                                {{-- <a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded"
                                                href="javascript:void(0);">
                                                +19
                                            </a> --}}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                {{-- <li class="my-1">

                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0">Director General</p>
                                            <p class="mb-0">
                                                <span class="badge bg-success-transparent">
                                                Total:  4</span>
                                            </p>
                                        </div>
                                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                    alt="img">
                                            </span>
                                            <a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded"
                                                href="javascript:void(0);">
                                                +19
                                            </a>
                                        </div>
                                    </div>

                                </li>
                                <li class="my-1">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="mb-0">2) Empleado General </p>
                                            <p class="mb-0">
                                                <span class="badge bg-secondary-transparent">
                                                    Total: 31
                                                </span>
                                            </p>
                                        </div>
                                        <div class="avatar-list-stacked my-auto">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                    alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                    alt="img">
                                            </span>
                                            <a class="avatar avatar-sm bg-primary text-fixed-white avatar-rounded"
                                                href="javascript:void(0);">
                                                +18
                                            </a>
                                        </div>
                                    </div>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="staticBackdropLabel">Empleados
                    </h6>
                    <div>
                        <span class="ms-auto">[ 1 ]</span>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body">
                    <p>I will not close if you click outside me. Don't even try to
                        press
                        escape key.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <!-- Grid JS -->
    <script src='{{ Vite::asset('resources/assets/libs/gridjs/gridjs.umd.js') }}'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Internal Grid JS -->
    <script src='{{ Vite::asset('resources/js/tablasGrids.js') }}'></script>
    {{-- <script src="../assets/js/grid.js"></script> --}}
@endsection


@section('script')
    const user = {!! json_encode($empleados) !!};

    getTablaEmpleados(user)
@endsection
