
<form name="formMenusAdd" class="form-modal" id="fomArticuloAdd" action="{{ route('erp.articulos.update',$articulo) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
     <div class="row">

        <div class="col-xxl-8 text-left">
            <x-inputs.name :name="'nombre'" :text="'Nombre del artículo'" value="{{ old('name') ?? $articulo->nombre ?? ''}}" />
                <x-input-error-line :messages="$errors->get('name')" />
        </div>
        <div class="col-xxl-4">
            <x-inputs.name :name="'clave_principal'" :text="'Clave principal'" />
        </div>
        {{-- <x-hr-form :text="'Clasificación'" /> --}}
        <div class="col-xxl-4">
            <x-selects.sucursal :name="'linea_articulo'" :text="'Línea'" />
        </div>
        <div class="col-xxl-4">
            <x-selects.sucursal :name="'categoria_articulo'" :text="'Categoría'" />
        </div>
        <div class="col-xxl-4">
            <x-inputs.name :name="'clave_codigo'" :text="'Código de barras'" />
        </div>

        <x-hr-form :text="'Precios'" />
        <div class="col-xxl-4">
            <x-inputs.importe :name="'precio'" :text="'Precio'" />
        </div>
        <div class="col-xxl-4">
            <x-inputs.importe :name="'costo'" :text="'Costo'" />
        </div>
        <div class="col-xxl-4">
            <x-inputs.name :name="'alert_reponer'" :text="'Alerta para reponer'" />
        </div>


    </div>
</form>
