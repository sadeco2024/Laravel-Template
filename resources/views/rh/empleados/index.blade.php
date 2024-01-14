@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection
@section('title-view', 'Lista de empleados')
@section('content')




    {{-- Barra de información --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body d-flex align-items-center flex-wrap">
                    {{-- Información --}}
                    {{-- TODO: Cuadros informativos, search, filtros --}}
                    <div class="flex-fill">
                        <span class="mb-0 fs-14 text-muted">Total : <span class="fw-medium text-success">
                                {{ $sucursales->count() }}
                            </span></span>
                    </div>
                    {{-- Agregar Empleado --}}
                    <a href="{{ route('rh.empleados.create') }}" type="button" class="btn btn-sm btn-success-transparent">
                        <i class="bi bi-plus"></i>
                        Agregar Empleado
                    </a>

                </div>
            </div>
        </div>
        {{-- Tabla de empleados --}}
        <div class="col-xl-8">
            <div class="card custom-card overflow-hidden">
            
            <div class="card-header justify-content-between">
                
                <div class="card-title">
                    <x-inputs.search-table name="empleados.search" />    
                </div>
                {{-- <div class="d-flex"></div> --}}
            </div> 
           
                {{-- Tabla de empleados --}}
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead class="bg-primary-transparent">
                                <tr>
                                    <th scope="col">Empleado</th>
                                    <th scope="col">Departamento</th>
                                    <th scope="col">Puesto</th>
                                    <th scope="col">Sucursal</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Estatus</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($empleados as $empleado)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <picture class="avatar avatar-lg bg-primary-transparent me-2">
                                                    <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                                        alt="img" class="">
                                                </picture>
                                                <div class="ms-2">
                                                    <p class="mb-0 d-flex align-items-center">
                                                        <a href="javascript:void(0);">
                                                            {{ $empleado->nombre->nombre }}
                                                        </a>
                                                    </p>
                                                    <p class="fs-12 text-muted my-1 mb-0">
                                                        {{ $empleado->user->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            Recursos Humanos
                                        </td>
                                        <td>Empleado general</td>
                                        <td>
                                            Almacén general
                                        <td>
                                            <div class="d-inline-flex align-items-center">
                                                <i class="bi bi-phone text-muted fs-10"></i>
                                                <span class="ms-1">9993665532</span>
                                            </div>
                                        </td>
                                        <td>
                                            <x-badge :text="'Activo'" class="bg-success-transparent" />
                                        </td>
                                        <td>
                                            <button type="button"
                                                class="btn btn-sm btn-outline-light btn-wave waves-effect waves-light">
                                                <i class="fe fe-eye text-muted"></i>
                                                View
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


                {{-- Footer Tabla --}}
                <div class="card-footer border-top-0">
                    <div class="d-flex align-items-center flex-wrap overflow-auto">
                        <div class="mb-2 mb-sm-0">
                            Showing <b>1</b> to <b>5</b> of <b>200</b> entries <i class="bi bi-arrow-right ms-2"></i>
                        </div>
                        <div class="ms-auto">
                            {{ $empleados->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABS de información --}}
        <div class="col-xl-4">            
            <div class="col-12 col-xl-4 col-lg-6 col-md-6 col-sm-8 order-0 order-xl-1">
                <div class="card custom-card">
                    <div class="">
                        {{-- Tabs --}}
                        <ul class="nav nav-tabs tab-style-2 nav-justified mb-0 border-bottom d-flex" role="tablist">
                            <li class="nav-item border-end me-0" role="tab">
                                <button class="nav-link active h-100" data-bs-toggle="tab"
                                    data-bs-target="#sucursales-tab-pane" type="button" role="tab"
                                    aria-controls="sucursales-tab-pane" aria-selected="true"><i
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
                                {{-- <ul class="list-unstyled mb-0 mt-2 ">
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
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Terminan Tabas de información --}}


        </div>
    </div>



@endsection

@section('js')

@endsection
