<?php

namespace App\Models\Telcel;

use DateTime;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

class CanalVendedor extends Model
{
    use HasFactory;

    protected $table = 'tlc_canales_vendedores';

    protected $guarded = ['id'];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];




    public static function obtenerCanalVendedor($request)
    {
        return self::updateOrCreate(
            [
                'nombre' => preg_replace('/[^A-Za-z0-9 ]/', '', $request['nombre']),
                'tlc_canal_id' => $request['tlc_canal_id']
            ],
            [
                
                'login' => preg_replace('/[^0-9]/', '',$request['login']) ?? '00000',
                'logunico' => $request['logunico'] ?? '00000',
                'contrasena' => $request['contrasena'] ?? NULL,
                'calta' => $request['calta'] ?? NULL,
                'fecha_alta' => $request['fecha_alta'] ?? NULL,
                'enabled' => $request['enabled'] ?? 1,
            ]
        );
    }

    public function canal()
    {
        return $this->belongsTo(Canal::class);
    }
}
