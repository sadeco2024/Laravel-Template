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
                        <form method="POST" action="{{ route('password.store') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <input type="hidden" name="email" value="{{ $request->email }}">

                            <div class="mb-3 d-flex justify-content-center">
                                <img style="width: 80px; height: 80px;"
                                    src="{{ Vite::asset('resources/assets/images/brand-logos/logo-70.png') }}"
                                    alt="img" />
                            </div>
                            <p class="h5 mb-2 text-center mb-3">
                                {{ __('Change Password') }}
                            </p>
                            <p class="text-center mt-2">
                                <small class="text-muted">
                                    {{ $request->email }}
                                </small>
                            </p>

                            <div class="row gy-3 mt-2">
                                {{-- New Password --}}
                                <div class="col-xl-12">
                                    <label for="password" class="form-label text-default">{{ __('New Password') }}</label>
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
                            {{-- Submit --}}
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg btn-primary">{{ __('Change Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ Vite::asset('resources/assets/js/show-password.js') }}"></script>
@endsection
