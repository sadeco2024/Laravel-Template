@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-danger unstyled']) }}>
        @foreach ((array) $messages as $message)
            <li class="list-item">{{ $message }}</li>
        @endforeach
    </ul>
@endif
