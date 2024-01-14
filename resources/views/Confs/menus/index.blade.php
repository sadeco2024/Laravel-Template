@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection
@section('title-view', 'Menús')
@section('content')


    <div class="container-fluid p-3 overflow-auto">

        {{-- Nav::Tabs --}}
        <div class="row mb-3 " role="tab-list">
            <div class="nav justify-content-start "role="">
                {{-- Menus DASH's --}}
                <div class="col-6 col-xxl-2 col-xl-3 col-lg-4 col-md-4 px-1">
                    <div class="card custom-card shadow-none bg-light">
                        <div class="card-body p-0 border rounded-2">
                            <a class="nav-link active" id="dash-tab" data-bs-toggle="tab" href="#dashboard" role="tab"
                                aria-controls="dashboard" aria-selected="true">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class="file-format-icon svg-primary">
                                        <i class="bi bi-house fs-25 text-secondary"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium fs-4 mb-1 text-secondary">
                                            DASH
                                        </span>
                                        <span class="fs-10 d-block text-muted text-end text-secondary">
                                            dashboards
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Menu Internos --}}
                <div class="col-6 col-xxl-2 col-xl-3 col-lg-4 col-md-4 px-1">
                    <div class="card custom-card shadow-none bg-light">
                        <div class="card-body p-0 border rounded-2">
                            <a class="nav-link" id="interno-tab" data-bs-toggle="tab" href="#internos" role="tab"
                                aria-controls="internos" aria-selected="true">
                                <div class="d-flex justify-content-between flex-wrap">
                                    <div class="file-format-icon svg-primary">
                                        <i class="bi bi-link-45deg fs-25 text-danger"></i>
                                    </div>
                                    <div>
                                        <span class="fw-medium fs-4 mb-1 text-danger">
                                            Internos
                                        </span>
                                        <span class="fs-10 d-block text-muted text-end text-danger">
                                            Links
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Foreach::$menu:: Arbol de menus --}}
                @foreach ($menus as $menu)
                    @if ($menu['concepto'] == 'menu')
                        <div class="col-6 col-xxl-2 col-xl-2 col-lg-4 col-md-4 px-1">
                            <div class="card custom-card shadow-none bg-light">
                                <div class="card-body p-0 border rounded-2">

                                    <a class="nav-link " id="{{ $menu['nombre'] }}-tab" data-bs-toggle="tab"
                                        href="#{{ $menu['nombre'] }}" role="tab" aria-controls="{{ $menu['nombre'] }}"
                                        aria-selected="false">
                                        <div class="d-flex justify-content-between flex-wrap">
                                            <div class="file-format-icon svg-primary">
                                                <i class="{{ $menu['icono'] }} fs-25 text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-medium fs-4 mb-1">
                                                    {{ $menu['nombre'] }}
                                                </span>
                                                <span class="fs-10 d-block text-muted text-end">
                                                    {{ $menu['concepto'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
        </div>
        {{-- Text:Relaciones --}}
        <div class="d-flex  align-items-center justify-content-between">
            <p class="mb-0 fw-medium fs-14">Relaciones</p>
            {{-- Btn:AgregarMenu --}}
            <div class="d-flex mb-3 align-items-center justify-content-between">
                <a class="modal-effect btn btn-warning-light btn-sm " data-bs-effect="effect-slide-in-right"
                    data-bs-toggle="modal" href="#modaldemo8">
                    <i class="bi bi-plus"></i>
                    Agregar menú

                </a>
            </div>
        </div>
        {{-- Nav:TabContent:: Relaciones  --}}
        <div class="tab-content mt-2">
            @include('Confs.partials.menu-tab-content')
        </div>
    </div>



    <!-- Modal::Agregar menú -->
    <div class="modal fade" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Agregar menu</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">

                    <form name="formMenusAdd" id="formMenusAdd" action="{{route('confs.menus.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="form-row">
                            <div class="col-12">
                                <x-inputs.name :name="'nombre'" />
                                <x-inputs.slug :name="'slug'" />
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                                        <x-selects.concepto :conceptos="$conceptos" />
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                                        <x-selects.orden :maximo="25" />
                                    </div>
                                </div>
                                <x-selects.modulo :modulos="$modulos" name="cg_modulo_id" />
                                {{-- <x-inputs.descripcion-textarea /> --}}
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                                        <x-inputs.icono />
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                        <x-selects.padre-menu :menus="$menus" />
                                    </div>                
                          
                                </div>
                                <div class="col-12 d-flex  align-items-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input bg-primary" checked type="checkbox" role="switch" name="enabled" id="enabled">
                                        <label class="form-check-label">Habilitado</label>
                                      </div>        
                                </div>
                            </div>
                        </div>
                    </form>
                    

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" form="formMenusAdd" type="submit">Guardar</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {

            @if ($errors->any())
                $('#modaldemo8').modal('show');
            @endif

        });
    </script>

@endsection