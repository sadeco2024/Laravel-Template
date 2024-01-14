@props(['text'])
<div class="col-12">
<label {{ $attributes->merge(['class' => 'bg-light opacity-25']) }} class="bg-light opacity-25">
    {{ $text }}
</label>
<hr class="col-xxl-12 mt-0 border border-dashed" />
</div>
