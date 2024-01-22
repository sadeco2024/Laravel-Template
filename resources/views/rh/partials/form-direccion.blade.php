{{-- ? REQUIRE JQUERY --}}

<div class="row">
    <div class="col-xxl-8 col-md-8 mb-2">
        <x-inputs.calle value="{{ old('calle', $formGet->direccion->calle ?? '') }} " />
    </div>
    <div class="col-xxl-4 col-md-4">
        <x-inputs.calle-no value="{{ old('numero_exterior',$formGet->direccion->numero_exterior ?? '') }}" />
    </div>
    <div class="col-xxl-4 col-md-4">
        <x-inputs.calle-noint value="{{ old('numero_interior',$formGet->direccion->numero_interior ?? '') }}" />
    </div>

    <div class="col-xxl-8 col-md-8 mb-2">
        <x-inputs.colonia value="{{ old('colonia',$formGet->direccion->colonia ?? '') }}" />
    </div>
    <div class="col-xxl-6 col-md-4 mb-2">
        <x-inputs.ciudad value="{{ old('ciudad',$formGet->direccion->ciudad->ciudad ?? '') }}" />
    </div>
    <div class="col-xxl-6 col-md-3 mb-2">
        <x-inputs.cp value="{{ old('codigo_postal',$formGet->direccion->codigo_postal ?? '') }}" />
    </div>
    <div class="col-xxl-6 col-md-5 mb-2">
        <x-selects.estado :estados="$estados" value="{{ old('estado_id',$formGet->direccion->estado_id ?? '') }}" />
    </div>

    <div class="col-xxl-6 col-md-6 mb-2">
        <x-selects.municipio value="{{ old('municipio_id',$formGet->direccion->municipio_id ?? '') }}" />
    </div>

    <div class="col-xxl-12 col-md-6 mb-2">
        <x-inputs.ubicacion value="{{ old('ubicacion',$formGet->direccion->ubicacion ?? '') }}" />
    </div>
    <div class="col-xxl-12 col-md-12 mb-2">
        <x-inputs.descripcion-textarea :name="'referencia'" :text="'Referencia'" class="noenter"
            value="{{ old('referencia', $formGet->direccion->referencia->referencia ?? '') }}" />
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
