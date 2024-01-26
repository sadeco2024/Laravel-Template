<!-- Inicio del switcher -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
    <!-- Cabecera del switcher -->
    <div class="offcanvas-header border-bottom d-flex">
        <h5 class="offcanvas-title text-default" id="offcanvasRightLabel">{{ __('Configs') }}</h5>
        <!-- Botón para cerrar el switcher -->
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Cuerpo del switcher -->
    <div class="offcanvas-body">
        <!-- Navegación del switcher -->
        <nav class="border-bottom border-block-end-dashed">
            <div class="nav nav-tabs nav-justified" id="switcher-main-tab" role="tablist">
                <!-- Botón para cambiar a la pestaña de estilos de tema -->
                <button class="nav-link active" id="switcher-home-tab" data-bs-toggle="tab"
                    data-bs-target="#switcher-home" type="button" role="tab" aria-controls="switcher-home"
                    aria-selected="true"> {{ __('Theme Styles') }}</button>
                <!-- Botón para cambiar a la pestaña de colores de tema -->
                <button class="nav-link" id="switcher-profile-tab" data-bs-toggle="tab"
                    data-bs-target="#switcher-profile" type="button" role="tab" aria-controls="switcher-profile"
                    aria-selected="false"> {{ __('Theme Color') }}</button>
            </div>
        </nav>
        <!-- Contenido de las pestañas -->
        <div class="tab-content" id="nav-tabContent">
            <!-- Pestaña de estilos de tema -->
            <div class="tab-pane fade show active border-0" id="switcher-home" role="tabpanel"
                aria-labelledby="switcher-home-tab" tabindex="0">
                <div class="">
                    <!-- Encabezado de la sección de modos de color de tema -->
                    <p class="switcher-style-head"> {{ __('Theme Color Mode') }}:</p>
                    <!-- Opciones de modos de color de tema -->
                    <div class="row switcher-style">
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-light-theme">
                                    Light
                                </label>
                                <input class="form-check-input" type="radio" name="theme-style"
                                    id="switcher-light-theme" checked>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-dark-theme">
                                    Dark
                                </label>
                                <input class="form-check-input" type="radio" name="theme-style"
                                    id="switcher-dark-theme">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sección oculta -->
                <div class="" hidden>
                    <p class="switcher-style-head">{{ __('Directions') }}:</p>
                    <div class="row switcher-style">
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-ltr">
                                    LTR
                                </label>
                                <input class="form-check-input" type="radio" name="direction" id="switcher-ltr"
                                    checked>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-rtl">
                                    RTL
                                </label>
                                <input class="form-check-input" type="radio" name="direction" id="switcher-rtl">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <!-- Contenedor principal de la sección de estilos de navegación -->
                    <p class="switcher-style-head">{{ __('Navigation Styles') }}:</p>
                    <div class="row switcher-style">
                        <!-- Opción de estilo de navegación vertical -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-vertical">
                                    Vertical
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-style"
                                    id="switcher-vertical" checked>
                            </div>
                        </div>
                        <!-- Opción de estilo de navegación horizontal -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-horizontal">
                                    Horizontal
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-style"
                                    id="switcher-horizontal">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="navigation-menu-styles">
                    <!-- Título de la sección de estilos de menú de navegación -->
                    <p class="switcher-style-head">{{ __('Navigation Menu Styles') }}:</p>
                    <!-- Contenedor de las opciones de estilos de menú de navegación -->
                    <div class="row switcher-style pb-2">
                        <!-- Opción de interacción al hacer clic en el menú -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-click">
                                    {{ __('Menu Click') }}
                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                    id="switcher-menu-click">
                            </div>
                        </div>
                        <!-- Opción de interacción al pasar el cursor sobre el menú -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-menu-hover">
                                    {{ __('Menu Hover') }}

                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                    id="switcher-menu-hover">
                            </div>
                        </div>
                        <!-- Opción de interacción al hacer clic en el ícono -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-click">
                                    {{ __('Icon Click') }}

                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                    id="switcher-icon-click">
                            </div>
                        </div>
                        <!-- Opción de interacción al pasar el cursor sobre el ícono -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-icon-hover">
                                    {{ __('Icon Hover') }}

                                </label>
                                <input class="form-check-input" type="radio" name="navigation-menu-styles"
                                    id="switcher-icon-hover">
                            </div>
                        </div>
                    </div>
                    <!-- Nota sobre la funcionalidad de las opciones -->
                    <div class="px-4 pb-3 text-secondary fs-11">
                        <span class="fw-medium fs-12 text-dark me-2 d-inline-block">
                            {{ __('Note') }}:

                        </span>
                        {{ __('Works same for both Vertical and Horizontal') }}

                    </div>
                </div>
                <!-- Contenedor principal de la sección de estilos de página -->
                <div class="">
                    <!-- Título de la sección de estilos de página -->
                    <p class="switcher-style-head">
                        {{ __('Page Styles') }}:
                    </p>
                    <!-- Contenedor de las opciones de estilos de página -->
                    <div class="row switcher-style">
                        <!-- Opción de estilo de página Regular -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de estilo Regular -->
                                <label class="form-check-label" for="switcher-regular">
                                    Regular
                                </label>
                                <!-- Input de la opción de estilo Regular -->
                                <input class="form-check-input" type="radio" name="page-styles"
                                    id="switcher-regular" checked>
                            </div>
                        </div>
                        <!-- Opción de estilo de página Classic -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de estilo Classic -->
                                <label class="form-check-label" for="switcher-classic">
                                    {{ __('Classic') }}
                                </label>
                                <!-- Input de la opción de estilo Classic -->
                                <input class="form-check-input" type="radio" name="page-styles"
                                    id="switcher-classic">
                            </div>
                        </div>
                        <!-- Opción de estilo de página Modern -->
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de estilo Modern -->
                                <label class="form-check-label" for="switcher-modern">
                                    {{ __('Modern') }}
                                </label>
                                <!-- Input de la opción de estilo Modern -->
                                <input class="form-check-input" type="radio" name="page-styles"
                                    id="switcher-modern">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contenedor principal de la sección de estilos de diseño del menú lateral -->
                <div class="sidemenu-layout-styles">
                    <!-- Título de la sección de estilos de diseño del menú lateral -->
                    <p class="switcher-style-head">
                        {{ __('Sidemenu Layout Syles') }}:
                    </p>
                    <!-- Contenedor de las opciones de estilos de diseño del menú lateral -->
                    <div class="row switcher-style pb-2">
                        <!-- Opción de estilo de menú por defecto -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de menú por defecto -->
                                <label class="form-check-label" for="switcher-default-menu">
                                    {{ __('Default Menu') }}
                                </label>
                                <!-- Input de la opción de menú por defecto -->
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                    id="switcher-default-menu" checked>
                            </div>
                        </div>
                        <!-- Opción de estilo de menú cerrado -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de menú cerrado -->
                                <label class="form-check-label" for="switcher-closed-menu">
                                    {{ __('Closed Menu') }}
                                </label>
                                <!-- Input de la opción de menú cerrado -->
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                    id="switcher-closed-menu">
                            </div>
                        </div>
                        <!-- Opción de estilo de menú con texto de icono -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de menú con texto de icono -->
                                <label class="form-check-label" for="switcher-icontext-menu">
                                    {{ __('Icon Text') }}
                                </label>
                                <!-- Input de la opción de menú con texto de icono -->
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                    id="switcher-icontext-menu">
                            </div>
                        </div>
                        <!-- Opción de estilo de menú con superposición de icono -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de menú con superposición de icono -->
                                <label class="form-check-label" for="switcher-icon-overlay">
                                    {{ __('Icon Overlay') }}
                                </label>
                                <!-- Input de la opción de menú con superposición de icono -->
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                    id="switcher-icon-overlay">
                            </div>
                        </div>
                        <!-- Opción de estilo de menú desacoplado -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de menú desacoplado -->
                                <label class="form-check-label" for="switcher-detached">
                                    {{ __('Detached') }}
                                </label>
                                <!-- Input de la opción de menú desacoplado -->
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                    id="switcher-detached">
                            </div>
                        </div>
                        <!-- Opción de estilo de menú doble -->
                        <div class="col-sm-6">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de menú doble -->
                                <label class="form-check-label" for="switcher-double-menu">
                                    {{ __('Double Menu') }}
                                </label>
                                <!-- Input de la opción de menú doble -->
                                <input class="form-check-input" type="radio" name="sidemenu-layout-styles"
                                    id="switcher-double-menu">
                            </div>
                        </div>
                    </div>
                    <!-- Nota sobre la funcionalidad de los estilos de diseño del menú lateral -->
                    <div class="px-4 pb-3 text-secondary fs-11">
                        <span class="fw-medium fs-12 text-dark me-2 d-inline-block">
                            {{ __('Note') }}:
                        </span>
                        {{ __('Works same for both Vertical and Horizontal') }}
                    </div>
                </div>
                <!-- Contenedor principal de la sección de estilos de ancho de diseño -->
                <div class="">
                    <!-- Título de la sección de estilos de ancho de diseño -->
                    <p class="switcher-style-head">
                        {{ __('Layout Width Styles') }}:
                    </p>
                    <!-- Contenedor de las opciones de estilos de ancho de diseño -->
                    <div class="row switcher-style">
                        <!-- Opción de estilo de ancho completo -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de ancho completo -->
                                <label class="form-check-label" for="switcher-full-width">
                                    {{ __('Full Width') }}
                                </label>
                                <!-- Input de la opción de ancho completo -->
                                <input class="form-check-input" type="radio" name="layout-width"
                                    id="switcher-full-width" checked>
                            </div>
                        </div>
                        <!-- Opción de estilo de ancho en caja -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de ancho en caja -->
                                <label class="form-check-label" for="switcher-boxed">
                                    {{ __('Boxed') }}
                                </label>
                                <!-- Input de la opción de ancho en caja -->
                                <input class="form-check-input" type="radio" name="layout-width"
                                    id="switcher-boxed">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenedor principal de la sección de posiciones de menú -->
                <div class="">
                    <!-- Título de la sección de posiciones de menú -->
                    <p class="switcher-style-head">
                        {{ __('Menu Positions') }}:
                    </p>
                    <!-- Contenedor de las opciones de posiciones de menú -->
                    <div class="row switcher-style">
                        <!-- Opción de posición de menú fija -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de posición de menú fija -->
                                <label class="form-check-label" for="switcher-menu-fixed">
                                    {{ __('Fixed') }}
                                </label>
                                <!-- Input de la opción de posición de menú fija -->
                                <input class="form-check-input" type="radio" name="menu-positions"
                                    id="switcher-menu-fixed" checked>
                            </div>
                        </div>
                        <!-- Opción de posición de menú desplazable -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de posición de menú desplazable -->
                                <label class="form-check-label" for="switcher-menu-scroll">
                                    {{ __('Scrollable') }}
                                </label>
                                <!-- Input de la opción de posición de menú desplazable -->
                                <input class="form-check-input" type="radio" name="menu-positions"
                                    id="switcher-menu-scroll">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenedor principal de la sección de posiciones de encabezado -->
                <div class="">
                    <!-- Título de la sección de posiciones de encabezado -->
                    <p class="switcher-style-head">
                        {{ __('Header Positions') }}:
                    </p>
                    <!-- Contenedor de las opciones de posiciones de encabezado -->
                    <div class="row switcher-style">
                        <!-- Opción de posición de encabezado fija -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de posición de encabezado fija -->
                                <label class="form-check-label" for="switcher-header-fixed">
                                    {{ __('Fixed') }}
                                </label>
                                <!-- Input de la opción de posición de encabezado fija -->
                                <input class="form-check-input" type="radio" name="header-positions"
                                    id="switcher-header-fixed" checked>
                            </div>
                        </div>
                        <!-- Opción de posición de encabezado desplazable -->
                        <div class="col-sm-4">
                            <div class="form-check switch-select">
                                <!-- Etiqueta de la opción de posición de encabezado desplazable -->
                                <label class="form-check-label" for="switcher-header-scroll">
                                    {{ __('Scrollable') }}
                                </label>
                                <!-- Input de la opción de posición de encabezado desplazable -->
                                <input class="form-check-input" type="radio" name="header-positions"
                                    id="switcher-header-scroll">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <p class="switcher-style-head">{{ __('Loader') }}:</p>
                    <div class="row switcher-style gx-0">
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-loader-enable">
                                    {{ __('Enable') }}
                                </label>
                                <input class="form-check-input" type="radio" name="page-loader"
                                    id="switcher-loader-enable">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-check switch-select">
                                <label class="form-check-label" for="switcher-loader-disable">
                                    {{ __('Disable') }}
                                </label>
                                <input class="form-check-input" type="radio" name="page-loader"
                                    id="switcher-loader-disable" checked>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            {{-- Colores del tema --}}
            <div class="tab-pane fade border-0" id="switcher-profile" role="tabpanel"
                aria-labelledby="switcher-profile-tab" tabindex="0">
                <div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">{{ __('Menu Colors') }}:</p>
                        <div class="d-flex switcher-style pb-2">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Light Menu" type="radio" name="menu-colors"
                                    id="switcher-menu-light" checked>
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Dark Menu" type="radio" name="menu-colors"
                                    id="switcher-menu-dark">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Color Menu" type="radio" name="menu-colors"
                                    id="switcher-menu-primary">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Gradient Menu" type="radio" name="menu-colors"
                                    id="switcher-menu-gradient">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-transparent" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Transparent Menu" type="radio"
                                    name="menu-colors" id="switcher-menu-transparent">
                            </div>
                        </div>
                        <div class="px-4 pb-3 text-muted fs-11">{{ __('Note') }}:
                            {{ __('If you want to change color Menu dynamically change from below Theme Primary color picker') }}
                        </div>
                    </div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">{{ __('Header Colors') }}:</p>
                        <div class="d-flex switcher-style pb-2">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-white" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Light Header" type="radio" name="header-colors"
                                    id="switcher-header-light" checked>
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-dark" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Dark Header" type="radio" name="header-colors"
                                    id="switcher-header-dark">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Color Header" type="radio" name="header-colors"
                                    id="switcher-header-primary">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-gradient" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Gradient Header" type="radio"
                                    name="header-colors" id="switcher-header-gradient">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-transparent" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Transparent Header" type="radio"
                                    name="header-colors" id="switcher-header-transparent">
                            </div>
                        </div>
                        <div class="px-4 pb-3 text-muted fs-11">{{ __('Note') }}:
                            {{ __('If you want to change color Header dynamically change from below Theme Primary color picker') }}
                        </div>
                    </div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">{{ __('Theme Primary') }}:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-1" type="radio"
                                    name="theme-primary" id="switcher-primary">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-2" type="radio"
                                    name="theme-primary" id="switcher-primary1">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-3" type="radio"
                                    name="theme-primary" id="switcher-primary2">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-4" type="radio"
                                    name="theme-primary" id="switcher-primary3">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-primary-5" type="radio"
                                    name="theme-primary" id="switcher-primary4">
                            </div>
                            <div class="form-check switch-select ps-0 mt-1 color-primary-light">
                                <div class="theme-container-primary"></div>
                                <div class="pickr-container-primary"></div>
                            </div>
                        </div>
                    </div>
                    <div class="theme-colors">
                        <p class="switcher-style-head">{{ __('Theme Background') }}:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-1" type="radio"
                                    name="theme-background" id="switcher-background" checked>
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-2" type="radio"
                                    name="theme-background" id="switcher-background1">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-3" type="radio"
                                    name="theme-background" id="switcher-background2">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-4" type="radio"
                                    name="theme-background" id="switcher-background3">
                            </div>
                            <div class="form-check switch-select me-3">
                                <input class="form-check-input color-input color-bg-5" type="radio"
                                    name="theme-background" id="switcher-background4">
                            </div>
                            <div class="form-check switch-select ps-0 mt-1 tooltip-static-demo color-bg-transparent">
                                <div class="theme-container-background"></div>
                                <div class="pickr-container-background"></div>
                            </div>
                        </div>
                    </div>
                    <div class="menu-image mb-3" hidden>
                        <p class="switcher-style-head">{{ __('Menu With Background Image') }}:</p>
                        <div class="d-flex flex-wrap align-items-center switcher-style">
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img1" type="radio"
                                    name="theme-background" id="switcher-bg-img" checked>
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img2" type="radio"
                                    name="theme-background" id="switcher-bg-img1">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img3" type="radio"
                                    name="theme-background" id="switcher-bg-img2">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img4" type="radio"
                                    name="theme-background" id="switcher-bg-img3">
                            </div>
                            <div class="form-check switch-select m-2">
                                <input class="form-check-input bgimage-input bg-img5" type="radio"
                                    name="theme-background" id="switcher-bg-img4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center canvas-footer flex-wrap">
                <a href="javascript:void(0);" id="reset-all"
                    class="btn btn-danger m-1 w-100">{{ __('Reset') }}</a>
            </div>
        </div>
    </div>
</div>
<!-- End Switcher -->
