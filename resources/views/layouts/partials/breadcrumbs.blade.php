@php
    $breadcrumbs = Breadcrumbs::generate();
    // @dump($breadcrumbs);
@endphp


@if (sizeof($breadcrumbs) > 1)
    <ol class="breadcrumb d-none d-md-flex">

        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item">

                    <a href="{{ $breadcrumb->url }}">
                        @if ( isset($breadcrumb->icon))
                            <i class="me-1 {{ $breadcrumb->icon }}"></i>
                        @endif
                        {{ $breadcrumb->title }}
                    </a>
                </li>
            @else
                <li class="breadcrumb-item active">
                    @if ( isset($breadcrumb->icon))
                        <i class="me-2 {{ $breadcrumb->icon }}"></i>
                    @endif
                    {{ $breadcrumb->title }}
                </li>
            @endif
        @endforeach
    </ol>
@endif
{{-- @endunless --}}
