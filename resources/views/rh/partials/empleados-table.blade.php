<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover text-nowrap">
            <thead class="bg-primary-transparent">
                <tr>
                    <th scope="col">Empleado</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Sucursal</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Estatus</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>
                            <div class="d-flex">
                                <picture class="avatar avatar-lg bg-primary-transparent me-2">
                                    <img src="{{ Vite::asset('resources/assets/images/faces/9.jpg') }}"
                                        alt="img" class="">
                                </picture>
                                <div class="ms-2">
                                    <p class="mb-0 d-flex align-items-center">
                                        <a href="javascript:void(0);">
                                            {{ $empleado->nombre->nombre }}
                                        </a>
                                    </p>
                                    <p class="fs-12 text-muted my-1 mb-0">
                                        {{ $empleado->user->email }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td>
                            Recursos Humanos
                        </td>
                        <td>Empleado general</td>
                        <td>
                            Almacén general
                        <td>
                            <div class="d-inline-flex align-items-center">
                                <i class="bi bi-phone text-muted fs-10"></i>
                                <span class="ms-1">9993665532</span>
                            </div>
                        </td>
                        <td>
                            <x-badge :text="'Activo'" class="bg-success-transparent" />
                        </td>
                        <td>
                            <button type="button"
                                class="btn btn-sm btn-outline-light btn-wave waves-effect waves-light">
                                <i class="fe fe-eye text-muted"></i>
                                View
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>