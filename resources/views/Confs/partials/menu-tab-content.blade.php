{{-- Tab::Dashboard --}}
<div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Icono</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Slug</th>

                    <th scope="col">Módulo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    @if ($menu['concepto'] == 'dash')
                        <tr>
                            <td width="10px">
                                <i class=" fs-5 text-secondary {{ $menu['icono'] }}"></i>
                            </td>
                            <td>{{ $menu['nombre'] }}</td>
                            <td>{{ $menu['slug'] }}</td>
                            <td>
                                <x-badges.modulo>
                                    {{ $menu['modulo'] }}
                                </x-badges.modulo>
                            </td>
                            <td>
                                <div class="hstack gap-2 fs-15">
                                    <a class="modal-effect btn btn-info-light btn-sm" title="Editar"
                                        data-bs-effect="effect-slide-in-right" data-bs-toggle="modal" href="#modalMenu"
                                        data-url="{{ route('confs.menus.edit', ['menu' => $menu['id']]) }}"
                                        data-title="Editar menu">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    {{-- <form action="{{ route('confs.menus.destroy', $menu['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Inhabilitar"
                                            class="btn btn-icon btn-sm btn-danger-light ">
                                            <i class="bi bi-ban"></i>
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Tab::Internos --}}
<div class="tab-pane fade " id="internos" role="tabpanel" aria-labelledby="internos-tab">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th width="10px" scope="col">Módulo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Slug</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($menus as $menu)
                    {{-- @dump($menu,$menu["concepto"]); --}}
                    @if ($menu['concepto'] == 'interno')
                        <tr>
                            <td>
                                <x-badges.modulo class="text-danger">
                                    {{ $menu['modulo'] }}
                                </x-badges.modulo>
                            </td>
                            <td>{{ $menu['nombre'] }}</td>
                            <td>{{ $menu['slug'] }}</td>
                            <td>
                                <div class="hstack gap-2 fs-15">

                                    <a class="modal-effect btn btn-info-light btn-sm "
                                        data-bs-effect="effect-slide-in-right" data-bs-toggle="modal" href="#modalMenu"
                                        data-url="{{ route('confs.menus.edit', ['menu' => $menu['id']]) }}"
                                        data-title="Editar menu">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                          
                                    {{-- <form action="{{ route('confs.menus.destroy', $menu['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Inhabilitar"
                                            class="btn btn-icon btn-sm btn-danger-light ">
                                            <i class="bi bi-ban"></i>
                                        </button>
                                    </form> --}}
                  
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Tab::Menus --}}
@foreach ($menus as $menu)
    <div class="tab-pane fade" id="{{ $menu['nombre'] }}" role="tabpanel" aria-labelledby="{{ $menu['nombre'] }}-tab">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Icono</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Tipo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menu['submenu'] as $submenu)
                        <tr>
                            <td width="10px">{{ $submenu['id'] }}</td>

                            <td width="10px">
                                <i class=" fs-5 text-secondary {{ $submenu['icono'] }}"></i>
                            </td>
                            <td>{{ $submenu['nombre'] }}</td>
                            <td>
                                <span class="text-primary">
                                    {{ $menu['slug'] }}.
                                </span>
                                <span>

                                    {{ $submenu['slug'] }}
                                </span>
                            </td>
                            <td>
                                @switch($submenu["concepto"])
                                    @case('vista')
                                        <span class="text-secondary">
                                            {{ $submenu['concepto'] }}
                                        </span>
                                    @break

                                    @case('crud')
                                        <span class="text-warning">
                                            {{ $submenu['concepto'] }}
                                        </span>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                <div class="hstack gap-2 fs-15">
                                    <a 
                                        class="modal-effect btn btn-info-light btn-sm "
                                        data-bs-effect="effect-slide-in-right" data-bs-toggle="modal" href="#modalMenu"
                                        data-url="{{ route('confs.menus.edit', ['menu' => $submenu['id']]) }}"
                                        data-title="Editar menu">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    {{-- <a href="javascript:void(0);"
                                        class="btn btn-icon btn-sm btn-danger-light rounded-pill">
                                        <i class="ri-delete-bin-line"></i>
                                    </a> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endforeach
