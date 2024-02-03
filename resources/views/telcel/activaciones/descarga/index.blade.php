<form class="form-modal" name="cargaActivaciones" id="cargaActivaciones"
    action="{{ route('telcel.activaciones.download.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <div class="form-group">
        <div class="row">

            <div class="col-xl-6">

                <x-inputs.fecha-inicial :name="'fecha_inicial'" :text="'Fecha inicial'" value="{{ now()->format('Y-m-d') }}" />
            </div>

            <div class="col-xl-6">
                <x-inputs.fecha-final :name="'fecha_final'" :text="'Fecha final'" value="{{ now()->format('Y-m-d') }}" />
            </div>

            {{-- <div class="d-grid gap-2 mb-3">

                <button type="button" class="btn btn-primary btn-sm btn-wave">Descargar</button>
            </div> --}}

  

        </div>
    </div>
</form>

<div class="col-xl-12">
    <div class="table-responsive">
        <table id="tblDescActivaciones" class="table table-sm">
            <thead>
                <tr>
                    <th>Incial</th>
                    <th>Final</th>
                    <th>Descarga</th>
                </tr>
            </thead>
            <tbody>
                

            </tbody>
        </table>
    </div>
</div>