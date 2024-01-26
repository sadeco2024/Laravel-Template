@extends('layouts.guest')

@section('body-class')
class="authentication-background"
@endsection
    
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-5 col-xl-5 col-lg-6 col-md-7 col-sm-10 col-12">
                <div class="card custom-card my-4">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3 d-flex justify-content-center">
                                <img style="width: 80px; height: 80px;"
                                    src="{{ asset('/images/logo.png') }}" alt="img" />
                            </div>
                            <p class="h5 mb-2 text-center">{{ config('app.name') }}</p>
                            <p class="mb-4 text-muted op-9 fw-normal text-center">{{ __('Welcome!') }}</p>
                            <div class="row gy-3">

                                <!-- Usuario / Correo -->
                                <div class="col-xl-12">
                                    <label for="signin-username" class="form-label text-default">{{ __('User') }} / {{ __('Email') }}</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                       value="{{ old('email') }}" autocomplete="off">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                {{-- Contraseña --}}
                                <div class="col-xl-12 mb-2">
                                    @if (Route::has('password.request'))
                                    {{-- Olvidada --}}
                                        <label for="password" class="form-label text-default d-block">{{ __('Password') }}
                                            <a href="{{ route('password.request') }}"
                                                class="float-end text-primary">{{ __('Forgot Your Password?') }}
                                            </a>
                                        </label>
                                    @endif
                                    {{-- Input --}}
                                    <div class="position-relative">
                                        <input type="password" class="form-control form-control-lg" id="password"
                                            name="password" placeholder="" autocomplete="off">

                                        <a href="javascript:void(0);" class="show-password-button text-muted"
                                            onclick="createpassword('password',this)">
                                            <i class="ri-eye-off-line align-middle"></i>
                                        </a>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-check">
                                            <label >
                                                <input class="form-check-input " type="checkbox"  name="remember" value=""/>
                                                {{ __('Remember me') }}
                                            </label>
                                        </div>
                                        <x-auth-session-status class="mt-4" :status="session('status')" />
                                    </div>
                                </div>

                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg btn-primary">{{ __('Sign In') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ Vite::asset('resources/theme/js/show-password.js') }}"></script>
@endsection
