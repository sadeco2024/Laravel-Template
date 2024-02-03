@extends('layouts.auth')

@section('title', config('app.name') . ' - Dashboard')


@section('title-view', 'Listado de Roles')


@section('content')


    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between">
            {{-- <span></span> --}}
            <span></span>
            @can('confs.role.add')
            <a href="{{ route('confs.roles.create') }}" class="btn btn-success-transparent btn-sm">
                <i class="bi bi-plus"></i>
                Agregar rol
            </a>
            @endcan


        </div>
    </div>

    <div class="row">
        @foreach ($roles as $role)
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                    <div class="card custom-card">

                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <div class="fs-20 mb-3">{{ $role->nombre }}</div>
                                </div>
                                <div>
                                    <span class="avatar avatar-md bg-outline-success">
                                        <i class="bi bi-person-gear fs-18"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between lh-1 text-muted mb-3">
                                {{ $role->descripcion }}
                            </div>
                            <div class=" fs-12 d-flex align-items-end justify-content-end lh-1 mt-2">

                                @can('confs.role.edit')
                                    <a href="{{ route('confs.roles.edit', $role) }}" class="text-primary opacity-75">
                                        Permisos
                                        <i class="fe fe-arrow-right"></i>
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach

    </div>

@endsection

@section('js')

@endsection
