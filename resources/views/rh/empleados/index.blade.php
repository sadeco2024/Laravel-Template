@extends('layouts.auth')
@section('title', config('app.name') . ' - Lista de empleados')

@section('title-view', 'Lista de empleados')
@section('content')


@section('css')

@endsection

{{-- <div class="row"> --}}
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
                    {{-- <span id="totActivos" class="badge bg-outline-success ms-2" title="Activos">10</span>
                    <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Suspendidos">4</span>
                    <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja">1</span> --}}

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
                <div class="table-responsive">
                    <table id="tblEmpleados" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Sucursal</th>
                                <th>Teléfono</th>
                                <th>Estatus</th>
                                <th></th>
                            </tr>
                        <tbody>

                            @foreach ($empleados as $empleado)
                                <tr>
                                    <td>
                                        <div class="d-flex">
                                            <picture class="avatar avatar-lg bg-primary-transparent me-2">
                                                <img src="{{ asset('/assets/images/faces/default.png') }}"
                                                    alt="">
                                            </picture>
                                            <div class="ms-2">
                                                <p class="mb-0 d-flex align-items-center">
                                                    <a href="javascript:void(0);">
                                                        {{ $empleado->empleado }}
                                                    </a>
                                                </p>
                                                <p class="fs-12 text-muted my-1 mb-0">
                                                    {{ $empleado->correo }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>


                                        <div class="d-flex flex-column fill ">
                                            <span>
                                                {{ ucfirst( $empleado->sucursal) }}
                                            </span>
                                            <span class="text-info opacity-75">
                                                {{ ucfirst($empleado->puesto) }}

                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $empleado->telefono }}
                                    </td>
                                    <td>
                                        {{ ucfirst($empleado->estatus) }}
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('rh.empleados.show', $empleado->id) }}"
                                            class="btn btn-sm btn-primary-light btn-wave waves-effect waves-light">
                                            <i class="ri-eye-line"></i>
                                        </a>
                                        <a href="{{ route('rh.empleados.edit', $empleado->id) }}"
                                            class="btn btn-sm btn-info-light btn-wave waves-effect waves-light">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </thead>

                    </table>

                </div>
            </div>

        </div>
    </div>

    {{-- TABS de información --}}
    <div class="col-xl-4">
        {{-- <div class="col-12 col-xl-4 col-lg-6 col-md-6 col-sm-8 order-0 order-xl-1"> --}}
        <div class="card custom-card overflow-hidden">
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
                                        @if ($sucursal->estatus != 'abierta' && $susp == false)
                                            @php $susp=true; @endphp
                                            <li class="pb-0 mt-3">
                                                <p class="text-danger fs-12 fw-medium mb-2 op-7">Suspendidas</p>
                                            </li>
                                        @endif
                                        <li class="">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="ms-3">{{ $sucursal->nombre }}</span>
                                                <span
                                                    class="badge badge-lg bg-success-transparent rounded-circle ">{{ $sucursal->empleados_count }}</span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
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
                                                @for($i=0; $i < $puesto->empleados_por_puesto_count; $i++)
                                                <a href="javascript:void(0);" class="avatar avatar-sm rounded-circle">
                                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="img" class="h-100 w-100 rounded-circle">
                                                </a>
                                                @endfor
                                                {{-- <a href="javascript:void(0);" class="avatar avatar-sm rounded-circle">
                                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="img" class="h-100 w-100 rounded-circle">    
                                                </a>
                                                <a href="javascript:void(0);" class="avatar avatar-sm rounded-circle">
                                                    <img src="../assets/images/faces/16.jpg" alt="img" class="h-100 w-100 rounded-circle">
                                                    <img src="{{ asset('/assets/images/faces/default.png') }}" alt="img" class="h-100 w-100 rounded-circle">
                                                </a> --}}
                                            
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
{{-- </div> --}}



@endsection

@section('js')
<!-- Grid JS -->

<x-scripts.jquery :tables="'true'"/>





@endsection
