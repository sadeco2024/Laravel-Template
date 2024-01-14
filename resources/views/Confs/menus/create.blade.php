

<form name="formMenusAdd" id="formMenusAdd" action="{{route('confs.menus.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-row">
        <div class="col-12">
            <x-inputs.name :name="'nombre'" />
            <x-inputs.slug :name="'slug'" />
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                    <x-selects.concepto :conceptos="$conceptos" />
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                    <x-selects.orden :maximo="25" />
                </div>
            </div>
            <x-selects.modulo :modulos="$modulos" />
            <x-inputs.descripcion-textarea />
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                    <x-inputs.icono />
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 padre_cg d-none">
                    <x-selects.padre-menu :menus="$menus" />
                </div>                
      
            </div>
            <div class="col-12 d-flex  align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input bg-primary" checked type="checkbox" role="switch" name="enabled" id="enabled">
                    <label class="form-check-label">Habilitado</label>
                  </div>        
            </div>
        </div>
    </div>
</form>
