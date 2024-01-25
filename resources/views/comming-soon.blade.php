@extends('layouts.guest')

@section('bodyclass','class="coming-soon-main"')
    


@section('vite-js')
    @vite(['resources/js/guest.js'])
@endsection

@section('content')
<div class="coming-soon-main">
    <div class="row authentication coming-soon justify-content-center g-0 my-auto">
        <div class="col-xxl-8 col-xl-8 col-lg-8 col-12 my-auto">
            <div class="authentication-cover">
                <div class="aunthentication-cover-content text-center">
                    <div class="row justify-content-center align-items-center mx-0 g-0">
                        <div class="col-xxl-6 col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mb-md-0 mb-5">
                            <div class="mb-2">
                                <figure class="img-fluid bg-transparent">
                                    <img src="{{ asset('images/logos/logo-70.png') }}"
                                        alt="" class="authentication-brand img-fluid rounded-pill">

                                </figure>
                                <small class="text-muted fw-bolder fs-6">SADECO</small>


                            </div>
                            <p class="fs-12 mb-1 text-muted">{{ __('STAY TUNED') }}</p>
                            <h1 class="mb-3">{{ __('Coming Soon') }}</h1>
                            <p class="mb-4">
                                {{ __('Our website is presently under construction. Please provide your email address to receive the latest updates and notifications regarding our website') }}.
                            </p>

                            <div class="d-flex gap-3 flex-wrap mt-4 mb-5 gy-xxl-0 gy-3 justify-content-center"
                                id="timer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.partials.footer')
@endsection


@section('js')
    {{-- <script src="{{ Vite::asset('resources/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ Vite::asset('resources/js/coming-soon.js') }}"></script> --}}
    <script>
        
    </script>
@endsection