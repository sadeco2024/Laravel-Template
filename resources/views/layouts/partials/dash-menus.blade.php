@php
    // Se obtiene el rol del usuario autenticado
    $roles = auth()
        ->user()
        ->roles->pluck('name')
        ->toArray();

@endphp

@foreach ($menus as $menu)
    @if ($menu->concepto->concepto == 'dash')
    
        <li class="slide  
            {{ request()->is("$menu[slug]*") ? 'active' : '' }} 
        ">
            <a href="{{ route($menu->slug) }}"
                class="side-menu__item  {{ request()->is("$menu->slug*") ? 'active' : '' }}">
                <i class="side-menu__icon {{ $menu['icono'] }}"></i>
                <span class="side-menu__label">
                    {{ $menu['nombre'] }}
                </span>
            </a>
        </li>
    @endif


    @if ($menu->concepto->concepto == 'menu')
    
        <li class="slide  {{ request()->is("$menu->slug*") ? 'active' : '' }} has-sub ">
            <a class="side-menu__item  {{ request()->is("$menu[slug]*") ? 'active' : '' }}">
                <i class="side-menu__icon {{ $menu['icono'] }}"></i>
                <span class="side-menu__label">
                    {{ $menu['nombre'] }}
                </span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>

            <ul class="slide-menu child1 {{ request()->is("$menu[slug]*") ? 'active' : '' }}">
                <li class="slide side-menu__label1">
                    <a href="javascript:void(0);"> {{ $menu['nombre'] }}</a>
                </li>

                @foreach ($menu->submenus as $submenu)
                
                    @php
                        $arrayAuth = $submenu['auth_roles'] ? explode('|', $submenu['auth_roles']) : [];
                        $intersect = array_intersect($arrayAuth, $roles);
                    @endphp


                    <!-- El usuario tiene el rol de admin -->

                    @if (!is_null($submenu['auth_roles']))
                        @role($submenu['auth_roles'])
                            <li class="slide {{ request()->is("$submenu[slug]*") ? 'active' : '' }}">
                                @if ($submenu['concepto'] != 'interno')
                                    <a href="{{ route($menu['slug'] . '.' . $submenu['slug'] . ($submenu->concepto->concepto == 'crud' ? '.index' : '')) }}"
                                        class="side-menu__item {{ request()->is("$menu[slug]/$submenu[slug]*") ? 'active' : '' }}">
                                        <i class="side-menu__icon {{ $submenu['icono'] }}"></i>
                                        {{ $submenu['nombre'] }}
                                    </a>
                                @endif
                            </li>
                        @endrole
                    @elseif(!is_null($submenu['auth_permisos']))
                        @can($submenu['auth_permisos'])
                            <li class="slide {{ request()->is("$submenu[slug]*") ? 'active' : '' }}">
                                @if ($submenu['concepto'] != 'interno')
                                    <a href="{{ route($menu['slug'] . '.' . $submenu['slug'] . ($submenu->concepto->concepto == 'crud' ? '.index' : '')) }}"
                                        class="side-menu__item {{ request()->is("$menu[slug]/$submenu[slug]*") ? 'active' : '' }}">
                                        <i class="side-menu__icon {{ $submenu['icono'] }}"></i>
                                        {{ $submenu['nombre'] }}
                                    </a>
                                @endif
                            </li>
                        @endcan
                    @elseif($submenu->concepto->concepto !== 'interno')
                        <li class="slide {{ request()->is("$submenu[slug]*") ? 'active' : '' }}">
                            @if ($submenu['concepto'] != 'interno')
                                <a href="{{ route($menu['slug'] . '.' . $submenu['slug'] . ($submenu->concepto->concepto == 'crud' ? '.index' : '')) }}"
                                    class="side-menu__item {{ request()->is("$menu[slug]/$submenu[slug]*") ? 'active' : '' }}">
                                    <i class="side-menu__icon {{ $submenu['icono'] }}"></i>
                                    {{ $submenu['nombre'] }}
                                </a>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endif
@endforeach
