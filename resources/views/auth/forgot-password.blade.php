@extends('layouts.guest')

@section('bodyclass')
    class="authentication-background"
@endsection


@section('vite-js')
    @vite(['resources/js/guest.js'])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-7 col-sm-10 col-12">
                <div class="card custom-card my-4">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3 d-flex justify-content-center">
                                <img style="width: 80px; height: 80px;"
                                    src="{{ Vite::asset('resources/assets/images/brand-logos/logo-70.png') }}" alt="img" />
                            </div>
                            <p class="h5 mb-2 text-center mb-3">{{ config('app.name') }}</p>
                            <small class="text-muted mt-3">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </small>
                            <div class="row gy-3 mt-2">
                                <!-- Usuario / Correo -->
                                <div class="col-xl-12 mt-4">
                                    <label for="email" class="form-label text-default">{{ __('Email Address') }}</label>
                                    <input
                                        type="email" 
                                        class="form-control form-control-lg"
                                        id="email" 
                                        name="email"
                                        placeholder=""
                                        value="{{ old('email') }}"
                                        autocomplete="off"
                                    >
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary custom-button rounded-pill">
                                    <span class="custom-btn-icons ms-1">
                                        <i class="ri-mail-line align-middle text-primary"></i>
                                    </span>
                                    {{ __('Send Link') }}
                                </button>
                                <x-auth-session-status class="mt-4" :status="session('status')" />
                            </div>

                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





