{{-- ? REQUIRE JQUERY --}}

<div class="row">
    <div class="col-xxl-8 col-md-8 mb-2">
        <x-inputs.calle value="{{ isset($sucursal) ? $sucursal->direccion->calle : '' }} " />
    </div>
    <div class="col-xxl-4 col-md-4">
        <x-inputs.calle-no value="{{ isset($sucursal) ? $sucursal->direccion->numero_exterior : '' }}" />
    </div>
    <div class="col-xxl-4 col-md-4">
        <x-inputs.calle-noint value="{{ isset($sucursal) ? $sucursal->direccion->numero_interior : '' }}" />
    </div>

    <div class="col-xxl-8 col-md-8 mb-2">
        <x-inputs.colonia value="{{ isset($sucursal) ? $sucursal->direccion->colonia : '' }}" />
    </div>
    <div class="col-xxl-6 col-md-4 mb-2">
        <x-inputs.ciudad value="{{ isset($sucursal) ? $sucursal->direccion->ciudad->ciudad : '' }}" />
    </div>
    <div class="col-xxl-6 col-md-3 mb-2">
        <x-inputs.cp value="{{ isset($sucursal) ? $sucursal->direccion->codigo_postal : '' }}" />
    </div>
    <div class="col-xxl-6 col-md-5 mb-2">
        <x-selects.estado :estados="$estados" value="{{ isset($sucursal) ? $sucursal->direccion->estado_id : '' }}" />
    </div>

    <div class="col-xxl-6 col-md-6 mb-2">
        <x-selects.municipio value="{{ isset($sucursal) ? $sucursal->direccion->municipio_id : '' }}" />
    </div>

    <div class="col-xxl-12 col-md-6 mb-2">
        <x-inputs.ubicacion value="{{ isset($sucursal) ? html_entity_decode($sucursal->direccion->ubicacion) : '' }}" />
    </div>
    <div class="col-xxl-12 col-md-12 mb-2">
        <x-inputs.descripcion-textarea :name="'referencia'" :text="'Referencia'" class="noenter"
            value="{{ isset($sucursal) ? $sucursal->direccion->referencia->referencia : '' }}" />
    </div>
</div>

<x-scripts.jquery>
    <script>
        $(document).ready(function() {
            $('#estado_id').change(function(municipio_id) {
                $('#municipio_id').prop('disabled', true);
                var selectedValue = $(this).val();
                fetch('/generales/getMunicipios/' + selectedValue)
                    .then(response => response.json())
                    .then(data => {
                        $('#municipio_id').prop('disabled', false);
                        $('#municipio_id').empty();
                        $.each(data, function(key, value) {
                            $('#municipio_id').append('<option value=' + value.id + '>' + value
                                .municipio +
                                '</option>');
                        });
                        if ($('#municipio_id').attr('edit-id') != '') {
                            $('#municipio_id').val($('#municipio_id').attr('edit-id'))
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
            $('#estado_id').change();
        })
    </script>
</x-scripts.jquery>
