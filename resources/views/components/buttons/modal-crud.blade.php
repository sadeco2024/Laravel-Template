@props([
    'url',
    'title',
    'param' => null,
])

<a {{ $attributes->merge(['class' => 'modal-effect']) }}
    data-bs-effect="effect-slide-in-right" 
    data-bs-toggle="modal" 
    href="#" 
    data-url="{{ $url }}"
    data-title="{{ $title }}"
    data-param="{{ $param }}"
>
    {{ $slot }}
</a>