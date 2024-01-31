<form id="frmCanalesAdd" name="frmCanalesAdd" action="{{ route('telcel.canales.update', $canal) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-xl-12">
            <x-inputs.name :name="'nombre'" value="{{ old('nombre', $canal->nombre ?? '') }}" />
            <small class="text-muted mb-4">
                - {{ $canal->direccion }}, {{ $canal->municipio->municipio ?? '' }} {{ $canal->estado->estado ?? '' }}
            </small>

        </div>
        <div class="col-xl-6">
            <x-inputs.name :name="'clave'" :text="'Clave'" :icon="'bi bi-braces'"
                value="{{ old('clave', $canal->clave ?? '') }}" />
        </div>
        <div class="col-xl-6">
            <x-inputs.name :name="'acox'" :text="'Acox'" :icon="'bi bi-braces-asterisk'"
                value="{{ old('acox', $canal->acox ?? '') }}" />
        </div>
        <div class="col-xl-5">
            <x-inputs.password :name="'contrasena'" value="{{ old('contrasena', $canal->contrasena ?? '') }}" />
        </div>
        <div class="col-xl-7">
            <x-selects.sucursal :sucursales="$sucursales" :name="'sucursal_id'"
                value="{{ old('sucursal_id', $canal->sucursal->id ?? '') }}" />
        </div>
        <div class="col-xl-8 mb-3">
            <x-inputs.tipo-radio :name="'concepto'" :text="'Tipo canal'" :tipos="['Distribuidor', 'Cadena', 'Subs']" :color="['primary', 'warning', 'secondary']"
                :checked="old('concepto', $canal->concepto->concepto ?? '')" />

        </div>
        {{-- Acciones --}}
        <div class="col-xl-4 mb-3">
            <div class="form-group">
                <label class="form-label mb-1">Acciones</label>
                <div class="input-group">
                    <div class="btn-group " role="group" aria-label="Tipo de Sucursal">
                        <button type="button" id="btnQuestion" role="button"
                            class="btn btn-sm btn-{{ $canal->question == 1 ? 'success' : 'primary' }}-transparent save-link"
                            data-link="{{ route('telcel.canales.setquestion', $canal) }}"
                            onclick="saveLink(this);"
                            title="Establece la pregunta secreta" 
                        >
        
                            <i class="bi bi-question-circle fs-15"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-info-transparent" title="Sincronizar usuarios"
                            data-link="{{ route('telcel.canales.sincrcox', $canal) }}"
                            aria-label="Obtiene los usuarios del canal" onclick="saveLink(this);">
                            <i class="bi bi-arrow-clockwise fs-15"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger-transparent" title="Reiniciar la contraseña"
                            data-link="{{ route('telcel.canales.reset', $canal) }}" onclick="saveLink(this);"
                            aria-label="Reiniciar la contraseña del acox">
                            <i class="bi bi-power fs-15"></i>
                        </button>

                    </div>
                    {{-- Popovers --}}
              

                </div>
            </div>

        </div>
        {{-- Vendedores --}}
        <div class="col-xl-12">
            <div class="table-responsive">
                <table id="tableCanalVendedores" class="table table-sm table-borderless">
                    <thead class="table-info">
                        <tr>
                            <th>Vendedor</th>
                            <th>Único</th>
                            <th>Contraseña</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($canal->rcox) --}}
                        @foreach($canal->rcox as $vendedor)
                        <tr>
                            <td>{{$vendedor->nombre}}</td>
                            <td>{{$vendedor->logunico}}</td>
                            <td>{{$vendedor->contrasena}}</td>
                            

                            <td>
                                <button type="button" class="btn btn-sm btn-danger-transparent"
                                    title="Reiniciar vendedor" aria-label="Reiniciar vendedor"
                                    data-link="{{route('telcel.canales.reset.rcox',$vendedor)}}"
                                    onclick="saveLink(this);"
                                    title="Reiniciar contraseña vendedor"                                     
                                    >
                                    <i class="bi bi-power"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- </div> --}}

        {{-- <x-selects.modulo :modulos="$modulos" :name="'pcg_modulo_id'" selected="{{old('cg_modulo_id',$canal->cg_modulo_id ?? '')}}"/>
        <x-inputs.slug :name="'pname'" value="{{old('name',$canal->name ?? '')}}" />
        <x-inputs.descripcion-textarea :name="'pdescripcion'" value="{{old('descripcion',$canal->descripcion ?? '')}}" /> --}}
    </div>
</form>
