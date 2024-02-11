<!DOCTYPE html>
    <html lang="es" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close" data-loader="true">    
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

    <script src="{{ asset('../assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('../assets/js/main.js') }}"></script>


    {{-- @Vite - Start::Css --}}
    @vite(['resources/css/auth.css'])
    {{-- @Vite End::css --}}

    {{-- @Vite - Start::CssOtros --}}
    @yield('vite-css')
    {{-- @Vite End::CssOtros --}}

</head>

<body>


    <!-- Start Switcher -->
    @include('layouts.partials.switcher')
    <!-- End Switcher -->

    <!-- Loader -->
    <div id="loader" class="show">
        <img src="{{ asset('../images/loader.svg') }}" alt="loader" />
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
                    <!-- Start::header-element -->
                    {{-- d-md-block --}}
                    <div class="header-element header-search d-none  ">
                        <!-- Start::header-link -->
                        <input type="text" class="header-search-bar form-control border-0 bg-body"
                            placeholder="Search for Results...">
                        <a href="javascript:void(0);" class="header-search-icon border-0">
                            <i class="bi bi-search"></i>
                        </a>
                        <!-- End::header-link -->
                    </div>
                    <!-- End::header-element -->
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
                    {{-- TODO: Ver perfil, Avatars, Editar --}}
                    <li class="header-element">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" id="mainHeaderProfile"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="me-sm-2 me-0">

                                    <img src="{{ asset('../images/1.jpg') }}" alt="img"
                                        class="avatar avatar-sm avatar-rounded" />
                                </div>
                                <div class="d-lg-block d-none lh-1 text-dark">
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

                    {{-- PROXIMAMENTE --}}
                    <!-- Start::header-element -->
                    <li class="header-element country-selector d-none">
                        <!-- Start::header-link|dropdown-toggle -->

                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    <li class="header-element cart-dropdown d-none">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle"
                            data-bs-auto-close="outside" data-bs-toggle="dropdown">
                            <i class="bi bi-cart2 header-link-icon"></i>
                            <span class="badge bg-primary rounded-pill header-icon-badge"
                                id="cart-icon-badge">5</span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                            data-popper-placement="none">
                            <div class="p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 fs-16">Cart Items<span
                                            class="badge bg-success-transparent ms-1 fs-12 rounded-circle"
                                            id="cart-data">5</span></p>
                                    <span><span class="text-muted me-1">Total:</span><span
                                            class="text-primary fw-medium">$14,289</span></span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-cart-items-scroll">

                            </ul>

                        </div>
                        <!-- End::main-header-dropdown -->
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    {{-- d-xl-block --}}
                    <li class="header-element notifications-dropdown d-none ">
                        <!-- Start::header-link|dropdown-toggle -->
                        <a href="javascript:void(0);" class="header-link dropdown-toggle" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" id="messageDropdown" aria-expanded="false">
                            <i class="bi bi-bell header-link-icon"></i>
                            <span class="header-icon-pulse bg-secondary rounded pulse pulse-secondary"></span>
                        </a>
                        <!-- End::header-link|dropdown-toggle -->
                        <!-- Start::main-header-dropdown -->
                        <div class="main-header-dropdown dropdown-menu dropdown-menu-end"
                            data-popper-placement="none">
                            <div class="p-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 fs-16">Notifications</p>
                                    <span class="badge bg-secondary-transparent" id="notifiation-data">5 Unread</span>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <ul class="list-unstyled mb-0" id="header-notification-scroll">

                            </ul>

                        </div>
                        <!-- End::main-header-dropdown -->
                    </li>
                    <!-- End::header-element -->

                    <!-- Start::header-element -->
                    {{-- d-lg-block --}}
                    <div class="header-element ms-3 d-none my-auto">
                        <!-- Start::dashboards list -->
                        <div class="dropdown my-auto">
                            <a href="javascript:void(0);"
                                class="btn bg-body header-dashboards-button text-start d-flex align-items-center justify-content-between"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            </a>
                            <ul class="dropdown-menu dashboard-dropdown" role="menu">
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index.html">Sales
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-1.html">Analytics
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-2.html">Ecommerce
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-3.html">CRM
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-4.html">HRM
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-5.html">NFT
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-6.html">Crypto
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-7.html">Jobs
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-8.html">Projects
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-9.html">Courses
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-10.html">Stocks
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-11.html">Personal
                                        Dashboard</a></li>
                                <li><a class="dropdown-item dashboards-dropdown-item" href="index-12.html">Customer
                                        Dashboard</a></li>
                            </ul>
                        </div>
                        <!-- End::dashboards list -->
                    </div>
                    <!-- End::header-element -->
                    {{-- TERMINA -PROXIMAMENTE --}}
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
                        <!-- Start::slide -->
                        <li class="slide has-sub d-none">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <i class="bi bi-house side-menu__icon"></i>
                                <span class="side-menu__label">Dashboards</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Dashboards</a>
                                </li>
                                <li class="slide">
                                    <a href="index.html" class="side-menu__item">Sales</a>
                                </li>
                                <li class="slide">
                                    <a href="index-1.html" class="side-menu__item">Analytics</a>
                                </li>
                                <li class="slide">
                                    <a href="index-2.html" class="side-menu__item">Ecommerce</a>
                                </li>
                                <li class="slide">
                                    <a href="index-3.html" class="side-menu__item">Crm</a>
                                </li>
                                <li class="slide">
                                    <a href="index-4.html" class="side-menu__item">HRM</a>
                                </li>
                                <li class="slide">
                                    <a href="index-5.html" class="side-menu__item">NFT</a>
                                </li>
                                <li class="slide">
                                    <a href="index-6.html" class="side-menu__item">Crypto</a>
                                </li>
                                <li class="slide">
                                    <a href="index-7.html" class="side-menu__item">Jobs</a>
                                </li>
                                <li class="slide">
                                    <a href="index-8.html" class="side-menu__item">Projects</a>
                                </li>
                                <li class="slide">
                                    <a href="index-9.html" class="side-menu__item">Courses</a>
                                </li>
                                <li class="slide">
                                    <a href="index-10.html" class="side-menu__item">Stocks</a>
                                </li>
                                <li class="slide">
                                    <a href="index-11.html" class="side-menu__item">Personal</a>
                                </li>
                                <li class="slide">
                                    <a href="index-12.html" class="side-menu__item">Customer</a>
                                </li>
                            </ul>
                        </li>
                        <!-- End::slide -->
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
                <!-- Page Header -->
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
                <!-- Page Header Close -->
                <div class="row">
                    @if (session('success'))
                        <x-alert-top tipo="success">
                            {{ session('success') }}
                        </x-alert-top>
                    @endif

                    {{-- yield: Concent --}}
                    @yield('content')
                </div>
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

        {{-- Toast --}}
        <div id="toast-alerts" class="toast colored-toast bg-success" role="alert"
            aria-live="assertive" aria-atomic="true">
            {{--  bg-secondary text-fixed-white --}}
            <div class="toast-header">
                <img class="bd-placeholder-img rounded me-2" src="{{asset('assets/images/brand-logos/logo.png')}}" alt="...">
                <strong class="me-auto">Sadeco</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Registro actualizado
            </div>
        </div>

    </div>



    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->


    <!-- Popper JS -->
    <script src="{{ asset('/assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('/assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('/assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/assets/js/simplebar.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('/assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Custom-Switcher JS -->
    <script src="{{ asset('/assets/js/custom-switcher.min.js') }}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('/assets/js/custom.js') }}"></script>


    @yield('js')

    @yield('script')

    @vite(['resources/js/auth.js'])

</body>
{{-- <script type="text/javascript">
    jQuery(function($) { --}}


{{-- })
</script> --}}

</html>
