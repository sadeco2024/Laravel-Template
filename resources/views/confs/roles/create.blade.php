@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')

@section('title-view', 'Datos del rol')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form method="post" action="{{ route('confs.roles.store') }}">
                        @csrf
                        @method('POST')
                        @include('confs.partials.form-rol',['btnText'=>'Guardar', 'btnIcon'=>'ri-save-line'])
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')

@endsection