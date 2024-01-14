@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection
@section('title-view', 'Sucursales')
@section('content')


    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body d-flex align-items-center flex-wrap">
                <div class="flex-fill">
                    <span class="mb-0 fs-14 text-muted">Total : <span class="fw-medium text-success">
                            {{ $sucursales->count() }}
                        </span></span>
                </div>
                <a href="{{ route('rh.sucursales.create') }}" type="button" class="btn btn-sm btn-success-transparent">
                    <i class="bi bi-plus"></i>
                    Agregar Sucursal
                </a>

            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($sucursales as $sucursal)
            <div class="col-xl-6 col-xxl-4 col-lg-6 col-md-6 col-sm-12">
                <div class="card custom-card">
                    <div class="card-header d-block">
                        <div class="d-sm-flex d-block align-items-center">
                            <div class="me-2">

                                @switch($sucursal->tipo->concepto)
                                    @case('Almacén')
                                        <span class="avatar avatar-lg bg-warning-transparent">
                                            <i class="bi bi-building my-1 fs-3 text-warning opacity-75"></i>
                                        </span>
                                    @break

                                    @default
                                        <span class="avatar avatar-lg bg-info-transparent">
                                            <i class="bi bi-shop my-1 fs-3 text-info"></i>
                                        </span>
                                @endswitch

                            </div>
                            <div class="flex-fill">
                                <a href="javascript:void(0)">
                                    <span class="fs-14 fw-medium">
                                        {{ $sucursal->nombre }}
                                    </span>
                                </a>
                                @switch($sucursal->tipo->concepto)
                                    @case('Almacén')
                                        <span class="d-block text-warning opacity-75">
                                            {{ $sucursal->tipo->concepto }}
                                        </span>
                                    @break

                                    @default
                                        <span class="d-block text-info">
                                            {{ $sucursal->tipo->concepto }}
                                        </span>
                                @endswitch

                            </div>
                            <div class="text-sm-center">
                                <span class="fs-14 fw-medium">Empleados</span>
                                <span class="d-sm-block">
                                    {{ $sucursal->empleados->count() }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="orders-delivery-address">
                                <p class="mb-1 fw-medium">Dirección</p>
                                <p class="text-muted mb-0">
                                    {{ $sucursal->direccion->calle }}, #{{ $sucursal->direccion->numero_exterior }}
                                    {{ $sucursal->direccion->numero_interior ? 'No. Int.: ' . $sucursal->direccion->numero_interior : '' }},
                                    {{ $sucursal->direccion->colonia }},
                                    {{ $sucursal->direccion->ciudad->ciudad }},
                                    {{ $sucursal->direccion->estado->estado }}
                                    C.P. {{ $sucursal->direccion->codigo_postal }}


                                </p>
                            </div>
                            {{-- <div class="ms-auto text-end">
                                <span class="text-muted text-primary fs-12">Jefe</span>
                                <span class="d-block fw-medium">Hermilo Antonio Sánchez de Córdova</span>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-footer d-sm-flex d-block align-items-center justify-content-between">
                        <div><span class="text-muted me-2">Estatus:</span>

                            @switch($sucursal->estatus->estatus)
                                @case('Abierta')
                                    <x-badge class="bg-success-transparent" :text="$sucursal->estatus->estatus" />
                                @break

                                @case('Suspendida')
                                    <x-badge class="bg-warning-transparent" :text="$sucursal->estatus->estatus" />
                                @break

                                @default
                                    <x-badge class="bg-danger-transparent" :text="$sucursal->estatus->estatus" />
                            @endswitch

                        </div>
                        {{-- <div class="mt-sm-0 mt-2"> --}}
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Detalles
                                <i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu" style="">
                                <li><a class="dropdown-item" href="javascript:void(0);">
                                        <i class="ri-eye-line align-middle me-1"></i>
                                        Información
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('rh.sucursales.edit', $sucursal) }}">
                                        <i class="ri-pencil-line align-middle me-1"></i>
                                        Editar
                                    </a>
                                </li>
                                @if ($sucursal->id !== 1)
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="javascript:void(0);">
                                            <i class="ri-delete-bin-line align-middle me-1"></i>
                                            Eliminar
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        {{-- <button class="btn btn-sm btn-info-ghost">Editar >></button> --}}
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>



@endsection

@section('js')

@endsection