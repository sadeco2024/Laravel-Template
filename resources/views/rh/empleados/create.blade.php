@extends('layouts.auth')
@section('title', config('app.name') . ' - Permisos del rol')
@section('title-view', 'Nuevo empleado')
@section('content')


    <div class="card custom-card">
        <form action="{{ route('rh.empleados.store') }}" method="POST">
        <div class="card-body">
            
                @csrf

                @include('rh.partials.form-empleado', [
                    'btnText' => 'Guardar',
                ])

            
        </div>
        <div class="card-footer">
            <button class="btn btn-primary me-2" type="submit">
                Guardar
            </button>
            
            <a href="{{ route('rh.empleados.index') }}" class="btn btn-light">Regresar</a>
        </div>
    </form>
    </div>


@endsection

@section('js')
    <x-scripts.jquery :sweetAlert='true'>
            {{-- <script>
                $(document).ready(function() {
                    $('.rhExtras222').click(function() {
                        let select = $(this).closest('div.input-group').find('select')[0];
                        Swal.fire({
                            title: "¿Nombre del " + this.dataset.concepto + "?",
                            input: "text",
                            inputAttributes: {
                                autocapitalize: "on",
                            },
                            showCancelButton: true,
                            confirmButtonText: "Guardar",
                            showLoaderOnConfirm: true,
                            preConfirm: (nombre) => {
                                return fetch('{{ route('set.rhextras') }}', {
                                        method: "post",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                        },
                                        body: JSON.stringify({
                                            concepto: this.dataset.concepto,
                                            descripcion: nombre,
                                        }),
                                    })
                                    .then((response) => {
                                        if (!response.ok) {
                                            return response.json().then((error) => {
                                                console.log(error.message);
                                                throw new Error(error.message);
                                            });
                                        }
                                        return response.json();
                                    })
                                    .catch((error) => {
                                        Swal.showValidationMessage(`${error}`);
                                    });
                            },
                            allowOutsideClick: () => !Swal.isLoading(),
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let option = document.createElement("option");
                                option.text = result.value.descripcion;
                                option.value = result.value.id;
                                select.add(option);
                                select.value = result.value.id;
                                
                            }
                        });
                    });
                });
            </script> --}}


    </x-scripts.jquery>


    {{-- <script src="{{ Vite::asset('resources/js/alerts.js') }}"></script>
    <script>
        alertSuccess('Hola')
    </script> --}}
@endsection
