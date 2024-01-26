<div class="form-row">
    {{-- @dump($menu) --}}
    <div class="col-12">
        <x-inputs.name :name="'nombre'" value="{{ old('nombre', $menu->nombre ?? '') }}" />
        <x-inputs.slug :name="'slug'" value="{{ old('slug', $menu->slug ?? '') }}" />
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                <x-selects.concepto :conceptos="$conceptos" :name="'tipo_concepto_id'"
                    selected="{{ old('tipo_concepto_id', $menu->tipo_concepto_id ?? '') }}" />
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                <x-selects.orden :maximo="25" :name="'orden'"
                    selected="{{ old('orden', $menu->orden ?? '') }}" />
            </div>
        </div>
        <x-selects.modulo :modulos="$modulos" selected="{{ old('cg_modulo_id', $menu->cg_modulo_id ?? '') }}" />
        <x-inputs.descripcion-textarea :name="'comentario'" value="{{ old('comentario',$menu->comentario->comentario ?? '')}}" />
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 ">
                <x-inputs.icono :name="'icono'" value="{{old('icono',$menu->icono ?? '')}}" />
            </div>
            
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 padre_cg ">
                <x-selects.padre-menu :menus="$menus" :name="'padre_cg_menu_id'"
                    selected="{{(int) old('padre_cg_menu_id', $menu->padre_cg_menu_id ?? '') }}" />
            </div>
        </div>
        <div class="col-12 d-flex  align-items-end">
            <x-inputs.switch  :checked="$menu->enabled ?? true" />
        </div>
    </div>
</div>
