@extends('layouts.auth')
@section('title', config('app.name') . ' - Catálogo de productos')
@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection
@section('title-view', 'Artículos')
@section('content')

    <style>
        .card-articulos {
            min-height: 112px;
        }
    </style>

    <div class="row">
        {{-- Barra de información --}}


        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-body d-flex align-items-baseline align-items-start flex-wrap">
                    {{-- Información --}}
                    {{-- TODO: Cuadros informativos, search, filtros --}}
                    {{-- <div class="card-title mt-1"> --}}

                    {{-- </div>                 --}}
                    <x-inputs.search-table :name="'src_producto'" />
                    <div class="flex-fill">

                        {{-- <span class="mb-0 fs-14 text-muted">Empleados</span> --}}
                        <span id="totActivos" class="badge bg-outline-success ms-2" title="Activos">10</span>
                        <span id="totSuspendidos" class="badge bg-outline-warning ms-2" title="Suspendidos">4</span>
                        <span id="totBaja" class="badge bg-outline-danger ms-2" title="Baja">1</span>

                    </div>
                    <div class="align-baseline  justify-content-start ">
                        <a class="modal-effect btn btn-success-light btn-sm " data-bs-effect="effect-slide-in-right"
                            data-bs-toggle="modal" href="#modaldemo8">
                            <i class="bi bi-plus"></i>
                            Agregar artículo

                        </a>
                        {{-- <a href="{{ route('rh.empleados.create') }}" type="button"
                            class="btn btn-sm btn-success-transparent">
                            <i class="bi bi-plus"></i>
                            Agregar artículo
                        </a> --}}
                    </div>

                    {{-- Agregar Empleado --}}


                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="tableProductos">


    </div>

    <!-- Modal::Editar articulo -->
    <div class="modal fade " id="modaldemo8">
        <div class="modal-dialog modal-lg modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header ">
                    <div class="d-flex flex-column text-start align-items-between justify-content-between  ">
                        <h6 class="modal-title mb-2">
                            Cigarros Carranza Rojo 20's Cajetilla
                        </h6>
                        {{-- <div> --}}

                        <div class="btn-group btn-group-toggle my-2 gap-2" data-bs-toggle="buttons">
                            <label class="text-muted">Se vende por </label>
                            <label class="">
                                <input type="radio" name="options" id="option1" autocomplete="off" checked>
                                Paquete
                            </label>
                            <label>


                                <input type="radio" name="options" id="option2" autocomplete="off"> Pieza
                            </label>
                            <label>
                                <input type="radio" name="options" id="option3" autocomplete="off"> Preguntar
                            </label>
                        </div>

                        {{-- </div> --}}
                        <div class="d-flex align-baseline mt-2">
                            <i class='bx bx-barcode text-success fs-4 me-1'></i>
                            <span class="text-muted">
                                75508787856566588
                            </span>
                        </div>
                    </div>
                    <div>
                        <span class="avatar avatar-xl h-100 bg-primary-transparent rounded">
                            <i class="bi bi-shop fs-4"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body text-start">

                    <div class="card-body">
                        {{-- PILLS --}}
                        <ul class="nav nav-pills justify-content-around nav-style-2 mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page"
                                    href="#home-center" aria-selected="true">Detalles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                    href="#about-center" aria-selected="false">Compras</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                    href="#services-center" aria-selected="false">Ventas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                    href="#contacts-center" aria-selected="false">Historial</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page"
                                    href="#config-center" aria-selected="false">Configuracion</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            {{-- Detalles --}}
                            <div class="tab-pane show active text-muted" id="home-center" role="tabpanel">
                                <div class="card-body pb-0">
                                    <div class="accordion accordion-info accordion-flush" id="accordionPrimaryExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingExistencias">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapsePrimaryOne" aria-expanded="true"
                                                    aria-controls="collapsePrimaryOne">
                                                    Existencias
                                                </button>
                                            </h2>
                                            <div id="collapsePrimaryOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingExistencias" {{-- data-bs-parent="#accordionPrimaryExample" --}}>
                                                <div class="accordion-body pt-0 ">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm w-100">
                                                            <thead class="">
                                                                <tr class="text-center">
                                                                    <th width="20%">Paquetes</th>
                                                                    <th width="20%">Piezas</th>
                                                                    <th width="60%" class="text-right">Alerta para
                                                                        reponer</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="text-center">
                                                                    <td>
                                                                        <i
                                                                            class="bi bi-pencil text-info opacity-50 me-2 cursor-pointer"></i>
                                                                        3
                                                                    </td>
                                                                    <td>17</td>
                                                                    <td>2</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingPrimaryTwo">
                                                <button class="accordion-button " type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsePrimaryTwo"
                                                    aria-expanded="true" aria-controls="collapsePrimaryTwo">
                                                    Detalle por paquete
                                                </button>
                                            </h2>
                                            <div id="collapsePrimaryTwo" class="accordion-collapse collapse show"
                                                aria-labelledby="headingPrimaryTwo" {{-- data-bs-parent="#accordionPrimaryExample" --}}>
                                                <div class="accordion-body pt-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm w-100">
                                                            <thead class="">
                                                                <tr class="text-center">
                                                                    <th width="20%">Precio</th>
                                                                    <th width="20%">Costo</th>
                                                                    <th width="60%" class="text-right">
                                                                        Margen promedio
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="text-center">
                                                                    <td>$ 60.00</td>
                                                                    <td>$ 45.00</td>
                                                                    <td>18.68%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingPrimaryThree">
                                                <button class="accordion-button  h" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapsePrimaryThree"
                                                    aria-expanded="true" aria-controls="collapsePrimaryThree">
                                                    Detalle por pieza
                                                </button>
                                            </h2>
                                            <div id="collapsePrimaryThree" class="accordion-collapse collapse show "
                                                aria-labelledby="headingPrimaryThree" {{-- data-bs-parent="#accordionPrimaryExample" --}}>
                                                <div class="accordion-body pt-0">
                                                    <div class="table-responsive">
                                                        <table class="table table-sm w-100">
                                                            <thead class="">
                                                                <tr class="text-center">
                                                                    <th width="20%">Precio</th>
                                                                    <th width="20%">Costo promedio</th>
                                                                    <th width="60%" class="text-right">
                                                                        Margen promedio
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="text-center">
                                                                    <td>$ 60.00</td>
                                                                    <td>$ 45.00</td>
                                                                    <td>18.68%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            {{-- Compras --}}
                            <div class="tab-pane text-muted" id="about-center" role="tabpanel">
                                <div class="alert svg-primary alert-primary alert-dismissible fade show custom-alert-icon shadow-sm"
                                    role="alert">
                                    <i class="bi bi-info-circle-fill me-1 text-info fs-5"></i>
                                    Se muestran las compras del último mes.
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover align-middle">
                                        <thead class="text-center">
                                            <tr>
                                                <td>Fecha</td>
                                                <td>Cantidad</td>
                                                <td>Proveedor</td>
                                                <td>Costo</td>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>12/09/2021</td>
                                                <td>10</td>
                                                <td>Barcel</td>
                                                <td>$ 18.00</td>
                                            </tr>
                                            <tr>
                                                <td>10/09/2021</td>
                                                <td class="text-center">5</td>
                                                <td>Barcel</td>
                                                <td>$ 17.50</td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- Ventas --}}
                            <div class="tab-pane text-muted" id="services-center" role="tabpanel">
                                <div class="alert svg-primary alert-primary alert-dismissible fade show custom-alert-icon shadow-sm"
                                    role="alert">
                                    <i class="bi bi-clock-history me-1 text-info fs-5"></i>
                                    Ventas realizadas desde el lunes
                                </div>
                            </div>
                            {{-- Historial --}}
                            <div class="tab-pane text-muted" id="contacts-center" role="tabpanel">
                                <div class="table-responsive">

                                    <table class="table table-sm table-hover align-middle">
                                        <thead class="text-center">
                                            <tr>
                                                <td>Fecha</td>
                                                <td>Datos</td>
                                                <td>Stock previo</td>
                                                <td>Cantidad</td>
                                                <td>Stock actual</td>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <tr>
                                                <td>
                                                    09:25<br>
                                                    12/09/2021
                                                </td>
                                                <td>
                                                    Compra<br>
                                                    <strong>Milo</strong>
                                                </td>
                                                <td>5</td>
                                                <td class="text-success">+10 uds</td>
                                                <td>15 uds</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    16:40<br>
                                                    10/09/2021
                                                </td>
                                                <td>
                                                    Venta<br>
                                                    <strong>Mariana</strong>
                                                </td>
                                                <td>7</td>
                                                <td class="text-danger">-2 uds</td>
                                                <td>5 uds</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    11:02<br>
                                                    10/09/2021
                                                </td>
                                                <td>
                                                    Compra<br>
                                                    <strong>Carlos</strong>
                                                </td>
                                                <td>2</td>
                                                <td class="text-success">+5 uds</td>
                                                <td>7 uds</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            {{-- Configuraciones --}}
                            <div class="tab-pane text-muted" id="config-center" role="tabpanel">
                                <div id="form-ajax">

                                </div>



                            </div>
                        </div>
                    </div>




                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" form="fomArticuloAdd" type="submit">Guardar</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')

    <x-scripts.jquery>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {

                var modal = $('#modaldemo8');
                var modalBody = $('#modalBody');

                modal.on('show.bs.modal', function(e) {
                    var row = modal.data('row'); // Recupera el valor de data-row
                    if (typeof row === 'string') {
                        row = JSON.parse(row);
                        $('.modal-title').html(row.nombre);
                    }
                    $.ajax({
                        url: "/erp/articulos/" + row.id + "/edit",
                        type: 'GET',
                        success: function(data) {
                            $('#form-ajax').html(data); // Inserta la vista en el cuerpo del modal
                        }
                    });
                });

                // Busqueda de productos
                var timerId = null;
                $('#src_producto').on('keyup', function() {
                    var searchValue = $(this).val();
                    if (timerId) {
                        clearTimeout(timerId);
                    }
                    timerId = setTimeout(function() {
                        $.ajax({
                            url: "/generales/getArticulos",
                            type: 'GET',
                            data: {
                                search: searchValue
                            },
                            success: function(data) {
                                $('#tableProductos').html(data);
                            }
                        });
                    }, 200);
                });
                $('#src_producto').keyup();

            });
        </script>
    </x-scripts.jquery>

@endsection
