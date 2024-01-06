<footer
class="footer mt-auto py-3 ps-0 text-default text-center authentication-footer position-absolute bottom-0 w-100">
<div class="d-flex align-items-center justify-content-sm-between justify-content-center px-4 flex-wrap gap-3">
    <span class="text-muted">
        Copyright ©
        <span id="year">2024</span>
        <span class=" fw-bold text-dart">SADECO</span>
        Todos los derechos reservados.
    </span>
    @guest
        
    <a href="{{ Route('login') }}" class="btn btn-icon btn-outline-primary btn-sm rounded-pill btn-wave"
        data-bs-tootle="tooltip" data-bs-class="tooltip-primary" data-bs-placement="top"
        title="{{ __('Login') }}">
        <i class='bx bx-log-in-circle bx-sm'></i>
    </a>
    @endguest
    

</div>
</footer>