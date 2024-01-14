
{{--  class=" text-default " --}}
<span {{ $attributes->merge(['class' => 'badge border fs-12 bg-light text-default custom-badge']) }}>
    <i class="bi bi-collection-fill me-2"></i>
    {{ $slot}}
</span>
