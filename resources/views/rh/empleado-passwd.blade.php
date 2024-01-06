@extends('layouts.auth')

@section('title', config('app.name') . ' - Dashboard')

@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection

@section('title-view', 'Cambiar contraseña')



@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center ">
            <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                <div class="card custom-card my-3">
                    <div class="card-body p-4">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            {{-- Current Password --}}
                            <div class="col-xl-12">
                                <label for="current_password"
                                    class="form-label text-default">{{ __('Current Password') }}</label>
                                <div class="position-relative">
                                    <input
                                        type="password" 
                                        class="form-control form-control-lg {{$errors->updatePassword->get('current_password') ? 'is-invalid' : ''}}" 
                                        name="current_password"
                                        id="current_password"
                                    >
                                    <a 
                                        role="button"
                                        class="show-password-button text-muted"
                                        onclick="viewPassword('current_password',this)"
                                     >
                                        <i class="ri-eye-off-line align-middle"></i></a>
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                </div>
                            </div>

                            {{-- New Password --}}
                            <div class="col-xl-12">
                                <label for="password"
                                    class="form-label text-default">{{ __('New Password') }}</label>
                                <div class="position-relative">
                                    <input
                                        type="password" 
                                        class="form-control form-control-lg {{$errors->updatePassword->get('password') ? 'is-invalid' : ''}}" 
                                        name="password"
                                        id="password"
                                    >
                                    <a 
                                        role="button"
                                        class="show-password-button text-muted"
                                        onclick="viewPassword('password',this)"
                                     >
                                        <i class="ri-eye-off-line align-middle"></i></a>
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                </div>
                            </div>
                            {{-- Confirm Password --}}
                            <div class="col-xl-12 mt-2">
                                <label for="password_confirmation"
                                    class="form-label text-default">{{ __('Confirm Password') }}</label>
                                <div class="position-relative">
                                    <input
                                        type="password" 
                                        class="form-control form-control-lg {{$errors->updatePassword->get('password_confirmation') ? 'is-invalid' : ''}}" 
                                        name="password_confirmation"
                                        id="password_confirmation"
                                    >
                                    <a 
                                        role="button"
                                        class="show-password-button text-muted"
                                        onclick="viewPassword('password_confirmation',this)"
                                     >
                                        <i class="ri-eye-off-line align-middle"></i></a>
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                </div>
                            </div>
                            {{-- Submit --}}
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-lg btn-primary">{{ __('Change Password') }}</button>
                            </div>
                            @if (session('status') === 'password-updated')
                                <x-auth-session-status class="mt-4" :status=" __('Password updated')" />
                            @endif
              
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- !TODO: Hacer el cambio de email y borrar usuario --}}


@endsection

@section('js')
    <script src="{{ Vite::asset('resources/assets/js/show-password.js') }}"></script>
@endsection
