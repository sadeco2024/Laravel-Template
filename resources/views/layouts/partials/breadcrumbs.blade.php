
@php
    $breadcrumbs = Breadcrumbs::generate();
    
@endphp
{{-- @unless (Breadcrumbs::generate()->isEmpty()) --}}
@if ( sizeof($breadcrumbs) > 1)
    <ol class="breadcrumb">
        
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif

        @endforeach
    </ol>
@endif
{{-- @endunless --}}