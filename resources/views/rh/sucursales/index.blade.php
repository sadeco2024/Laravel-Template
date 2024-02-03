@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')

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
                @can('rh.sucursal.add')
                    <a href="{{ route('rh.sucursales.create') }}" type="button" class="btn btn-sm btn-success-transparent">
                        <i class="bi bi-plus"></i>
                        Agregar Sucursal
                    </a>
                @endcan

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

                                @switch($sucursal->tipo)
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
                                @switch($sucursal->tipo)
                                    @case('Almacén')
                                        <span class="d-block text-warning opacity-75">
                                            {{ $sucursal->tipo }}
                                        </span>
                                    @break

                                    @default
                                        <span class="d-block text-info">
                                            {{ $sucursal->tipo }}
                                        </span>
                                @endswitch

                            </div>
                            <div class="text-sm-center">
                                <span class="fs-14 fw-medium">Empleados</span>
                                <span class="d-sm-block">
                                    {{ $sucursal->empleados_count }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="orders-delivery-address">
                                <p class="mb-1 fw-medium">Dirección</p>
                                <p class="text-muted mb-0">
                                    {{ $sucursal->calle }}, #{{ $sucursal->numero_exterior }}
                                    {{ $sucursal->numero_interior ? 'No. Int.: ' . $sucursal->numero_interior : '' }},
                                    {{ $sucursal->colonia }},
                                    {{ $sucursal->ciudad }},
                                    {{ $sucursal->estado }}
                                    C.P. {{ $sucursal->codigo_postal }}


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

                            @switch($sucursal->estatus)
                                @case('abierta')
                                    <x-badge class="bg-success-transparent" :text="$sucursal->estatus" />
                                @break

                                @case('suspendida')
                                    <x-badge class="bg-warning-transparent" :text="$sucursal->estatus" />
                                @break

                                @default
                                    <x-badge class="bg-danger-transparent" :text="$sucursal->estatus" />
                            @endswitch

                        </div>
                        
                        @canany(['rh.sucursal.show','rh.sucursal.edit','rh.sucursal.destroy'])
                            {{-- <a href="{{ route('rh.sucursales.show', $sucursal) }}" class="btn btn-sm btn-info-ghost">
                                <i class="bi bi-eye"></i>
                                Ver
                            </a> --}}
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="p-2 fs-12 text-muted" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Detalles
                                    <i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu" style="">
                                    @can('rh.sucursal.show')
                                        <li><a class="dropdown-item"  href="{{ route('rh.sucursales.show', $sucursal) }}">
                                                <i class="ri-eye-line align-middle me-1"></i>
                                                Información
                                            </a>
                                        </li>
                                    @endcan
                                    @can('rh.sucursal.edit')
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>                                    
                                        <li>
                                            <a class="dropdown-item" href="{{ route('rh.sucursales.edit', $sucursal) }}">
                                                <i class="ri-pencil-line align-middle me-1"></i>
                                                Editar
                                            </a>
                                        </li>
                                    @endcan
                                    {{-- @can('rh.sucursal.destroy')
                                        <!-- - El almacén no puede ser eliminado. -->
                                        @if ($sucursal->id !== 1)
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);">
                                                    <i class="ri-delete-bin-line align-middle me-1"></i>
                                                    Eliminar
                                                </a>
                                            </li>
                                        @endif
                                    @endcan --}}
                                </ul>
                            </div>
                        @endcanany

                        

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
