@extends('layouts.auth')
@section('title', config('app.name') . ' - Perfil del empleado')

@section('title-view', 'Perfil del empleado')
@section('content')


        <div class="col-12 d-flex justify-content-end mb-2">
            <a class="btn btn-primary-transparent btn-sm btn-icon-start btn-wave"
                href="{{ route('rh.empleados.edit', $empleado) }}">
                <i class="ri-pencil-line align-middle"></i>
                Editar perfil
            </a>
        </div>


        <div class="col-xl-8 order-1">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap align-items-top gap-5 gap-md-3 p-2 border-bottom-0">
                        <div>
                            <div class="d-flex align-items-center gap-2 gap-md-0 mb-4">
                                {{-- Avatar --}}
                                <div class="lh-1 d-none d-md-block">
                                    <span class="avatar avatar-xxl avatar-rounded online me-3">
                                        <img src="{{ asset('/assets/images/faces/default.png') }}" alt="">
                                    </span>
                                </div>
                                {{-- RH - Empleado --}}
                                <div class="flex-fill main-profile-info">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <h6 class="fw-medium mb-1">{{ $empleado->nombre->nombre }}</h6>
                                    </div>
                                    <p class="mb-1 text-muted op-7">
                                        <i class="bi bi-shop text-primary me-1"></i>
                                        {{ $empleado->sucursal->nombre }}
                                    </p>
                                    <p class="mb-1 text-muted op-7">
                                        <i class="bi bi-people-fill text-info me-1"></i>
                                        {{ $empleado->puesto->descripcion }}
                                    </p>
                                    <p class="fs-12 mb-0 op-5">
                                        <span class="me-3">
                                            <i class="ri-building-line me-1 align-middle"></i>
                                            {{ $empleado->direccion->ciudad->ciudad }}
                                        </span>
                                    </p>
                                    <p class="fs-12 mb-0 op-5">
                                        <span>
                                            <i class="ri-map-pin-line me-1 align-middle"></i>
                                            {{ $empleado->direccion->estado->estado }}
                                        </span>
                                    </p>

                                </div>
                            </div>
                         
                        </div>
                        {{-- Contacto --}}
                        <div>
                            <p class="fs-15 mb-2 me-4 fw-medium">Información de contacto :</p>
                            <div class="text-muted">
                                
                                <p class="mb-1 mb-md-3 mb-lg-4">
                                    <span class="avatar avatar-sm avatar-rounded me-2 bg-light border text-muted">
                                        <i class="ri-mail-line align-middle fs-14"></i>
                                    </span>
                                    {{ $empleado->correo->correo }}
                                </p>
                                <p class="mb-1 mb-md-3 mb-lg-4">
                                    <span class="avatar avatar-sm avatar-rounded me-2 bg-light border text-muted">
                                        <i class="ri-phone-line align-middle fs-14"></i>
                                    </span>
                                    {{ $empleado->telefonoCorporativo->telefono ?? $empleado->telefono->telefono }}
                                </p>
                                <p class="mb-1 mb-md-3 mb-lg-4">
                                    <span class="avatar avatar-sm avatar-rounded me-2 bg-light border text-muted">
                                        <i class="ri-map-pin-line align-middle fs-14"></i>
                                    </span>
                                    
                                    {{ $empleado->direccion->calle }} {{ $empleado->direccion->numero_exterior }}
                                    {{ $empleado->direccion->numero_interior }}
                                </p>
                            </div>
                        </div>
                        <div class="skills-section">
                            <p class="fs-15 mb-2 me-4 fw-medium">Accesos :</p>
                            <div class="d-flex align-items-center gap-1 flex-wrap flex-md-nowrap mb-3">
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">Empleado General</span>
                                </a>
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">Mesa de control</span>
                                </a>
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">Prepago</span>
                                </a>
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">Revision Sucursal</span>
                                </a>
                                {{-- <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">Programming</span>
                                </a>
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">Security</span>
                                </a>
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">Python</span>
                                </a>
                                <a href="javascript:void(0);">
                                    <span class="badge bg-light border text-muted fw-medium">JavaScript</span>
                                </a> --}}
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <span class="avatar avatar-sm avatar-rounded me-1 bg-light border text-muted">
                                    <i class="ri-shield-user-line align-middle fs-14 text-success" title="Jefe inmediato"></i>
                                </span>                                
                                <span class="d-flex flex-column">
                                    <span>
                                        Jorge Sánchez
                                    </span>
                                    <span class="text-muted fs-12 ">
                                        jasanchez@sadeco.mx    </span>
                                </span>
          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6  order-3">
            {{-- Información de la sucursal --}}
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="bi bi-shop text-primary me-1"></i>
                        {{ $empleado->sucursal->nombre }}
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mt-0">
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="fw-medium">
                                    <i class="bi bi-person-bounding-box text-info me-1"></i>
                                    Gerente :
                                </div>
                                <span class="fs-12 ms-2 text-muted">Toni Stark</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    <i class="bi bi-person-check text-info me-1"></i>
                                    Supervisor :
                                </div>
                                <span class="fs-12 text-muted">Jesus Contreras</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    <i class="bi bi-person-circle text-info me-1"></i>
                                    Encargado :
                                </div>
                                <span class="fs-12 text-muted">Marcos Ramirez</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <div class="card custom-card overflow-hidden">
                <div class="card-header">
                    <div class="card-title">
                        Followers :
                    </div>
                </div>
                <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="d-sm-flex align-items-top flex-wrap gap-3">
                                    <div>
                                        <span class="avatar avatar-sm">
                                            <img src="../assets/images/faces/1.jpg" alt="img">
                                        </span>
                                    </div>
                                    <div class="mt-sm-0 mt-1 fw-medium flex-fill">
                                        <p class="mb-0 lh-1">Alicia Sierra</p>
                                        <span class="fs-11 text-muted op-7">aliciasierra389@gmail.com</span>
                                    </div>
                                    <button class="btn btn-light btn-wave btn-sm">Follow</button>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-sm-flex align-items-top flex-wrap gap-3">
                                    <div>
                                        <span class="avatar avatar-sm">
                                            <img src="../assets/images/faces/3.jpg" alt="img">
                                        </span>
                                    </div>
                                    <div class="mt-sm-0 mt-1 fw-medium flex-fill">
                                        <p class="mb-0 lh-1">Samantha Mery</p>
                                        <span class="fs-11 text-muted op-7">samanthamery@gmail.com</span>
                                    </div>
                                    <button class="btn btn-light btn-wave btn-sm">Follow</button>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-sm-flex align-items-top flex-wrap gap-3">
                                    <div>
                                        <span class="avatar avatar-sm">
                                            <img src="../assets/images/faces/6.jpg" alt="img">
                                        </span>
                                    </div>
                                    <div class="mt-sm-0 mt-1 fw-medium flex-fill">
                                        <p class="mb-0 lh-1">Juliana Pena</p>
                                        <span class="fs-11 text-muted op-7">juliapena555@gmail.com</span>
                                    </div>
                                    <button class="btn btn-light btn-wave btn-sm">Follow</button>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-sm-flex align-items-top flex-wrap gap-3">
                                    <div>
                                        <span class="avatar avatar-sm">
                                            <img src="../assets/images/faces/15.jpg" alt="img">
                                        </span>
                                    </div>
                                    <div class="mt-sm-0 mt-1 fw-medium flex-fill">
                                        <p class="mb-0 lh-1">Adam Smith</p>
                                        <span class="fs-11 text-muted op-7">adamsmith99@gmail.com</span>
                                    </div>
                                    <button class="btn btn-light btn-wave btn-sm">Follow</button>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-sm-flex align-items-top flex-wrap gap-3">
                                    <div>
                                        <span class="avatar avatar-sm">
                                            <img src="../assets/images/faces/13.jpg" alt="img">
                                        </span>
                                    </div>
                                    <div class="mt-sm-0 mt-1 fw-medium flex-fill">
                                        <p class="mb-0 lh-1">Farhaan Amhed</p>
                                        <span class="fs-11 text-muted op-7">farhaanahmed989@gmail.com</span>
                                    </div>
                                    <button class="btn btn-light btn-wave btn-sm">Follow</button>
                                </div>
                            </li>
                        </ul>
                </div>
            </div>  --}}
        </div>

        <div class="col-xl-4 col-md-6 order-2">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        {{-- <i class="bi bi-shop text-primary me-1"></i> --}}
                        Información Personal
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush mt-0">
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    Nombre :
                                </div>
                                <span class="fs-12 text-muted">Hermilo Antonio Sánchez de Córdova</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    Correo :
                                </div>
                                <span class="fs-12 text-muted">hsanchez@sadeco.mx</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    Teléfono :
                                </div>
                                <span class="fs-12 text-muted">9993665532</span>
                            </div>
                        </li>
                        {{-- <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    Puesto :
                                </div>
                                <span class="fs-12 text-muted">Subgerente</span>
                            </div>
                        </li> --}}
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    Edad :
                                </div>
                                <span class="fs-12 text-muted">41</span>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="me-2 fw-medium">
                                    F. Ingreso :
                                </div>
                                <span class="fs-12 text-muted">12/01/2022</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- tabs --}}
        <div class="col-xl-8 col-md-12 order-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body p-0">
                            <div
                                class="p-3 border-bottom border-block-end-dashed d-flex align-items-center justify-content-between">
                                <div>
                                    <ul class="nav nav-tabs mb-0 tab-style-6 justify-content-start" id="myTab"
                                        role="tablist">
                                        <li class="nav-item " role="presentation">
                                            <button class="nav-link active" id="activity-tab" data-bs-toggle="tab"
                                                data-bs-target="#activity-tab-pane" type="button" role="tab"
                                                aria-controls="activity-tab-pane" aria-selected="false"><i
                                                    class="ri-gift-line me-1 align-middle d-inline-block"></i>Accesos</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="posts-tab" data-bs-toggle="tab"
                                                data-bs-target="#posts-tab-pane" type="button" role="tab"
                                                aria-controls="posts-tab-pane" aria-selected="false"><i
                                                    class="ri-bill-line me-1 align-middle d-inline-block"></i>Ventas</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="followers-tab" data-bs-toggle="tab"
                                                data-bs-target="#followers-tab-pane" type="button" role="tab"
                                                aria-controls="followers-tab-pane" aria-selected="true"><i
                                                    class="ri-money-dollar-box-line me-1 align-middle d-inline-block"></i>Experiencia</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="gallery-tab" data-bs-toggle="tab"
                                                data-bs-target="#gallery-tab-pane" type="button" role="tab"
                                                aria-controls="gallery-tab-pane" aria-selected="false"><i
                                                    class="ri-exchange-box-line me-1 align-middle d-inline-block"></i>Gráficas</button>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    {{-- <p class="fw-medium mb-2">Complete your profile - <a href="javascript:void(0);"
                                            class="text-primary fs-12">Finish now</a></p>
                                    <div class="progress progress-xs progress-animate">
                                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active p-0 border-0" id="activity-tab-pane" role="tabpanel"
                                        aria-labelledby="activity-tab" tabindex="0">
                                        aqui van los roles
                                    </div>
                                    <div class="tab-pane fade p-0 border-0" id="posts-tab-pane" role="tabpanel"
                                        aria-labelledby="posts-tab" tabindex="0">
                                        aqui van gráficas de ventas y resumenes
                                    </div>
                                    <div class="tab-pane fade p-0 border-0" id="followers-tab-pane"
                                        role="tabpanel" aria-labelledby="followers-tab" tabindex="0">
                                        Aquí va la experiencia que tiene, cursos y habilidades
                                    </div>
                                    <div class="tab-pane fade p-0 border-0" id="gallery-tab-pane" role="tabpanel"
                                        aria-labelledby="gallery-tab" tabindex="0">
                                        Resumen del empledo en gráficas.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



@endsection

@section('js')


@endsection
