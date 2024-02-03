<?php

namespace App\Http\Controllers\Telcel;

use App\Http\Controllers\Controller;
use App\Models\Erp\ArticuloDiscreto;
use App\Models\Generales\Concepto;
use App\Models\Generales\Estatus;
use App\Models\Generales\Telefono;
use App\Models\telcel\Activacion;
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
        
        // return $request->all();
        $data = $this->scrap->getActivaciones(1,$request->fecha_inicial, $request->fecha_final); 
        
        if ($data['status']!==0) {
            // TODO: se regresa el json del error.
            return $data;
        }
        
        // $file = "activaciones_01012024_al_05012024_acox17274.csv";
        $file = $data['data']['file'];
        $csvFile = $this->readCSv($file);
        $path = storage_path('app/' . $file);

        foreach ($csvFile as $row) {
            $telefono = Telefono::firstOrCreate(['telefono'=> $row['MSISDN']]);
            $imei = strpos($row['IMEI'],"*") !== FALSE ?  NULL : ArticuloDiscreto::firstOrCreate(['serie'=> $row['IMEI']])->id;
            $iccid = strpos($row['ICCID'],"*") !== FALSE ? NULL : ArticuloDiscreto::firstOrCreate(['serie'=> $row['ICCID'],'long'=>18])->id;
            $concepto = Concepto::firstOrCreate(['concepto'=>trim($row['TIPO'])]);
            
            try {
                $canal = Canal::firstOrCreate(
                    ['clave' => trim($row['DIST'])], // columnas y valores a buscar
                    [
                        'nombre' => 'CANAL ' . trim($row['DIST']),
                        'activa' => 0,
                        'acox' => rand(10000, 99999),
                        'sucursal_id' => 1,
                        'estatus_id' => Estatus::firstOrCreate(['estatus' => 'Inactivo'])->id,
                    ]
                );
            } catch (Exception $e) {
                die('Error canal:' . $e->getMessage());
            }

            try {
                $vendedor = CanalVendedor::firstOrCreate(
                    [
                        'tlc_canal_id' => $canal->id,
                        'nombre' => preg_replace('/[^A-Za-z0-9 ]/', '', $row['VENDEDOR'])
                    ], // columnas y valores a buscar
                    [
                        'login'=> $canal->acox, 
                        'logunico'=> rand(10000, 99999),              
                        'enabled'=> 0,
                    ]);
            } catch (Exception $e) {
                die('Error vendedor:' . $e->getMessage());
            }

            
            $fechasLabel = ['PREACTIVO','ACTIVO','PRIMERA_LLAMADA','DOL','REP.VENTA'];
            $fechas = collect();
            try {
                foreach ($fechasLabel as $label) {
                    if (!empty($row[$label]) && $date = Date::createFromFormat('m/d/Y', $row[$label])) {
                        $fechas ->push($date->format('Y-m-d'));
                    } else {
                        // manejar el caso en que $row['DOL'] no es una fecha válida
                        $fechas ->push(null);
                    }                
                }
            } catch (Exception $e) {
                die('Error fechas:' . $e->getMessage());
            }
            // dd($row,$fechas);
            // dd($row);
            try {
                $activacion = Activacion::updateOrCreate(
                    [
                        'preactivacion' => $fechas[0],
                        'telefono_id' => $telefono->id,
                        'tlc_canal_id' => $canal->id,
                    ],
                    [
                    'activacion' => $fechas[1],
                    'primera_llamada' => $fechas[2],
                    'captura_dol' => $fechas[3],
                    'rep_venta' => $fechas[4],
                    'ing_tae'=>($row["ING_TA"]== 'SI' ? 1 : 0),
                    'monto'=>(float)$row['MONTO'],
                    'pagado'=>0,
                    'imei_discreto_id' => $imei,
                    'iccid_discreto_id' => $iccid,
                    'tipo_concepto_id' => $concepto->id,
                    'tlc_canal_vendedor_id' => $vendedor->id
                ]);

            } catch (Exception $e) {
                die('Error activacion:' . $e->getMessage());
            }
            
        }
        // dd( $data);
        // session()->flash('success', 'Activaciones descargadas.');
        // $data['table'] =["tblDescActivaciones"=> $data['data']['Registros']];
        // $data["table"] = ["tblDescActivaciones"=>['fecha_inicial'=>$request->fecha_inicial,'fecha_final'=>$request->fecha_final,'registros'=>$data['data']['Registros']]];
        // return $data;

        $array = [
            "tblDescActivaciones" => [
                'fecha_inicial' => $request->fecha_inicial,
                'fecha_final' => $request->fecha_final,
                'registros' => $data['data']['Registros']
            ]
        ];

        return response()->json([
            'redirect' => route('telcel.activaciones.index'), // 'redirect' => 'http://localhost:8000/telcel/activaciones
            'alert' => 'Activaciones descargadas.',
            'table'=>$array
        ]);


        


        $canales = Canal::all();
        return $canales;
    }

    public function readCSV($file)
    {
        // $file = 'activaciones_01012024_al_10012024_acox17274.csv';
        $path = storage_path('app/' . $file);

        if (Storage::exists($file)) {
            $csv = Reader::createFromPath($path, 'r');
            $csv->setHeaderOffset(0); // La primera fila es el encabezado

            $records = $csv->getRecords(); // Obtener todos los registros

            $data = [];
            foreach ($records as $record) {
                $data[] = $record;
            }
            
            return $data;
        } else {
            // El archivo no existe en el almacenamiento
            return [];
        }

        return [];
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
