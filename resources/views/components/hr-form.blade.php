@props(['text'])
<div class="col-12">
<label {{ $attributes->merge(['class' => 'text-dark opacity-50']) }} >
    {{ $text }}
</label>
<hr class="col-xxl-12 mt-0 border border-dashed" />
</div>
