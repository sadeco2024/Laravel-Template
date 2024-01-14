@props([
    'tipo'=>'success', 
    ])


<div class="alert alert-{{ $tipo }}  alert-dismissible fade show">
    <i class="bi bi-check-circle me-2"></i>
    {{ $slot }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <i class="bi bi-x"></i>
    </button>
</div>