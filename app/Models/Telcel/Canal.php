<?php

namespace App\Models\Telcel;

use App\Models\Data\Estado;
use App\Models\Generales\Concepto;
use App\Models\Generales\Municipio;
use App\Models\Rh\Sucursal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Static_;

class Canal extends Model
{
    use HasFactory;

    protected $table = 'tlc_canales';

    protected $guarded = ['id'];

    protected $hidden = [
        'contrasena',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'estado',
        'municipio',
    ];

    //? Metodo para crear/actualizar un canal.
    public static function obtenerCanal($request)
    {
        return self::updateOrCreate(
            ['clave' => trim($request['clave'])],
            [
                'nombre' => trim($request['nombre'] ?? 'CANAL ' . $request['clave']),
                'activa' => $request['activa'] ?? 0,
                'acox' => $request['acox'] ?? rand(10000, 99999),
                'sucursal_id' => $request['sucursal_id'] ?? 1,
                'tipo_concepto_id' => $request['tipo_concepto_id'] ?? NULL,
                'municipio_id' => $request['municipio_id'] ?? NULL,
                'enabled' => $request['enabled'] ?? 1,
                'estatus_id' => $request['estatus_id']
            ]
        );
    }

    //? Metodo para obtener los datos de todos los canales y agregarlos a un DataTable
    public static function canalesDatatable()
    {
        return self::with(['concepto', 'sucursal', 'sucursal.empleados'])
            ->get()
            ->map(function ($canal) {
                $canal->ruta_editar = route('telcel.canales.edit', $canal->id);
                return $canal;
            });
    }

    //? Metodo para obtener los datos de un canal en especifico y agregarlo a un DataTable
    public function canalDatatable($id)
    {
        return self::with(['concepto', 'sucursal', 'sucursal.empleados'])
            ->where('id', $id)
            ->get()
            ->map(function ($canal) {
                $canal->ruta_editar = route('telcel.canales.edit', $canal->id);
                return $canal;
            })
            ->first();
    }




/*
    Quiero crear en el modelo canales, un scopeReporteMensual($mes), que obtendrá todas las activaciones del mes que se le manda en la variable, también debherá traer la cantidad de activaciones del año pasado, el mismo mes. Deberá comprobar igual, que el vendedor (tlc_canales_vendedores), pertenece a un canal (tlc_canales) con el tipo_concepto_id=9, sino no lo toma en la sumatoria
*/

    public function scopeCanalVendedores($query)
    {
        return $query->where('enabled', 1)->where('tipo_concepto_id', 9)
            ->with(['concepto', 'sucursal', 'vendedores' => function ($query) {
                $query->select('id', 'nombre', 'logunico', 'tlc_canal_id');
            }])->get()->filter(function ($canal) {
                return $canal->vendedores->count() > 0;
            })->map(function ($canal) {
                return [
                    'clave' => $canal->clave,
                    'concepto' => $canal->concepto->concepto,
                    'sucursal' => $canal->sucursal->nombre,
                    'total' => $canal->vendedores->count(),
                    'url_edit' => route('telcel.canales.edit', $canal->id),
                    'vendedores' => $canal->vendedores,
                ];
            });
    }

    public function scopeVerVendedores($query)
    {
        return $query->where('enabled', 1)
        ->with(['vendedores' => function ($query) {
            $query->select('id', 'nombre', 'logunico', 'tlc_canal_id');
        }, 'concepto'])
        ->orderBy('tipo_concepto_id')
        ->get()
        ->map(function ($canal) {
            $vendedores = $canal->vendedores->map(function ($vendedor) {
                return $vendedor->logunico !== '00000' ? $vendedor->logunico : $vendedor->nombre;
            })->join(', ');
            return [
                'canal' => $canal->clave,
                'sucursal' => $canal->sucursal->nombre,
                'vendedores' => $vendedores,
                'concepto' => $canal->concepto->concepto ?? '',
                'url_edit' => route('telcel.canales.edit', $canal->id),
            ];
        })->filter(function ($canal) {
            return !empty($canal['vendedores']);
        });
    }

    public function scopeVerVendedoresCadenas($query)
    {
        return $query->where('enabled', 1)->where('tipo_concepto_id', 14)
        ->with(['vendedores' => function ($query) {
            $query->select('id', 'nombre', 'logunico', 'tlc_canal_id');
        }])->get()->map(function ($canal) {
            $vendedores = $canal->vendedores->map(function ($vendedor) {
                return $vendedor->logunico !== '00000' ? $vendedor->logunico : $vendedor->nombre;
            })->join(', ');
            return [
                'canal' => $canal->clave,
                'sucursal' => $canal->sucursal->nombre,
                'vendedores' => $vendedores,
                'url_edit' => route('telcel.canales.edit', $canal->id),
            ];
        })->filter(function ($canal) {
            return !empty($canal['vendedores']);
        });
    }    


    public function concepto()
    {
        return $this->hasOne(Concepto::class, 'id', 'tipo_concepto_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }

    public function sucursales()
    {
        return $this->hasMany(Sucursal::class);
    }

    public function vendedores()
    {
        return $this->hasMany(CanalVendedor::class, 'tlc_canal_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function rcox()
    {
        return $this->hasMany(CanalVendedor::class, 'tlc_canal_id', 'id');
    }

    public function scopeCanalTienda($query)
    {
        // return $query->select('sucursales.nombre as sucursal', DB::raw('count(*) as canales'), DB::raw('GROUP_CONCAT(tlc_canales.clave SEPARATOR ",") as listado'))
        //     ->join('sucursales', 'sucursales.id', '=', 'tlc_canales.sucursal_id')
        //     // ->where('sucursales.id', $sucursal_id)
        //     ->groupBy('sucursales.nombre')
        //     ->get();

        $sucursales = $query->select('sucursales.nombre as sucursal', DB::raw('count(*) as canales'), DB::raw('GROUP_CONCAT(tlc_canales.clave SEPARATOR ", ") as listado'))
            ->join('sucursales', 'sucursales.id', '=', 'tlc_canales.sucursal_id')
            ->groupBy('sucursales.nombre')
            ->get();

        $abreviaturas = [];
        $result = [];

        foreach ($sucursales as $sucursal) {
            $nombre = $sucursal->sucursal;
            $palabras = explode(' ', $nombre);
            $abreviatura = '';
            $preposiciones = ['la', 'de', 'las'];

            foreach ($palabras as $palabra) {
                if (!in_array(strtolower($palabra), $preposiciones)) {
                    $abreviatura .= substr($palabra, 0, 1);
                }
            }

            $i = 1;
            while (in_array($abreviatura, $abreviaturas) && $i < strlen($palabras[0])) {
                $abreviatura = substr($palabras[0], 0, 1) . substr($palabras[0], $i, 1);
                $i++;
            }

            $abreviaturas[] = $abreviatura;
            $result[] = ['sucursal' => $nombre, 'canales' => $sucursal->canales, 'abreviatura' => strtoupper($abreviatura), 'listado' => $sucursal->listado];
        }
        return $result;
    }
}
