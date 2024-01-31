<?php

namespace App\Models\Telcel;

use App\Models\Data\Estado;
use App\Models\Generales\Concepto;
use App\Models\Generales\Municipio;
use App\Models\Rh\Sucursal;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(Sucursal::class);
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
        return $this->hasMany(CanalVendedor::class,'tlc_canal_id','id');
    }

}
