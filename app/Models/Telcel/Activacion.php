<?php

namespace App\Models\Telcel;

use App\Models\Erp\ArticuloDiscreto;
use App\Models\Generales\Concepto;
use App\Models\Generales\Telefono;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activacion extends Model
{
    use HasFactory;

    protected $table = 'tlc_activaciones';

    protected $fillable = [
        'preactivacion',
        'activacion',
        'primer_llamada',
        'captura_dol',
        'rep_venta',
        'ing_tae',
        'monto',
        'pagado',
        'telefono_id',
        'imei_discreto_id',
        'iccid_discreto_id',
        'tipo_concepto_id',
        'tlc_canal_id',
        'tlc_canal_vendedor_id',
    ];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    //? Metodo para crear/actualizar una activacion.
    public static function obtenerActivacion($request)
    {


        //? Cuando las manda directamende desde el archivo de descarga de telcel, se tienen que convertir las fechas.
        $preactivacion = $request['preactivacion'] ? Carbon::createFromFormat('m/d/Y', $request['preactivacion'])->format('Y-m-d') : null;
        $activacion = $request['activacion'] ? Carbon::createFromFormat('m/d/Y', $request['activacion'])->format('Y-m-d') : null;
        $primer_llamada = $request['primera_llamada'] ? Carbon::createFromFormat('m/d/Y', $request['primera_llamada'])->format('Y-m-d') : null;
        $captura_dol = $request['captura_dol'] ? Carbon::createFromFormat('m/d/Y', $request['captura_dol'])->format('Y-m-d') : null;
        $rep_venta = $request['rep_venta'] ? Carbon::createFromFormat('m/d/Y', $request['rep_venta'])->format('Y-m-d') : null;


        return self::updateOrCreate(
            [
                'preactivacion' => $preactivacion,
                'telefono_id' => $request['telefono_id'],
                'tlc_canal_id' => $request['tlc_canal_id'],
            ],
            [
                'activacion' => $activacion,
                'primera_llamada' => $primer_llamada,
                'captura_dol' => $captura_dol,
                'rep_venta' => $rep_venta,
                'ing_tae' => $request['ing_tae'],
                'monto' => $request['monto'],
                'pagado' => $request['pagado'] ?? 0,
                'imei_discreto_id' => $request['imei_discreto_id'] ?? NULL,
                'iccid_discreto_id' => $request['iccid_discreto_id'] ?? NULL,
                'tipo_concepto_id' => $request['tipo_concepto_id'],
                'tlc_canal_vendedor_id' => $request['tlc_canal_vendedor_id']
            ]
        );
    }


    public function scopeDiario($query, $opcs)
    {
        /*
        $opcs = [
            'mes' => 1,
            'anio' => 2021,
            'tipo_fecha' => 'preactivacion'
        ];
        */
        extract($opcs);
        // Obtener el año actual y el anterior
        $anioActual = (int)$anio;
        $anioAnterior = $anioActual - 1;
        $tipo_fecha = $tipofecha; // 'preactivacion';

        // Obtener las activaciones del mes actual y del mismo mes del año anterior
        $activaciones = $query->select(DB::raw("DAY($tipo_fecha) as dia"), DB::raw("YEAR($tipo_fecha) as anio"), 'tlc_canales.tipo_concepto_id', DB::raw('COUNT(*) as total'))
            ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
            ->whereIn(DB::raw("MONTH($tipo_fecha)"), [$mes])
            ->whereIn(DB::raw("YEAR($tipo_fecha)"), [$anioActual, $anioAnterior])
            ->groupBy('anio', 'dia', 'tlc_canales.tipo_concepto_id')
            ->get();

        // Inicializar el array de resultados
        $resultados = [];


        foreach ($resultados as $resultado) {
            $name = $resultado->name;

            if (!isset($formato[$name])) {
                $formato[$name] = [
                    "tipo_concepto_id" => $resultado->tipo_concepto_id,
                    "concepto" => $resultado->concepto,
                    "name" => $name,
                    "data" => []
                ];
            }

            array_push($formato[$name]['data'], $resultado->data);
        }

        // Formatear los resultados
        foreach ($activaciones as $activacion) {

            $anio = $activacion->anio;
            $indice = $anio == $anioActual ? $anioActual : $anio;

            // $name = $activaciones->name;
            if (!isset($resultados[$indice . $activacion->tipo_concepto_id])) {
                $resultados[$indice . $activacion->tipo_concepto_id] = [
                    "tipo_concepto_id" => $activacion->tipo_concepto_id,
                    "concepto" => $activacion->concepto->concepto,
                    "name" => $indice,
                    "data" => []
                ];
            }

            $dia = $activacion->dia;
            $total = $activacion->total;

            // Obtener la longitud del array de días según el año
            $diasArrayLength = $anio == $anioActual ? date('t') : date('t', mktime(0, 0, 0, $mes, 1, $anioAnterior));

            // Rellenar el array de días con 0s
            $resultados[$indice . $activacion->tipo_concepto_id]['data'] = array_pad($resultados[$indice . $activacion->tipo_concepto_id]['data'], $diasArrayLength, 0);

            // Asignar el total al día correspondiente
            $resultados[$indice . $activacion->tipo_concepto_id]['data'][$dia - 1] = $total;
        }
        return $resultados;
    }

    public function scopeMensualPorProducto($query, $opcs)
    {
        /*
        $opcs = [
            'mes' => 1,
            'anio' => 2021,
            'tipo_fecha' => 'preactivacion'
        ];
        */
        extract($opcs);


        // Obtener el año actual y el anterior
        $anioActual = (int)$anio;
        $anioAnterior = $anioActual - 1;
        $tipo_fecha = $tipofecha;

        // Obtener las activaciones del mes actual y del mismo mes del año anterior
        $activaciones = $query->select(DB::raw("MONTH($tipo_fecha) as mes"), DB::raw("YEAR($tipo_fecha) as anio"), 'tactivaciones.concepto as tipo_activa', DB::raw('COUNT(*) as total'))
            ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
            ->join('conceptos as tactivaciones', 'tlc_activaciones.tipo_concepto_id', '=', 'tactivaciones.id')
            ->join('conceptos as tipo', 'tlc_canales.tipo_concepto_id', '=', 'tipo.id')
            ->where('tipo.concepto', '<>', 'Cadena')
            ->whereIn(DB::raw("MONTH($tipo_fecha)"), [$mes])
            ->whereIn(DB::raw("YEAR($tipo_fecha)"), [$anioActual, $anioAnterior])
            ->groupBy('anio', 'mes', 'tactivaciones.concepto')
            ->orderBy('anio', 'desc')
            ->orderBy('tipo_activa', 'desc')
            ->get();

        // Inicializar el array de resultados
        $resultados = [];

        $activaciones = $activaciones->toArray();
        foreach ($activaciones as $activacion) {
            $resultados[$activacion['anio']][] = [
                'tipo_activa' => $activacion['tipo_activa'],
                'total' => $activacion['total']
            ];
        }
        return $resultados;
    }

    //? Metodo para obtener los datos por mes de todas las activaciones
    // public function scopeGraficaAnual($query, $year, $tipofecha,$cadenas=false)
    public function scopeGraficaAnual($query, $opcs)
    {
        extract($opcs);
        // Crear un array con todos los meses del año especificado
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $anio . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        $results = $query->select('tipo_canal.concepto as tipo', 'tlc_activaciones.tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(' . $tipofecha . ', "%Y-%m") as month'))
            ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
            ->join('conceptos as tipo_canal', 'tlc_canales.tipo_concepto_id', '=', 'tipo_canal.id')
            ->whereYear($tipofecha, $anio)
            ->with(['concepto'])
            ->groupBy('tipo_canal.concepto', 'tlc_activaciones.tipo_concepto_id', 'month')
            ->get();
        return  $results->filter(function ($result) use ($cadenas) {
            if ($cadenas)
                return  $result->tipo === 'Cadena';
            else
                return $result->tipo !== 'Cadena';
        })->groupBy('tipo_concepto_id')->map(function ($items, $tipo_concepto_id) use ($months) {
            $data = [];
            foreach ($months as $month) {
                $itemsOfMonth = $items->where('month', $month);
                // echo "<br>Items: $month", json_encode($itemsOfMonth);
                $totalOfMonth = $itemsOfMonth->sum('total');
                $data[] = $totalOfMonth;
            }

            return [
                'id' => $tipo_concepto_id,
                'concepto' => $items->first()->concepto->concepto,
                'data' => $data
            ];
        })->values();
    }


    public function telefono()
    {
        return $this->belongsTo(Telefono::class);
    }

    public function imei()
    {
        return $this->belongsTo(ArticuloDiscreto::class);
    }

    public function iccid()
    {
        return $this->belongsTo(ArticuloDiscreto::class);
    }

    public function concepto()
    {
        return $this->belongsTo(Concepto::class, 'tipo_concepto_id');
    }

    public function canal()
    {
        return $this->belongsTo(Canal::class, 'tlc_canal_id');
    }

    public function vendedor()
    {
        return $this->belongsTo(CanalVendedor::class, 'tlc_canal_vendedor_id');
    }

    public function scopeFecha($query, $fecha_inicio, $fecha_fin)
    {
        return $query->whereBetween('fecha', [$fecha_inicio, $fecha_fin]);
    }




    public function scopeCanalesAnual($query, $opcs)
    {

        /*
        $opcs = [
            'mes' => 1,
            'anio' => 2021,
            'tipo_fecha' => 'preactivacion'
        ];
        */
        extract($opcs);

        $results = $query->select('sucursales.nombre', DB::raw('count(*) as total'))
            ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
            ->leftJoin('sucursales', 'tlc_canales.sucursal_id', '=', 'sucursales.id')
            ->whereYear('tlc_activaciones.preactivacion', $anio)
            ->groupBy('sucursales.nombre')
            ->get();

        $totalActivaciones = number_format($results->sum('total'), 0, '.', ',');

        $groupedResults = $results->map(function ($item) {
            return ['sucursal' => ucfirst($item['nombre']), 'total' => number_format($item['total'], 0, '.', ',')];
        });

        return ['results' => $groupedResults, 'totalActivaciones' => $totalActivaciones];
    }



    public function scopeMescompara($query)
    {
        // Obtén el mes y el año actual
        $currentYear = date('Y');
        $currentMonth = date('m');
        $currentDay = date('d');

        // Obtén el año anterior
        $lastYear =  $currentYear - 1;


        // Realiza una consulta para obtener los datos del mes actual
        $currentResults = Activacion::select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(preactivacion, "%Y-%m") as month'))
            ->whereYear('preactivacion', $currentYear)
            ->whereMonth('preactivacion', $currentMonth)
            ->with(['concepto'])
            ->groupBy('tipo_concepto_id', 'month')
            ->get();

        // Realiza una consulta para obtener los datos del mismo mes pero del año anterior
        $lastResults = Activacion::select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(preactivacion, "%Y-%m") as month'))
            ->whereYear('preactivacion', $lastYear)
            ->whereMonth('preactivacion', $currentMonth)
            ->whereDay('preactivacion', '<=', $currentDay)
            ->with(['concepto'])
            ->groupBy('tipo_concepto_id', 'month')
            ->get();

        // dd($currentYear,$lastYear,$currentMonth,$currentResults,$lastResults);
        $valores = [
            ["concepto" => "Chip Express", "texto" => "Chips"],
            ["concepto" => "Chip Port IN", "texto" => "Portas"],
            ["concepto" => "KIT Sin Limite", "texto" => "Kit SL"],
            ["concepto" => "Chip Cobro x Seg", "texto" => "ChipXseg"],
            ["concepto" => "Amigo Chip", "texto" => "A.Chip"],
            ["concepto" => "TIP Kit", "texto" => "TIP"],
            ["concepto" => "KIT", "texto" => "Kits"],
            ["concepto" => "ERROR", "texto" => "Error"]
        ];


        // Agrupa los resultados por concepto
        $currentData = $currentResults->groupBy('tipo_concepto_id')->map(function ($item)  {

            $conceptos = array_column($valores, 'concepto');
            $index = array_search($item->first()->concepto->concepto, $conceptos);
            $texto = $index !== false ? $valores[$index]['texto'] : '';

            return [
                'concepto' => $texto, //$item->first()->concepto->concepto,
                'total' => $item->sum('total')
            ];
        });

        $lastData = $lastResults->groupBy('tipo_concepto_id')->map(function ($item)  {
            $conceptos = array_column($valores, 'concepto');
            $index = array_search($item->first()->concepto->concepto, $conceptos);
            $texto = $index !== false ? $valores[$index]['texto'] : '';
            return [
                'concepto' =>  $texto, //$item->first()->concepto->concepto,
                'total' => $item->sum('total')
            ];
        });

        return [
            'current' => $currentData,
            'last' => $lastData
        ];
    }

    public function scopeAnualcompara($query, $opcs)
    {

        /*
        $opcs = [
            'mes' => 1,
            'anio' => 2021,
            'tipofecha' => 'preactivacion'
        ];
        */
        extract($opcs);

        // Obtén el mes y el año actual
        $currentYear = $anio; //date('Y');
        $currentMonth = date('m');
        $currentDay = date('d');

        // Obtén el año anterior
        $lastYear =  $currentYear - 1;
        $lastYearDate = now()->year($currentYear)->subYear(); //now()->subYear();
        // dd($lastYearDate);

        // Realiza una consulta para obtener los datos del mes actual
        $currentResults = Activacion::select('tlc_activaciones.tipo_concepto_id', DB::raw('count(*) as total'), DB::raw("DATE_FORMAT($tipofecha, '%Y-%m') as month"))
            ->whereYear($tipofecha, $currentYear)
            ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
            ->join('conceptos as tipo_canal', 'tlc_canales.tipo_concepto_id', '=', 'tipo_canal.id')
            ->with(['concepto'])
            ->where('tipo_canal.concepto', '<>', 'Cadena')
            ->groupBy('tlc_activaciones.tipo_concepto_id', 'month')
            ->get();

        // Realiza una consulta para obtener los datos del mismo mes pero del año anterior
        if ($currentYear == date('Y'))
            $lastResults = Activacion::select('tlc_activaciones.tipo_concepto_id', DB::raw('count(*) as total'), DB::raw("DATE_FORMAT($tipofecha, '%Y-%m') as month"))
                ->whereYear($tipofecha, $lastYear)
                ->where($tipofecha, '<=', $lastYearDate)
                ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
                ->join('conceptos as tipo_canal', 'tlc_canales.tipo_concepto_id', '=', 'tipo_canal.id')
                ->with(['concepto'])
                ->where('tipo_canal.concepto', '<>', 'Cadena')
                ->groupBy('tlc_activaciones.tipo_concepto_id', 'month')
                ->get();
        else
            $lastResults = Activacion::select('tlc_activaciones.tipo_concepto_id', DB::raw('count(*) as total'), DB::raw("DATE_FORMAT($tipofecha, '%Y-%m') as month"))
                ->whereYear($tipofecha, $lastYear)
                ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
                ->join('conceptos as tipo_canal', 'tlc_canales.tipo_concepto_id', '=', 'tipo_canal.id')
                ->with(['concepto'])
                ->where('tipo_canal.concepto', '<>', 'Cadena')
                ->groupBy('tlc_activaciones.tipo_concepto_id', 'month')
                ->get();

        // dd($currentYear,$lastYear,$currentMonth,$currentResults,$lastResults);
        // $valores = [
        //     ["concepto" => "Chip Express", "texto" => "Chips"],
        //     ["concepto" => "Chip Port IN", "texto" => "Portas"],
        //     ["concepto" => "KIT Sin Limite", "texto" => "Kit SL"],
        //     ["concepto" => "Chip Cobro x Seg", "texto" => "ChipXseg"],
        //     ["concepto" => "Amigo Chip", "texto" => "A.Chip"],
        //     ["concepto" => "TIP Kit", "texto" => "TIP"],
        //     ["concepto" => "KIT", "texto" => "Kits"],
        //     ["concepto" => "ERROR", "texto" => "Error"]
        // ];


        // Agrupa los resultados por concepto
        $currentData = $currentResults->groupBy('tipo_concepto_id')->map(function ($item)  {
            // $conceptos = array_column($valores, 'concepto');
            // $index = array_search(trim($item->first()->concepto->concepto), $conceptos);
            // $texto = $index !== false ? $valores[$index]['texto'] : '';
            return [
                'concepto' => $item->first()->concepto->concepto,//$texto,
                'total' => $item->sum('total')
            ];
        });
        $lastData = $lastResults->groupBy('tipo_concepto_id')->map(function ($item)  {
            // $conceptos = array_column($valores, 'concepto');
            // $index = array_search(trim($item->first()->concepto->concepto), $conceptos);
            // $texto = $index !== false ? $valores[$index]['texto'] : '';
            return [
                'concepto' =>$item->first()->concepto->concepto,//  $texto,
                'total' => $item->sum('total')
            ];
        });

        return [
            $currentYear => $currentData,
            $lastYear => $lastData
        ];
    }
}
