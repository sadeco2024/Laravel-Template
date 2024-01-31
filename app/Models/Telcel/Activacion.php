<?php

namespace App\Models\telcel;

use App\Models\Erp\ArticuloDiscreto;
use App\Models\Generales\Concepto;
use App\Models\Generales\Telefono;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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



    protected $hidden = ['id','created_at', 'updated_at'];

    public function telefono()
    {
        return $this->belongsTo(Telefono::class);
    }

    public function imei()
    {
        return $this->belongsTo(ArticuloDiscreto::class);
    }

    public function iccid() {
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
}

