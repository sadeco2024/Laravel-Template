<?php

namespace App\Models\telcel;

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

    public function scopeMensual2($query, $year, $month)
    {
        return $query->select('tipo_concepto_id', DB::raw('count(*) as total'))
            ->whereYear('fecha_preactivacion', $year)
            ->whereMonth('fecha_preactivacion', $month)
            ->groupBy('tipo_concepto_id');
    }

    public function scopeMensual3($query)
    {
        $date = Carbon::now()->subYear()->startOfMonth();

        return $query->select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(preactivacion, "%Y-%m") as month'))
        ->where('preactivacion', '>=', $date)->with(['concepto'])
        ->groupBy('tipo_concepto_id', 'month');        
    }

    public function scopeMensual4($query)
    {
        $date = Carbon::now()->subYear()->startOfMonth();
    
        $results = $query->select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(preactivacion, "%Y-%m") as month'))
                         ->where('preactivacion', '>=', $date)
                         ->with(['concepto'])
                         ->groupBy('tipo_concepto_id', 'month')
                         ->get();
    
        return $results->groupBy('month')->map(function ($items, $month) {
            return [
                'month' => $month,
                'data' => $items->map(function ($item) {
                    return [
                        'tipo_concepto' => $item->tipo_concepto_id,
                        'concepto' => $item->concepto->concepto,
                        'total' => $item->total
                    ];
                })->toArray()
            ];
        })->values();
    }    



    public function scopeMensual($query)
    {
        $year = '2024';
    
        // Crear un array con todos los meses del año especificado
        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = $year . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
        }
    
        $results = $query->select('tipo_concepto_id', DB::raw('count(*) as total'), DB::raw('DATE_FORMAT(preactivacion, "%Y-%m") as month'))
                         ->whereYear('preactivacion', $year)
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
        $currentMonth =date('m');
        $currentDay = date('d');
    
        // Obtén el año anterior
        $lastYear ='2023';
        // $currentYear - 1;
    
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
                             ->whereDay('preactivacion','<=', $currentDay)
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
        $currentData = $currentResults->groupBy('tipo_concepto_id')->map(function ($item) use($valores) {

            $conceptos = array_column($valores, 'concepto');
            $index = array_search($item->first()->concepto->concepto, $conceptos);
            $texto = $index !== false ? $valores[$index]['texto'] : '';

            return [
                'concepto' => $texto, //$item->first()->concepto->concepto,
                'total' => $item->sum('total')
            ];
        });
    
        $lastData = $lastResults->groupBy('tipo_concepto_id')->map(function ($item) use($valores) {
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
