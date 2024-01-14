<div class="row">
    {{-- tabs --}}
    <div class="col-12 col-xxl-2 col-xl-2">
        <div class="form-floating">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                placeholder="Nombre del rol" value="{{ isset($role) ? $role->name : old('name') }}  ">
            <label for="floatingInput">Nombre del rol</label>
            <x-input-error-line :messages="$errors->get('name')" />

        </div>

        <div class="nav flex-column nav-pills mt-3 me-3 tab-style-7 w-100 p-2 border border-dashed rounded"
            id="v-pills-tab" role="tablist" aria-orientation="vertical">

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
    {{-- nav contents --}}

    {{-- Guardar y agregar permiso --}}
    <div class="col-12 col-xxl-8 col-xl-8 ">
        <div class="d-flex justify-content-between">
            <button class="btn btn-primary btn-sm mb-3" type="submit">
                <i class="{{ $btnIcon }}"></i>
                {{ $btnText }}
            </button>

            @can('confs.sadmin.permisos.add')
            
                <a class="modal-effect btn btn-success-transparent btn-sm d-grid mb-3 {{request()->is('confs/roles/create') ? 'd-none' : '' }}"
                    data-bs-effect="effect-slide-in-right" data-bs-toggle="modal" href="#modaldemo8">
                    <span>
                        <i class="bi bi-plus"></i>
                        Agregar permiso
                    </span>
                </a>
            
            @endcan
        </div>

        {{-- Tabs generados --}}
        <div class="tab-content border-0  " id="v-pills-tabContent">
            @foreach ($modulos as $modulo)
                <div class="tab-pane border-0 {{ $modulo->id > 1 ? '' : 'show active' }}"
                    id="modulo-{{ $modulo->slug }}" role="tabpanel" tabindex="0">
                    <div class="form-group">
                        <ul class="list-group list-group-flush  ">
                            @foreach ($permissions as $permission)
                                @if ($permission->cg_modulo_id == $modulo->id)
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox"
                                            id="permission-{{ $permission->id }}" name="permissions[]"
                                            value="{{ $permission->id }}" aria-label="..."
                                            @if (isset($rolPermisos)) @foreach ($rolPermisos as $rolPermiso)
                                                @if ($rolPermiso->id == $permission->id)
                                                    checked @endif
                                            @endforeach
                                @endif
                                >

                                </label>
                                <label class="form-check-label stretched-link" for="permission-{{ $permission->id }}">
                                    {{ $permission->descripcion }}
                                </label>
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
<div class="col-12 col-xxl-2 col-xl-2 d-block">

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
