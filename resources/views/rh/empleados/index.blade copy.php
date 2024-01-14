@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection
@section('title-view', 'Lista de empleados')
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
    <div class="col-12 col-xl-4 col-lg-6 col-md-6 col-sm-8 order-0 order-xl-1">
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
                                $tipo = '';
                                $susp = false;
                            @endphp
                            @foreach ($sucursales as $sucursal)
                                @if ($tipo != $sucursal->tipo->concepto)
                                    @switch($sucursal->tipo->concepto)
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
                                    @php $tipo= $sucursal->tipo->concepto; @endphp
                                @endif

                                @if ($sucursal->estatus->estatus != 'Abierta' && $susp == false)
                                    @php $susp=true; @endphp
                                    <li class="pb-0 mt-3">
                                        <p class="text-danger fs-12 fw-medium mb-2 op-7">Suspendidas</p>
                                    </li>
                                @endif
                                <li class="">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span class="ms-3">{{ $sucursal->nombre }}</span>
                                        <span
                                            class="badge badge-lg bg-success-transparent rounded-circle ">{{ $sucursal->empleados->count() }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Puestos --}}
                    <div id="puestos-tab-pane" class="tab-pane fade border-0 chat-groups-tab" role="tabpanel"
                        aria-labelledby="groups-tab" tabindex="0">
                        <ul class="list-unstyled mb-0 mt-2 ">
                            {{-- @foreach ($puestos as $puesto)
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
                                        </div>
                                    </div>
                                </li>
                            @endforeach --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('js')

@endsection
