{{-- <footer class="footer mt-auto py-3 text-default text-center authentication-footer position-absolute bottom-0 w-100">
    <div class="d-flex align-items-center justify-content-sm-between justify-content-center px-4 flex-wrap gap-3">
        <span class="text-muted text-dark">
            Copyright ©
            <span id="year">2024</span>
            <span class=" fw-bold text-dark">SADECO</span>
            Todos los derechos reservados.
        </span>

        @if (!Route::has('login'))
        <a href="{{ Route('login') }}" class="btn btn-icon btn-outline-primary btn-sm rounded-pill btn-wave"
            data-bs-tootle="tooltip" data-bs-class="tooltip-primary" data-bs-placement="top" title="{{ __('Login') }}">
            <i class='bi bi-door-open'></i>
        </a>
        @endif
    </div>
</footer> --}}

<footer  class="d-flex flex-fill mt-auto py-3 justify-content-center align-baseline text-default text-center authentication-footer position-absolute bottom-0 w-100">
    {{-- <div class="d-flex flex-fill mx-4 flex-nowrap align-items-center justify-content-sm-between justify-content-center"> --}}
    <span class="text-muted text-dark">
        Copyright ©
        <span id="year">2024</span>
        <span class=" fw-bold text-dark">SADECO</span>
        Todos los derechos reservados.
    </span>
    
    @if (!Str::contains(Route::currentRouteName(), 'login'))
    <a href="{{ Route('login') }}" class="btn btn-icon btn-outline-primary btn-sm rounded-pill btn-wave ms-5"
    data-bs-tootle="tooltip" data-bs-class="tooltip-primary" data-bs-placement="top" title="{{ __('Login') }}">
    <i class='bi bi-door-open'></i>
</a>
    @endif
</div> 
</footer>
{{-- <footer class="d-flex footer mt-auto py-3 justify-content-sm-between justify-content-center text-default text-center authentication-footer position-absolute bottom-0 w-100">
    <span class="text-muted text-dark">
        Copyright ©
        <span id="year">2024</span>
        <span class=" fw-bold text-dark">SADECO</span>
        Todos los derechos reservados.
    </span>

</footer> --}}
