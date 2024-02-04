<?php

namespace App\Models\Telcel;

use App\Models\Data\Estado;
use App\Models\Generales\Concepto;
use App\Models\Generales\Municipio;
use App\Models\Rh\Sucursal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Canal extends Model
{
    use HasFactory;

    protected $table = 'tlc_canales';

    protected $guarded = ['id'];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'estado',
        'municipio',
    ];

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
        return $this->hasMany(CanalVendedor::class);
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
