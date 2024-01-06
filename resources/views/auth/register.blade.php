@extends('layouts.guest')

@section('body-class')
    class="authentication-background"
@endsection

@section('vite-js')
    @vite(['resources/js/guest.js'])
@endsection

@section('content')
    <div class="container-lg">
        <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="card custom-card my-4">
                    <div class="card-body p-5">
                        <div class="mb-3 d-flex justify-content-center">
                            <div class="mb-3 d-flex justify-content-center">
                                <img style="width: 80px; height: 80px;"
                                    src="{{ Vite::asset('resources/assets/images/brand-logos/logo-70.png') }}"
                                    alt="img" />
                            </div>
                        </div>
                        <p class="h5 mb-2 text-center">{{ __('Sign Up') }}</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row gy-3">
                                {{-- Nombre  --}}
                                <div class="col-xl-12">
                                    <label for="name"
                                        class="form-label text-default">{{ __('Full Name') }}<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-lg" id="name" name="name"
                                        value="{{ old('name') }}" required autocomplete="off">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                                <!-- Usuario / Correo -->
                                <div class="col-xl-12">
                                    <label for="signin-username"
                                        class="form-label text-default">{{ __('Email Address') }}</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                        value="{{ old('email') }}" autocomplete="off">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                {{-- New Password --}}
                                <div class="col-xl-12">
                                    <label for="password" class="form-label text-default">{{ __('Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password"
                                            class="form-control form-control-lg {{ $errors->get('password') ? 'is-invalid' : '' }}"
                                            name="password" id="password">
                                        <a role="button" class="show-password-button text-muted"
                                            onclick="viewPassword('password',this)">
                                            <i class="ri-eye-off-line align-middle"></i></a>
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>
                                {{-- Confirm Password --}}
                                <div class="col-xl-12 mt-2">
                                    <label for="password_confirmation"
                                        class="form-label text-default">{{ __('Confirm Password') }}</label>
                                    <div class="position-relative">
                                        <input type="password"
                                            class="form-control form-control-lg {{ $errors->get('password_confirmation') ? 'is-invalid' : '' }}"
                                            name="password_confirmation" id="password_confirmation">
                                        <a role="button" class="show-password-button text-muted"
                                            onclick="viewPassword('password_confirmation',this)">
                                            <i class="ri-eye-off-line align-middle"></i></a>
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>


                            <div class="d-grid mt-4">
                                <button class="btn btn-lg btn-primary">{{ __('Create Account') }}</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="text-muted mt-3 mb-0">{{ __('Already have an account?') }} <a
                                    href="sign-in-basic.html" class="text-primary">{{ __('Sign In') }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.partials.footer')
@endsection

@section('js')
    <script src="{{ Vite::asset('resources/assets/js/show-password.js') }}"></script>
@endsection
