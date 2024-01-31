@extends('layouts.auth')
@section('title', config('app.name') . ' - Activaciones prepago')
@section('vite-js')

@endsection
@section('title-view', 'Activaciones prepago')
@section('content')



<div class="row">
    {{-- Barra de información --}}


    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body d-flex align-items-baseline align-items-center justify-content-between flex-wrap">
                
                
                <div class="">
             
                    {{-- <span class="mb-0 fs-14 text-muted">Empleados</span> --}}
                    <span id="totActivos" class="badge bg-outline-success ms-2" title="Distribuidora">10</span>
                    <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Cadenas">4</span>
                    {{-- <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja">1</span> --}}

                </div>
                <form action="{{ route('telcel.activaciones.download') }}" method="POST">
                    @csrf
                <div class="d-flex flex-fill flex-nowrap align-items-center justify-content-end">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text text-muted"> <i class="ri-calendar-line"></i> </div>
                                <input type="text" class="form-control daterange" name="fecha_rango" placeholder="Rango de fechas">
                            </div>
                        </div>                        
                        <button type="submit" class="btn btn-sm btn-outline-primary ms-2 save " title="Cargar últimas activaciones">
                            <i class="bi bi-arrow-clockwise fs-11" ></i>
                        </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

    <x-scripts.flatpickr />
    <x-scripts.sweetalert />

@endsection
