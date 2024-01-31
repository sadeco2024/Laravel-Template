@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')

@section('title-view', 'Editar sucursal')
@section('content')



    @can('rh.sucursal.destroy')
    <div class="row mb-3 ">
        <div class="col d-flex">
            <button id="delete-confirm-form" class="btn btn-sm btn-danger-transparent btn-wave waves-effect waves-light ms-auto" type="button">
                <i class="bi bi-trash"></i>
                Eliminar Sucursal
            </button>

        </div>
    </div>
    @endcan

    {{-- @dump($sucursal) --}}
    <div class="card custom-card">
        <div class="card-body">
            <form action="{{ route('rh.sucursales.update', $sucursal->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('rh.partials.form-sucursal', [
                    'btnText' => 'Actualizar',                  
                ])

            </form>
        </div>
    </div>
@endsection


