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


    public function scopeCanalesAnual1($query, $year)
    {
        $results = $query->select('tlc_canales.clave', 'sucursales.nombre', DB::raw('count(*) as total'))
            ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
            ->join('sucursales', 'tlc_canales.sucursal_id', '=', 'sucursales.id')
            // ->join('nombres', 'sucursales.nombre_id', '=', 'nombres.id')
            ->whereYear('tlc_activaciones.preactivacion', $year)
            ->groupBy('tlc_canales.clave', 'sucursales.nombre')
            ->get();

            $totalActivaciones = $results->sum('total');

            $groupedResults = $results->groupBy('tlc_canales.clave')->map(function ($items, $clave) {
                return $items->mapWithKeys(function ($item) {
                    return [$item['nombre'] => $item['total']];
                });
            });
        
            return ['results' => $groupedResults, 'totalActivaciones' => $totalActivaciones];
        
    }

    public function scopeCanalesAnual($query, $year)
{
    $results = $query->select('sucursales.nombre', DB::raw('count(*) as total'))
                     ->join('tlc_canales', 'tlc_activaciones.tlc_canal_id', '=', 'tlc_canales.id')
                     ->leftJoin('sucursales', 'tlc_canales.sucursal_id', '=', 'sucursales.id')
                     ->whereYear('tlc_activaciones.preactivacion', $year)
                     ->groupBy('sucursales.nombre')
                     ->get();

    $totalActivaciones = number_format($results->sum('total'), 0, '.', ',');

    $groupedResults = $results->map(function ($item) {
        return ['sucursal' => ucfirst($item['nombre']), 'total' => number_format($item['total'], 0, '.', ',')];
    });

    return ['results' => $groupedResults, 'totalActivaciones' => $totalActivaciones];
}

    public function scopeMensual($query, $year, $tipofecha)
    {

        // Crear un array con todos los meses del año especificado
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $year . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
        }

        $results = $query->select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(' . $tipofecha . ', "%Y-%m") as month'))
            ->whereYear($tipofecha, $year)
            ->with(['concepto'])
            ->groupBy('tipo_concepto_id', 'month')
            ->get();

        return $results->groupBy('tipo_concepto_id')->map(function ($items, $tipo_concepto_id) use ($months) {
            $data = [];
            foreach ($months as $month) {
                $item = $items->firstWhere('month', $month);
                $data[] = $item ? $item->total : 0;
            }

            return [
                'id' => $tipo_concepto_id,
                'concepto' => $items->first()->concepto->concepto,
                'data' => $data
            ];
        })->values();
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
        $currentData = $currentResults->groupBy('tipo_concepto_id')->map(function ($item) use ($valores) {

            $conceptos = array_column($valores, 'concepto');
            $index = array_search($item->first()->concepto->concepto, $conceptos);
            $texto = $index !== false ? $valores[$index]['texto'] : '';

            return [
                'concepto' => $texto, //$item->first()->concepto->concepto,
                'total' => $item->sum('total')
            ];
        });

        $lastData = $lastResults->groupBy('tipo_concepto_id')->map(function ($item) use ($valores) {
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

    public function scopeAnualcompara($query)
    {
        // Obtén el mes y el año actual
        $currentYear = date('Y');
        $currentMonth = date('m');
        $currentDay = date('d');

        // Obtén el año anterior
        $lastYear =  $currentYear - 1;
        $lastYearDate = now()->subYear();

        // Realiza una consulta para obtener los datos del mes actual
        $currentResults = Activacion::select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(preactivacion, "%Y-%m") as month'))
            ->whereYear('preactivacion', $currentYear)
            // ->whereMonth('preactivacion', $currentMonth)
            ->with(['concepto'])
            ->groupBy('tipo_concepto_id', 'month')
            ->get();

        // Realiza una consulta para obtener los datos del mismo mes pero del año anterior
        $lastResults = Activacion::select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(preactivacion, "%Y-%m") as month'))
            ->whereYear('preactivacion', $lastYear)
            //  ->whereMonth('preactivacion', $currentMonth)
            //  ->whereDay('preactivacion','<=', $currentDay)
            ->where('preactivacion', '<=', $lastYearDate)
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
        $currentData = $currentResults->groupBy('tipo_concepto_id')->map(function ($item) use ($valores) {

            $conceptos = array_column($valores, 'concepto');
            $index = array_search($item->first()->concepto->concepto, $conceptos);
            $texto = $index !== false ? $valores[$index]['texto'] : '';

            return [
                'concepto' => $texto, //$item->first()->concepto->concepto,
                'total' => $item->sum('total')
            ];
        });

        $lastData = $lastResults->groupBy('tipo_concepto_id')->map(function ($item) use ($valores) {
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
}
