@props(['name' => 'ubicacion', 'icon' => 'bi bi-signpost-split', 'value' => ''])

<div class="form-group mb-2">
    <label class="form-label mb-0">Ubicación</label>
    <div class="input-group">
        
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="text" name="{{ $name }}" id="getUbicacion" class="form-control" placeholder=""
            value="{{ $value }}">
        
            <button class="btn btn-primary-transparent btn-sm" type="button" id="getGeo">
                <i class="bi bi-geo-alt"></i>
            </button>
        
    </div>
    <small id="infoUbi" class="form-text text-warning text-muted"></small>
    <x-input-error-line :messages="$errors->get($name)" />
</div>

<script>
    document.getElementById('getGeo').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;
                // console.log('Latitud: ' + lat + ', Longitud: ' + lon);
                input = document.getElementById('getUbicacion');
                input.value = lat + ',' + lon;
            }, function(error) {
                info = document.getElementById('infoUbi');
                info.innerHTML = 'No tiene permiso para obtener la localización.';
            });
        } else {
            info = document.getElementById('infoUbi');
            info.innerHTML = 'Geolocalización no soportada por el navegador.';
        }
    });
</script>
