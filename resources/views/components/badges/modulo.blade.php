
@props(['icon'=>'bi bi-collection-fill'])
<span {{ $attributes->merge(['class' => 'badge border fs-12 bg-light text-default custom-badge']) }}>
    <i class="{{$icon}} me-1"></i>
    {{ $slot}}
</span>
