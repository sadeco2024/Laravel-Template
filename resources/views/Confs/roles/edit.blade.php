@extends('layouts.auth')

@section('title', config('app.name') . ' - Permisos del rol')

@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection

@section('title-view', 'Editar Rol')

@section('content')
    {{-- @dump($modulos) --}}
    @if (session('success'))
        <div class="alert alert-success  alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="bi bi-x"></i>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('confs.roles.update', $role) }}">
                        @csrf
                        @method('PUT')
                        @include('Confs.partials.form-rol', [
                            'btnText' => 'Actualizar',
                            'btnIcon' => 'bi bi-arrow-clockwise',
                        ])
                    </form>
                    @if (isset($role))
                        <form action="{{ route('confs.roles.destroy', $role) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="d-grid gap-2 my-2 mb-0">
                                <button id="delete-confirm-form" class="btn btn-sm btn-danger-transparent btn-wave"
                                    type="button">
                                    <i class="bi bi-trash"></i>
                                    Eliminar Rol
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>

    </div>

    
    {{-- Modal permisos --}}

    <div class="modal fade " id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered text-center" role="document">

            <div class="modal-content modal-content-demo">

                <div class="modal-header">
                    <h6 class="modal-title">Nuevo permiso</h6><button aria-label="Close" class="btn-close"
                        data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">

                    <div class="form-row">
                        <form id="frmPermisosAdd" name="frmPermisosAdd"
                            action="{{ route('confs.roles.permissions.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="rol_id" value="{{ $role->id }}">
                            
                            <div class="col">

                                <x-inputs.name :name="'pnombre'" />
                                <x-selects.modulo :modulos="$modulos" :name="'pcg_modulo_id'" />
                                <x-inputs.slug :name="'pname'" />
                                <x-inputs.descripcion-textarea :name="'pdescripcion'" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" form="frmPermisosAdd" type="submit">Guardar</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                </div>

            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function pulsar(e) {
            if (e.which === 13 && !e.shiftKey) {
                e.preventDefault();
                return false;
            }
        }
    </script>

    <script>
        $(document).ready(function() {

            //Si existe un error en la validación del formulario modaldemo8, entonces volver a mostrar el modal



            @if (
                $errors->get('pname') != null ||
                    $errors->get('pdescripcion') != null ||
                    $errors->get('pcg_modulo_id') != null ||
                    $errors->get('pnombre') != null)
                $('#modaldemo8').modal('show');
            @endif
        });
    </script>


    @include('layouts.partials.swetalert')

@endsection