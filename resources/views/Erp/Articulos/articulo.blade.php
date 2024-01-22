<div class="row">
    @foreach ($data as $row)
        @php
            $lineas = $row->categoria->lineas;
            $linea = $lineas[0]->linea;
            $icono = $lineas[0]->icono;
        @endphp


        <div class="col-xxl-3 col-xl-4 col-lg-5 col-md-6">

            {{-- <a class="modal-effect " data-bs-effect="effect-slide-in-right"
            data-bs-toggle="modal" href="#modaldemo8"  > --}}
            
            <div class="card custom-card overflow-hidden cursor-pointer" onclick="$('#modaldemo8').data('row',this.dataset.row).modal('show');"
                data-row="{{ $row }}">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-start card-articulos">
                        <div class="d-flex flex-column justify-content-top ">
                            <span class="avatar avatar-xl h-100 bg-info-transparent rounded-0">
                                <i class="{{ $icono ?? 'bx bx-purchase-tag-alt' }} fs-3"></i>
                                {{-- <i class='bx bx-purchase-tag-alt fs-3' ></i> --}}

                            </span>
                            <span class="bg-success text-center p-2 fw-semibold text-white">12 uds</span>
                        </div>

                        <div class="d-flex flex-column flex-fill justify-content-between">
                            <div class="d-flex flex-fill justify-content-between">
                                <div class="d-flex flex-column justify-content-between p-2">
                                    <span class="">{{ $row->nombre }}</span>
                                    <span class="text-muted mt-2 fs-11">
                                        {{ $linea }} || {{ $row->categoria->categoria }}
                                    </span>
                                </div>
                                <div class="p-2">
                                    {{-- <span class="badge badge-success bg-success">5%</span> --}}
                                </div>
                            </div>

                            <div class="d-flex mx-2 align-baseline">
                                <i class='bx bx-barcode text-success fs-4 me-1'></i>
                                <span class="text-muted fs-11 mt-1">
                                    75508787856566588
                                </span>
                                <span class="fw-semibold ms-auto pe-2 pb-2">
                                    $72.00
                                </span>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {{-- </a> --}}
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-xxl-12"></div>
</div>
<script>
    $(document).ready(function() {
 
    });
</script>
