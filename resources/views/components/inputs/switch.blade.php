@props(['name'=> 'enabled', 'text' => 'Habilitado', 'checked' => false])
<div class="form-group mb-2">
<div class="form-check form-switch">
    <input class="form-check-input" @if ($checked) checked @endif type="checkbox" role="switch" name="{{$name}}"
        id="enabled">
    <label class="form-check-label">{{$text}}</label>
</div>
</div>