@props(['name' => 'slug', 'icon' => 'bi bi-code-slash'])

<div class="form-group mb-2">
    <label class="form-label">Slug</label>
    <div class="input-group">
        <div class="input-group-text">
            <i class="{{ $icon }}"></i>
        </div>
        <input type="text" name="{{ $name }}" id="{{ $name }}" class="form-control" placeholder=""
            value="{{ isset($request->slug) ? $request->slug : old($name) }}">
    </div>
    <x-input-error-line :messages="$errors->get($name)" />
</div>

