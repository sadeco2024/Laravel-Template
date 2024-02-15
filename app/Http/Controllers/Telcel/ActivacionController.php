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

class ActivacionController extends Controller
{

    // protected $scrap;
    

    // public function __construct(Telcel $browser)
    // {
    //     $this->scrap = $browser;
        
    // }    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $activaciones = Activacion::graficaAnual(2022)->get();


        // $activaciones = Activacion::graficaAnual(date('Y'),'preactivacion');
        // echo json_encode($activaciones);
        // dd($activaciones);

        // $compara = Activacion::anualcompara();
        return view('telcel.activaciones.index');
    }

    public function grafica(Request $request) {
        if ($request->input('sucursal') !=0) {
            $canales = Canal::where('sucursal_id',$request->input('sucursal'))->pluck('id')->join(',');
        } else {
            $canales = 0;
        }

        $opcs = [
            'anio'=> $request->input('anio') ?? date('Y'),
            'tipofecha'=> $request->input('tipofecha') ?? 'preactivacion',
            'cadenas'=>$request->input('cadenas') ?? false,
            'sucursal'=>$canales,
        ];
        $activaciones = Activacion::graficaAnual($opcs);
        return response()->json($activaciones);
        
    }

    public function graficaDiario(Request $request) {
        if ($request->input('sucursal') !=0) {
            $canales = Canal::where('sucursal_id',$request->input('sucursal'))->pluck('id')->join(',');
        } else {
            $canales = 0;
        }        
        $opcs = [
            'anio'=> $request->input('anio') ?? date('Y'),
            'mes'=> $request->input('mes') ?? date('m'),
            'tipofecha'=> $request->input('tipofecha') ?? 'preactivacion',
            'sucursal'=>$canales,
        ];
        $activaciones = Activacion::graficaMensual($opcs);
        return response()->json($activaciones);
        
    }

    public function resumen(Request $request) {
        $opcs = [
            'anio'=> $request->input('anio') ?? date('Y'),
            'mes'=> $request->input('mes') ?? date('m'),
            'tipofecha'=> $request->input('tipofecha') ?? 'preactivacion',
        ];
        $activaciones = Activacion::CanalesAnual($opcs);
        return response()->json($activaciones);
    }

    public function compara(Request $request) {
        // dd($request->all());
        if ($request->input('sucursal') !=0) {
            $canales = Canal::where('sucursal_id',$request->input('sucursal'))->pluck('id')->join(',');
            $canales = $canales=="" ? 999 : $canales; // Se manda con 0, porque si necesita sucursal, para que no tome todos los valores.
            
        } 
        $opcs = [
            'anio'=> $request->input('anio') ?? date('Y'),
            'mes'=> $request->input('mes') ?? date('m'),
            'tipofecha'=> $request->input('tipofecha') ?? 'preactivacion',
            'sucursal'=>$canales ?? NULL //$request->input('sucursal') ?? NULL
        ];
        
        $activaciones = Activacion::anualcompara($opcs);
        return response()->json($activaciones);
        return $activaciones;
    }

    public function comparaDiario(Request $request) {
        if ($request->input('sucursal') !=0) {
            $canales = Canal::where('sucursal_id',$request->input('sucursal'))->pluck('id')->join(',');
        } else {
            $canales = 0;
        }
        $opcs = [
            'anio'=> $request->input('anio') ?? date('Y'),
            'mes'=> $request->input('mes') ?? date('m'),
            'tipofecha'=> $request->input('tipofecha') ?? 'preactivacion',
            'sucursal'=>$canales,
        ];
        $activaciones = Activacion::MensualPorProducto($opcs);
        return response()->json($activaciones);
        return $activaciones;        
    }


    public function download(Request $request)
    {
        // $data = $this->scrap->getActivaciones(); 
        // $data = $this->scrap->getActivaciones($request->input('fecha_inicio'), $request->input('fecha_fin'));
        
        $file = 'activaciones_01012024_al_10012024_acox17274.csv';
        $data = $this->readCSV($file);
        $path = storage_path('app/' . $file);

        foreach ($data as $row) {
            
            $telefono = Telefono::firstOrCreate(['telefono'=> $row['MSISDN']]);
            $imei = ArticuloDiscreto::firstOrCreate(['serie'=> $row['IMEI']]);
            $iccid = ArticuloDiscreto::firstOrCreate(['serie'=> $row['ICCID'],'long'=>18]);
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
            foreach ($fechasLabel as $label) {
                if (!empty($row[$label]) && $date = Date::createFromFormat('m/d/Y', $row[$label])) {
                    $fechas ->push($date->format('Y-m-d'));
                } else {
                    // manejar el caso en que $row['DOL'] no es una fecha válida
                    $fechas ->push(null);
                }                
            }
            // dd($row,$fechas);
            
            try {
                $activacion = Activacion::FirstOrcreate(
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
                    'ing_tae'=>0,
                    'monto'=>0,
                    'pagado'=>0,
                    'imei_discreto_id' => $imei->id,
                    'iccid_discreto_id' => $iccid->id,
                    'tipo_concepto_id' => $concepto->id,
                    'tlc_canal_vendedor_id' => $vendedor->id
                ]);

            } catch (Exception $e) {
                die('Error activacion:' . $e->getMessage());
            }
            // dd($row);
        }

        dd( $data);

        
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
