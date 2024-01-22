@props([
    'name' => 'genero',
    'text' => 'Género',
    'value'=>''
])
@php
    $generoInformacion = [
        [
            'nombre' => 'Femenino',
            'abreviatura' => 'F',
            'descripcion' => 'El género femenino se refiere a las características, roles y comportamientos asociados culturalmente con las mujeres.',
        ],
        [
            'nombre' => 'Masculino',
            'abreviatura' => 'M',
            'descripcion' => 'El género masculino se refiere a las características, roles y comportamientos asociados culturalmente con los hombres.',
        ],
        [
            'nombre' => 'No binario',
            'abreviatura' => 'NB',
            'descripcion' => 'El género no binario se refiere a las identidades de género que no se ajustan exclusivamente a las categorías de hombre o mujer.',
        ],
        [
            'nombre' => 'Género fluído',
            'abreviatura' => 'GF',
            'descripcion' => 'El género fluído se refiere a las identidades de género que pueden cambiar o fluctuar a lo largo del tiempo.',
        ],
        [
            'nombre' => 'Transgénero',
            'abreviatura' => 'T',
            'descripcion' => 'El género transgénero se refiere a las personas cuya identidad de género difiere de su sexo asignado al nacer.',
        ],
        [
            'nombre' => 'Queer',
            'abreviatura' => 'Q',
            'descripcion' => 'El término queer se utiliza para describir una amplia gama de identidades y expresiones de género que no se ajustan a las normas tradicionales.',
        ],
        [
            'nombre' => 'Intersexual',
            'abreviatura' => 'I',
            'descripcion' => 'El término intersexual se refiere a las personas que nacen con características sexuales que no se ajustan a las definiciones típicas de masculino o femenino.',
        ],
        [
            'nombre' => 'Otro',
            'abreviatura' => 'O',
            'descripcion' => 'El término otro se utiliza para describir identidades de género que no se ajustan a las categorías tradicionales de hombre o mujer.',
        ],
    ];

    $generoInformacion = array_values($generoInformacion);

@endphp


<div class="form-group mb-2">
    {{-- <span class="text-badge">
        <span class="text">{{$text}}</span>
        
    </span> --}}
    <label class="form-label mb-2">
        {{ $text }}
    </label>
    <div class="input-group">
        <div class="btn-group btn-group-sm" role="group" aria-label="Tipo de Sucursal">
            @foreach ($generoInformacion as $genero)
                <input 
                    type="radio" 
                    class="btn-check btn-check-sm" 
                    name="{{ $name }}" 
                    id="btn-check-{{ $genero['abreviatura'] }}" 
                    autocomplete="off"
                    value="{{ $genero['abreviatura'] }}"
                    @if ($value == $genero['abreviatura']) checked @endif
                >
                <label 
                    class="btn btn-sm btn-outline-primary btn-wave" 
                    for="btn-check-{{ $genero['abreviatura'] }}"
                    data-bs-toggle="popover"
                    data-bs-trigger="hover" 
                    data-bs-placement="bottom" 
                    data-bs-html="true"
                    title="{{ $genero['nombre'] }}" 
                    data-bs-content="{{ $genero['descripcion'] }}"
                >
                    {{ $genero['abreviatura'] }}
                </label>
            @endforeach


            {{-- @foreach ($tipos as $index => $tipo)
                <input type="radio" class="btn-check btn-check-sm" @if ($checked == $tipo || (isset($formGet) && $sucursal->tipo->concepto == $tipo)) checked @endif
                    name="{{ $name }}" id="btn-check-{{ $tipo }}" autocomplete="off"
                    value="{{ $tipo }}">
                <label class="btn btn-sm btn-outline-{{ $color[$index] }} btn-wave text-break"
                    for="btn-check-{{ $tipo }}">{{ $tipo }}</label>
            @endforeach --}}
        </div>
    </div>
</div>
