<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="dark" data-header-styles="dark"
    data-menu-styles="dark" data-toggled="close" data-loader="true">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>
        @yield('title', config('app.name'))
    </title>
    <meta name="Description" content="Telcel Gestor Comisiones">
    <meta name="Author" content="Hermilo A. Sánchez de Córdova">
    <meta name="keywords" content="Telcel,Gestor,Comisiones,Información,Intranet">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Favicon -->
    <link rel="icon" href="{{ asset('../images/toggle-logo.png') }}"type="image/x-icon">


    {{-- @Vite - Start::Css --}}
    @vite(['resources/css/auth.css'])
    {{-- @Vite End::css --}}

    {{-- @Vite - Start::CssOtros --}}
    @yield('vite-js')
    {{-- @Vite End::CssOtros --}}
    
    {{-- <script src="{{ Vite::asset('resources/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/assets/js/main.js') }}"></script> --}}



</head>

<body>
    {{-- @inertia --}}
    <!-- Loader -->
    <div id="loader" class="show">
        {{-- <img src="{{ url('resources/theme/images/media/loader.svg') }}" alt="loader" /> --}}
        <img src="{{ asset('/images/loader.svg') }}" alt="loader" />
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header">
            <!-- Start::main-header-container -->
            <div class="main-header-container container-fluid">
                <!-- Start::header-content-left -->
                <div class="header-content-left">
                    <!-- Start::header-element ::LOGOS -->
                    <div class="header-element">
                        @include('layouts.partials.logosbrand', ['class' => 'horizontal-logo'])
                    </div>
                    <!-- Start::header-element ::HAMBURGUER-->
                    <div class="header-element mx-lg-0 mx-2">
                        <a aria-label="Hide Sidebar"
                            class="sidemenu-toggle header-link animated-arrow hor-toggle horizontal-navtoggle"
                            data-bs-toggle="sidebar" href="javascript:void(0);"><span></span></a>
                    </div>
                    <!-- Start::header-element ::MODAL BUTTONS -->
                    <div class="header-element ms-2 my-auto">
                        <!-- Start::header-link -->
                        <a href="#" class="btn btn-icon btn-primary-light rounded-pill btn-wave"
                            data-bs-toggle="tooltip" title="Prepago" data-bs-custom-class="tooltip-primary"
                            data-bs-placement="left">
                            {{-- <i class="ri-home-smile-line"></i> --}}
                            <i class="lab la-centercode fs-4"></i>
                        </a>

                        <!-- End::header-link -->
                    </div>
                </div>
                <!-- Start::header-content-right -->
                <ul class="header-content-right">
                    <!-- Start::header-element ::SWITCH THEME -->
                    <li class="header-element header-theme-mode d-lg-flex d-none">
                        <!-- Start::header-link|layout-setting -->
                        <a href="javascript:void(0);" class="header-link layout-setting">
                            <span class="light-layout">
                                <!-- Start::header-link-icon -->
                                <i class="bi bi-moon header-link-icon"></i>
                                <!-- End::header-link-icon -->
                            </span>
                            <span class="dark-layout">
                                <!-- Start::header-link-icon -->
                                <i class="bi bi-brightness-high header-link-icon"></i>
                                <!-- End::header-link-icon -->
                            </span>
                        </a>
                        <!-- End::header-link|layout-setting -->
                    </li>
                    <!-- Start::header-element ::FULL SCREEN -->
                    <li class="header-element header-fullscreen d-lg-block d-none ">
                        <!-- Start::header-link -->
                        <a onclick="openFullscreen();" href="javascript:void(0);" class="header-link">
                            <i class="bi bi-fullscreen full-screen-open header-link-icon"></i>
                            <i class="bi bi-fullscreen-exit full-screen-close header-link-icon d-none"></i>

                        </a>
                        <!-- End::header-link -->
                    </li>
                    <!-- Start::header-element ::USUARIO-->
                    {{-- TODO: Ver perfil --}}
                    <li class="header-element">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="me-sm-2 me-0">
                                    <img src="{{ url('resources/assets/images/faces/8.jpg') }}" alt="img"
                                        class="avatar avatar-sm avatar-rounded" />
                                </div>
                                <div class="d-lg-block d-none lh-1">
                                    <span class="fw-medium lh-1">{{ auth()->user()->name }}</span>
                                </div>
                            </div>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <ul class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                            aria-labelledby="mainHeaderProfile">

                            <li>
                                {{-- !!TODO: HACER LA PÁGINA DEL PERFIL --}}
                                {{-- Cambiar contraseña --}}
                                {{-- <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.edit') }}"> --}}
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('empleado.change-passwd') }}">
                                    <i class="bi bi-unlock fs-18 me-2 op-7"></i>
                                    {{ __('Change Password') }}</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right fs-18 me-2 op-7"></i>
                                        {{ __('Logout') }}
                                    </button>
                                </form>

                            </li>
                        </ul>
                    </li>
                    <!-- Start::header-element ::SWITCHER CANVAS-->
                    <li class="header-element">
                        <!-- Start::header-link|switcher-icon -->
                        <a href="javascript:void(0);" class="header-link switcher-icon" data-bs-toggle="offcanvas"
                            data-bs-target="#switcher-canvas">
                            <i class="bi bi-gear header-link-icon border-0"></i>
                        </a>
                        <!-- End::header-link|switcher-icon -->
                    </li>
                </ul>
            </div>
        </header>
        <!-- /app-header -->

        {{-- STYCKY MENU --}}
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">
            <!-- Start::main-sidebar-header -->
            @include('layouts.partials.logosbrand', ['class' => 'main-sidebar-header'])
            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">
                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                        </svg>
                    </div>
                    {{-- Start:: Menu --}}

                    <ul class="main-menu">
                        {{--  //* SECCIÓN DEL MENÚ. */ --}}
                        @include('layouts.partials.dash-menus')
                        {{--  //* TERMINA SECCIÓN DEL MENU */ --}}
                    </ul>
                    <div class="slide-right" id="slide-right">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                        </svg>
                    </div>
                </nav>
                <!-- End::nav -->
            </div>
            <!-- End::main-sidebar -->
        </aside>
        <!-- End::app-sidebar -->

        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <div
                    class="my-3 page-header-breadcrumb d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <h1 class="page-title fw-medium fs-18 mb-2">
                        @yield('title-view')
                    </h1>
                    <div class="">
                        <nav>
                            {{-- yield: Breadcums --}}
                            @include('layouts.partials.breadcrumbs')
                        </nav>
                    </div>
                </div>

                @if (session('success'))
                    <x-alert-top tipo="success">
                        {{ session('success') }}
                    </x-alert-top>
                @endif

                {{-- yield: Concent --}}
                @yield('content')

            </div>
        </div>
        <!-- End::app-content -->
        {{-- ===========================TERMINADO PARA ABAJO ============================================ --}}
        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 bg-white text-center">
            <div class="container">
                <span class="text-muted">
                    Copyright ©
                    <span id="year">2024</span>
                    <span class=" fw-bold text-dart">SADECO</span>
                    Todos los derechos reservados.
                </span>
            </div>
        </footer>
        <!-- Footer End -->
        <div class="modal fade" id="header-responsive-search" tabindex="-1"
            aria-labelledby="header-responsive-search" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                                aria-label="Search Anything ..." aria-describedby="button-addon2" />
                            <button class="btn btn-primary" type="button" id="button-addon2">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Switcher -->
    @include('layouts.partials.switcher')
    <!-- End Switcher -->


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->



    {{-- @Vite - Start::Js --}}
    @vite(['resources/js/auth.js'])
    {{-- @Vite End::Js --}}
dd

    {{-- Scripts iniciales --}}
    {{-- <script src='{{ Vite::asset('resources/assets/libs/@popperjs/core/umd/popper.min.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/js/defaultmenu.min.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/libs/node-waves/waves.min.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/js/sticky.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/libs/simplebar/simplebar.min.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/js/simplebar.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/libs/@simonwep/pickr/pickr.es5.min.js') }}'></script>
    <script src='{{ Vite::asset('resources/assets/js/custom-switcher.min.js') }}'></script> 
    --}}

    @yield('js')

    {{-- Se pone hasta el final, despues de usar los js que necesitemos en cada página. --}}
    {{-- <script src='{{ Vite::asset('resources/assets/js/custom.js') }}'></script> --}}

    @yield('script')



</body>
{{-- <script type="text/javascript">
    jQuery(function($) { --}}


{{-- })
</script> --}}

</html>
