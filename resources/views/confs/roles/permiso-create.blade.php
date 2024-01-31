<form id="frmPermisosAdd" name="frmPermisosAdd" action="{{ route('confs.roles.permissions.store') }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @method('POST')

    {{-- <input type="hidden" name="rol_id" value="{{ $role->id }}"> --}}

    <div class="col">
        <x-inputs.name :name="'pnombre'" />
        <x-selects.modulo :modulos="$modulos" :name="'pcg_modulo_id'" />
        <x-inputs.slug :name="'pname'" />
        <x-inputs.descripcion-textarea :name="'pdescripcion'" />
    </div>
</form>
