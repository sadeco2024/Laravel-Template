@props(['menus', 'name' => 'padre_cg_menu_id','selected'=>0])

<div class="form-group mb-2">
    <label class="form-label fs-14 text-dark">Menu padre</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="bi bi-menu-button"></i>
        </div>
        {{-- @dump($selected) --}}
        <select class="form-select" name="{{ $name }}">
            <option value="0" @if((int)$selected ==0 ) selected @endif> - Seleccionar -</option>
            @foreach ($menus as $menu)
                @if ($menu['concepto'] == 'menu')
                    <option @if ((int)$selected == $menu['id']) selected @endif value="{{ $menu['id'] }}">
                        {{ $menu['nombre'] }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>

