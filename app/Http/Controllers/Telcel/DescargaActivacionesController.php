<?php

namespace App\Http\Controllers\Telcel;

use App\Http\Controllers\Controller;
use App\Models\Erp\ArticuloDiscreto;
use App\Models\Generales\Concepto;
use App\Models\Generales\Estatus;
use App\Models\Generales\Telefono;
use App\Models\Telcel\Activacion;
use App\Models\Telcel\Canal;
use App\Models\Telcel\CanalVendedor;
use App\Services\Telcel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class DescargaActivacionesController extends Controller
{
    protected $scrap;

    public function __construct(Telcel $browser)
    {
        $this->scrap = $browser;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('telcel.activaciones.descarga.index')->render();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     'fecha_inicial' => 'required|date',
        //     'fecha_final' => 'required|date',
        // ]);


        $data = $this->scrap->getActivaciones(1, $request->fecha_inicial, $request->fecha_final);

        if ($data['status'] !== 0) {
            // TODO: se regresa el json del error.
            return $data;
        }
        
        // $file = "activaciones_01012024_al_05012024_acox17274.csv";
        $file = $data['data']['file'];
        $csvFile = $this->readCSv($file);

        $array = [
            "tblDescActivaciones" => [
                'fecha_inicial' => $request->fecha_inicial,
                'fecha_final' => $request->fecha_final,
                'registros' => $data['data']['Registros']
            ]
        ];
        return response()->json([
            'status'=>0,
            // 'redirect' => route('telcel.activaciones.index'), // 'redirect' => 'http://localhost:8000/telcel/activaciones
            'alert' => 'Activaciones descargadas.',
            'table' => $array
        ]);
    }

    public function readCSV($file)
    {
        $data = [];
        $path = storage_path('app/' . $file);
        if (Storage::exists($file)) {
            $csv = Reader::createFromPath($path, 'r');
            $csv->setHeaderOffset(0); // La primera fila es el encabezado

            $records = $csv->getRecords(); // Obtener todos los registros

            $data = [];

            foreach ($records as $record) {
                $data[] = $this->guardaActivación($record);
            }
        }
        return $data;
    }

    private function guardaActivación($row)
    {

        $telefono = Telefono::obtenerTelefono($row['MSISDN']);
        $imei_id = ArticuloDiscreto::discretoId($row['IMEI']);
        $iccid_id = ArticuloDiscreto::discretoId($row['ICCID'], 18);
        $concepto = Concepto::obtenerConcepto($row['TIPO']);

        $canal = Canal::where('clave', trim($row['DIST']))->first();
        if (!$canal) { // Si no existe el canal, se crea.
            $sucursal_concepto = Concepto::obtenerConcepto('Cadena'); // Tod-os los canales que no existan, son cadenas.
            
            $estatus = Estatus::obtenerEstatus('Inactivo'); // Canal nuevo, nace con estatus inactivo.
            $opcs = [
                'clave' => $row['DIST'],
                'nombre' => 'CANAL ' . $row['DIST'],
                'tipo_concepto_id' => $sucursal_concepto->id,
                'estatus_id' => $estatus->id,
            ];
            $canal = Canal::obtenerCanal($opcs);
            // dd($canal,$sucursal_concepto->id);
        }


        // Se obtiene el vendedor.
        $opc = [
            'nombre' => $row['VENDEDOR'],
            'tlc_canal_id' => $canal->id,
            'login' => $canal->acox,
            'enabled' => 0,
        ];
        $vendedor = CanalVendedor::obtenerCanalVendedor($opc);

        $opcs = [
            'preactivacion' => $row['PREACTIVO'],
            'telefono_id' => $telefono->id,
            'tlc_canal_id' => $canal->id,
            'activacion' => $row['ACTIVO'],
            'primera_llamada' => $row['PRIMERA_LLAMADA'],
            'captura_dol' => $row['DOL'],
            'rep_venta' => $row['REP.VENTA'],
            'ing_tae' => ($row["ING_TA"] == 'SI' ? 1 : 0),
            'monto' => (float)$row['MONTO'],
            'imei_discreto_id' => $imei_id,
            'iccid_discreto_id' => $iccid_id,
            'tipo_concepto_id' => $concepto->id,
            'tlc_canal_vendedor_id' => $vendedor->id
        ];
        $activacion = Activacion::obtenerActivacion($opcs);
        return $activacion;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
