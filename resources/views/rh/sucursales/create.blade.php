@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection
@section('title-view', 'Nueva sucursal')
@section('content')



    <x-scripts.jquery/>
    
    <div class="card custom-card">
        <div class="card-body">
            <form action="{{ route('rh.sucursales.store') }}" method="POST">
                @csrf
                
                @include('rh.partials.form-sucursal',[
                    'btnText' => 'Guardar',
                    // 'btnIcon' => 'bi bi-arrow-clockwise',                    
                ])
   
            </form>
        </div>
    </div>



@endsection

@section('js')




@endsection
