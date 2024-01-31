@extends('layouts.auth')

@section('title', config('app.name') . ' - Permisos del rol')



@section('title-view', 'Editar Rol')

@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('confs.roles.update', $role) }}">
                        @csrf
                        @method('PUT')

                        @include('confs.partials.form-rol', [
                            'btnText' => 'Actualizar',
                            'btnIcon' => 'bi bi-arrow-clockwise',
                        ])
                    </form>
                    @if (isset($role))
                        @can('confs.role.delete')
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
                        @endcan
                    @endif
                </div>
            </div>
        </div>

    </div>

    <!-- Modal::Agregar Permiso -->
    <div class="modal fade sd-modalForm" id="modalPermisos" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Nuevo permiso</h6>
                    <button aria-label="Close" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    {{-- //** La clase: "sd-modalForm" - hace carga el form-menu (create, edit) --}}
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" form="frmPermisosAdd" type="submit">Guardar</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal permisos --}}

    {{-- <div class="modal fade " id="modaldemo8">
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
    </div> --}}

    <x-scripts.jquery :sweetAlert="'true'">
        <script>
            function pulsar(e) {
                if (e.which === 13 && !e.shiftKey) {
                    e.preventDefault();
                    return false;
                }
            }
      
        </script>
        </x-script.jquery>
        @vite('resources/js/modales.js')


        {{-- @include('layouts.partials.swetalert') --}}

    @endsection
