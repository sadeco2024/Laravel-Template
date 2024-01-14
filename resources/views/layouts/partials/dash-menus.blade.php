{{-- @dd($menus) --}}
@foreach ($menus as $menu)
    {{-- @dd('item',request()) --}}
    @if ($menu['concepto'] == 'dash')
        <li class="slide  
            {{ request()->is("$menu[slug]*") ? 'active' : '' }} 
        ">
            <a href="{{ route($menu['slug']) }}"
                class="side-menu__item  {{ request()->is("$menu[slug]*") ? 'active' : '' }}">
                <i class="side-menu__icon {{ $menu['icono'] }}"></i>
                <span class="side-menu__label">
                    {{ $menu['nombre'] }}
                </span>
                {{-- <i class="fe fe-chevron-right side-menu__angle"></i> --}}
            </a>
        </li>
    @endif
        
    @if ($menu['concepto'] == 'menu')
        <li class="slide  {{ request()->is("$menu[slug]*") ? 'active' : '' }} has-sub ">
            <a class="side-menu__item  {{ request()->is("$menu[slug]*") ? 'active' : '' }}">
                <i class="side-menu__icon {{ $menu['icono'] }}"></i>
                <span class="side-menu__label">
                    {{ $menu['nombre'] }}
                </span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1 {{ request()->is("$menu[slug]*") ? 'active' : '' }}">
                <li class="slide side-menu__label1">
                    <a href="javascript:void(0);" > {{ $menu['nombre'] }}</a>
                </li>                
                @foreach ($menu["submenu"] as $submenu)
                
                
                    <li class="slide {{ request()->is("$submenu[slug]*") ? 'active' : '' }}">
                        {{-- @php $ruta = $menu['slug'].'.'.$submenu['slug'].($submenu["concepto"]=="crud" ? '.index' : ''); @endphp --}}
                        @if ($submenu["concepto"]!="interno")
                            <a href="{{ route($menu['slug'].'.'.$submenu['slug'].($submenu["concepto"]=="crud" ? '.index' : '')) }}"
                                class="side-menu__item {{ request()->is("$menu[slug]/$submenu[slug]*") ? 'active' : '' }}">
                                {{ $submenu['nombre'] }}
                            </a>
                        @endif
                        {{-- <a href="{{ route($menu['slug'].'.'.$submenu['slug'].($submenu["concepto"]=="crud" ? '.index' : '')) }}"
                        class="side-menu__item {{ request()->is("$menu[slug]/$submenu[slug]*") ? 'active' : '' }}">
                            {{ $submenu['nombre'] }}
                        </a> --}}
                    </li>
                @endforeach
                
                </li>
            </ul>
        </li>
    @endif
@endforeach
