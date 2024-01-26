<form name="formMenusAdd" id="formMenusAdd" action="{{ route('confs.menus.update', ['menu' => $menu['id']]) }}" method="post"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    @include('Confs.partials.form-menus')
    
</form>
