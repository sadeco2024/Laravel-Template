<form id="frmPermisosAdd" name="frmPermisosAdd" action="{{ route('confs.roles.permissions.update', $permiso) }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="col">
        <x-inputs.name :name="'pnombre'" value="{{old('nombre',$permiso->nombre ?? '')}}"  />
        <x-selects.modulo :modulos="$modulos" :name="'pcg_modulo_id'" selected="{{old('cg_modulo_id',$permiso->cg_modulo_id ?? '')}}"/>
        <x-inputs.slug :name="'pname'" value="{{old('name',$permiso->name ?? '')}}" />
        <x-inputs.descripcion-textarea :name="'pdescripcion'" value="{{old('descripcion',$permiso->descripcion ?? '')}}" />
    </div>
</form>
