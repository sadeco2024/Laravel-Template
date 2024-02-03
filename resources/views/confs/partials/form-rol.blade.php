<div class="row">
    {{-- tabs --}}
    <div class="col-12 col-xxl-2 col-xl-2">
        <x-inputs.name-float 
            :name="'nombre'" 
            :text="'Nombre del rol'"
            value="{{ old('nombre', $role->nombre ?? '') }}"
            :disabled="$role->nombre ?? ''" 
        />
        {{-- Tabs de los modulos --}}
        <div class="nav flex-column nav-pills mt-3 me-3 tab-style-7 w-100 p-2 border border-dashed rounded"
            id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <!-- nav::modulos -->
            @foreach ($modulos as $modulo)
                <button class="nav-link text-start {{ $modulo->id > 1 ? '' : 'show active' }}"data-bs-toggle="pill"
                    data-bs-target="#modulo-{{ $modulo->slug }}" type="button" role="tab"
                    aria-controls="modulo-{{ $modulo->slug }}" aria-selected="true">
                    <i class="{{ $modulo->icono }} me-1 align-middle d-inline-block"></i>
                    {{ $modulo->nombre }}
                </button>
            @endforeach
        </div>
    </div>
    {{-- nav::contents --}}

    {{-- Guardar y agregar permiso --}}

    <div class="col-12 col-xxl-8 col-xl-8 ">
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary btn-sm mb-3 btn-submit" type="submit">
                <i class="{{ $btnIcon }}"></i>
                {{ $btnText }}
            </button>

            @can('confs.sadmin.permisos.add')
                <x-buttons.modal-crud
                    class="btn btn-success-transparent btn-sm d-grid mb-3 {{ request()->is('confs/roles/create') ? 'd-none' : '' }}"
                    href="#modalPermisos" 
                    :url="route('confs.roles.permissions.create')" 
                    :title="'Nuevo permiso'" 
                    :param="$role->id ?? NULL"
                >
                    <span>
                        <i class="bi bi-plus"></i>
                        Agregar permiso
                    </span>
                </x-buttons.modal-crud>
            @endcan
        </div>

        {{-- Tabs generados --}}
        <div class="tab-content border-0 ">
            @foreach ($modulos as $modulo)
                <div class="tab-pane border-0 {{ $modulo->id > 1 ? '' : 'show active' }}"
                    id="modulo-{{ $modulo->slug }}" role="tabpanel" tabindex="0">
                    <div class="form-group">
                        <ul class="list-group list-group-flush  ">
                            
                            @foreach ($permissions as $permission)
                            
                                @if ($permission->cg_modulo_id == $modulo->id)

                                    <li class="list-group-item ps-0">
                                        {{-- Check --}}
                                        <div class="form-check form-check-lg d-flex align-items-center ">
                                            <input 
                                                class="form-check-input form-check-input-lg me-1" 
                                                type="checkbox"
                                                id="permission-{{ $permission->id }}" 
                                                name="permissions[]"
                                                value="{{ $permission->id }}"
                                                aria-label="..."
                                                {{-- Valida si está o no el permiso en el rol que estamos editando --}}
                                                @if (isset($rolPermisos))
                                                     @foreach ($rolPermisos as $rolPermiso)
                                                        @if ($rolPermiso->id == $permission->id)
                                                            checked 
                                                        @endif
                                                    @endforeach
                                                @endif
                                        >
                                        {{-- Información del permiso --}}
                                        <div class="ms-2 py-1 d-flex flex-column align-items-start"
                                            for="permission-{{ $permission->id }}">
                                            <span class="fw-bold">{{ $permission->nombre }}</span>
                                            <span class="text-muted">
                                                <small>
                                                    {{ $permission->descripcion }}
                                                </small>
                                            </span>
                                            {{-- Para editar y ver el slug del permiso --}}
                                            @role('supadmin')
                                                <div class="d-flex align-items-center">
                                                    <x-badge class="bg-outline-warning rounded-pill" :text="$permission->name" />
                                                    <x-buttons.modal-crud 
                                                            class="btn btn-sm "
                                                            href="#modalPermisos"
                                                            :url="route('confs.roles.permissions.edit', $permission->id)" 
                                                            :title="'Editar permiso'" :param="$role->id ?? ''"
                                                        >
                                                            <span>
                                                                <i class="bi bi-pencil text-warning"></i>
                                                            </span>
                                                    </x-buttons.modal-crud>
                                                </div>
                                            @endrole
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Descripción del Rol --}}
    <div class="col-12 col-xxl-2 col-xl-2 overflow-hidden">

        <div class="form-floating mb-4 floating-info h-100 border border-dashed border-info rounded border-opacity-25">
            <textarea style="min-height: 150px; height:100%;"
                class="form-control border-0 {{ $errors->get('descripcion') ? 'is-invalid' : '' }}"
                placeholder="Leave a comment here" id="descripcion" name="descripcion"
                placeholder="Descripción de las características del rol.">{{ isset($role) ? $role->descripcion : old('descripcion') }}</textarea>
            <label for="floatingTextarea">Descripción</label>
            <x-input-error-line :messages="$errors->get('descripcion')" class="my-2" />
        </div>
    </div>
</div>
