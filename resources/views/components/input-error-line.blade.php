@props(['messages'])



@if ($messages)
<small {{ $attributes->merge(['class' => 'text-sm text-danger text-muted']) }}>
    @foreach ((array) $messages as $message)
    {{ $message }}
    @endforeach
</small>
@endif
