@extends('layouts.auth')

@section('title', config('app.name') . ' - Dashboard')

@section('vite-js')
    @vite(['resources/js/auth-app.js'])
@endsection

@section('title-view', 'Nuevo empleado')

@section('content')


    <div class="row">
        <div class="col-xl-8 offside-xl-2">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Form grid
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" placeholder="First name" aria-label="First name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Address</label>
                            <div class="row">
                                <div class="col-xl-12 mb-3">
                                    <input type="text" class="form-control" placeholder="Street" aria-label="Street">
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <input type="text" class="form-control" placeholder="Landmark" aria-label="Landmark">
                                </div>
                                <div class="col-xxl-6 col-xl-12 mb-3">
                                    <input type="text" class="form-control" placeholder="City" aria-label="City">
                                </div>
                                <div class="col-xxl-6 col-xl-12 mb-3">
                                    <select id="inputState1" class="form-select">
                                        <option selected>State</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-xxl-6 col-xl-12 mb-3">
                                    <input type="text" class="form-control" placeholder="Postal/Zip code"
                                        aria-label="Postal/Zip code">
                                </div>
                                <div class="col-xxl-6 col-xl-12 mb-3">
                                    <select id="inputCountry" class="form-select">
                                        <option selected>Country</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="row">
                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="email">
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <label class="form-label">D.O.B</label>
                                    <input type="date" class="form-control" aria-label="dateofbirth">
                                </div>
                                <div class="col-xl-12 mb-3">
                                    <div class="row">
                                        <label class="form-label mb-1">Maritial Status</label>
                                        <div class="col-xl-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Married
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                    id="flexRadioDefault2" checked>
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Single
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="number" class="form-control" placeholder="Phone number" aria-label="Phone number">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Alternative Contact</label>
                            <input type="number" class="form-control" placeholder="Phone number" aria-label="Phone number">
                        </div>
                        <div class="col-md-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="gridCheck">
                                <label class="form-check-label" for="gridCheck">
                                    Check me out
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-none border-top-0">

                </div>
            </div>
        </div>
    </div>
    </div>



@endsection

@section('js')

@endsection
