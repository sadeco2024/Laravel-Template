@props(['ruta','concepto','icon'=>''])
{{-- @dump($ruta,request()) --}}

@if ($concepto == 'dash')
<li class="slide  {{ request()->is("$ruta*") ? 'active' : '' }} ">
    <a href="{{route($ruta)}}" class="side-menu__item  {{ request()->is("$ruta*") ? 'active' : '' }}">
        <i class="side-menu__icon {{$icon}}"></i>
        <span class="side-menu__label">
            {{ $slot }}
        </span>
        {{-- <i class="fe fe-chevron-right side-menu__angle"></i> --}}
    </a>
</li>
@endif

@if ($concepto == 'menu')
<li class="slide  {{ request()->is("$ruta*") ? 'active' : '' }} has-sub ">
    <a  class="side-menu__item  {{ request()->is("$ruta*") ? 'active' : '' }}">
        <i class="side-menu__icon {{$icon}}"></i>
        <span class="side-menu__label">
            {{ $slot }}
        </span>
        <i class="fe fe-chevron-right side-menu__angle"></i>
    </a>
    <ul class="slide-menu child1">


        <li class="slide side-menu__label1">
            <a href="javascript:void(0)">Tables</a>
        </li>
        <li class="slide">
            <a href="tables.html" class="side-menu__item">Tables</a>
        </li>
        <li class="slide">
            <a href="grid-tables.html" class="side-menu__item">Grid JS Tables</a>
        </li>
        <li class="slide">
            <a href="data-tables.html" class="side-menu__item">Data Tables</a>
        </li>
    </ul>
</li>
@endif


