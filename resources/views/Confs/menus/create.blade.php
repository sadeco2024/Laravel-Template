

<form class="form-modal" name="formMenusAdd" id="formMenusAdd" action="{{route('confs.menus.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')

    @include('Confs.partials.form-menus')

</form>
