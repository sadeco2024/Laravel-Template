@extends('layouts.auth')

@section('title', config('app.name') . ' - Dashboard')

@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection

@section('title-view', 'Indicadores')

@section('content')
 Menus!
@endsection

@section('js')

@endsection