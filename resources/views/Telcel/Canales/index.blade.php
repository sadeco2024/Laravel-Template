@extends('layouts.auth')
@section('title', config('app.name') . ' - Canales Telcel')
@section('vite-js')

@endsection
@section('title-view', 'Listado de canales')
@section('content')



    <div class="row">
        {{-- Barra de información --}}


        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body d-flex align-items-baseline align-items-start flex-wrap">

                    <x-inputs.search-table :name="'src_producto'" />
                    <div class="flex-fill">

                        {{-- <span class="mb-0 fs-14 text-muted">Empleados</span> --}}
                        <span id="totActivos" class="badge bg-outline-success ms-2" title="Distribuidora">10</span>
                        <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Cadenas">4</span>
                        {{-- <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja">1</span> --}}

                    </div>
                    <div class="align-baseline  justify-content-start ">
                        <a class="modal-effect btn btn-success-light btn-sm " data-bs-effect="effect-slide-in-right"
                            data-bs-toggle="modal" href="#">
                            <i class="bi bi-plus"></i>
                            Agregar canal
                        </a>

                        <button id="btnActualizaCanales" class="btn btn-sm btn-outline-dark ms-2">
                            <i class="bi bi-arrow-clockwise fs-11" title="Actualizar canales"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xxl-12">


            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Canal</td>
                            <td>Clave</td>
                            <td>Id</td>
                            <td>Tipo</td>
                            <td>Sucursal</td>
                            <td>Usuarios</td>
                            <td></td>
                        </tr>
                    </thead>


                </table>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <x-scripts.jquery>
        <script>
            $(document).ready(function() {
                $('#btnActualizaCanales').click(function() {
                    $.ajax({
                        url: "{{ route('telcel.canales.refresh') }}",
                        
                        type: 'GET',
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        // data: {
                        //     '_token': "{{ csrf_token() }}"
                        // },
                        // dataType: 'json',
                        success: function(data) {
                            console.log(data);
                        }
                    });
                });
            });
        </script>
    </x-scripts.jquery>


@endsection
