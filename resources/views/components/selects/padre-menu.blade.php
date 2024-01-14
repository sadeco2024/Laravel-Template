@props(['menus', 'name' => 'padre_cg_menu_id'])

<div class="form-group mb-2">
    <label class="form-label fs-14 text-dark">Menu padre</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="bi bi-menu-button"></i>
        </div>
        <select class="form-select" name="{{ $name }}">
            <option value="0" selected> - -</option>
            @foreach ($menus as $menu)
                @if ($menu['concepto'] == 'menu')
                
                    <option @if (old($name) == $menu['id']) selected @endif value="{{ $menu['id'] }}">
                        {{ $menu['nombre'] }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>

{{-- <script>
    $(document).ready(function() {
        const selectElement = document.querySelector('select.habilita');
        const divElement = document.querySelector('.padre_cg');
        const innerSelectElement = divElement.querySelector('select');
        selectElement.addEventListener('change', (event) => {
            const selectedOptionText = event.target.options[event.target.selectedIndex].text;
            if (selectedOptionText === 'crud' || selectedOptionText === 'vista') {
                divElement.classList.remove('d-none');
            } else {
                innerSelectElement.value=0;
                divElement.classList.add('d-none');

            }
        });
    });
</script> --}}
