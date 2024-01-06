<!DOCTYPE html>
<html lang="es" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light"
    data-header-styles="light" data-menu-styles="light" data-toggled="close">

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
    <link rel="icon" href="{{ Vite::asset('resources\assets\images\brand-logos\toggle-logo.png') }}"
        type="image/x-icon">

    @yield('vite-js')
    


</head>

<body @yield('body-class')>

    {{-- Content - Start --}}
    @yield('content')
    {{-- Content - End --}}




    <!-- Internal Coming Soon JS -->
    @yield('js','')    
    


</body>

</html>
