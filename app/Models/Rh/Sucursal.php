<?php

namespace App\Models\Rh;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    public function scopeSucursales($query)
    {
        return $query->leftJoin('telefonos', 'telefono_id', 'telefonos.id')
        ->leftJoin('direcciones', 'direccion_id', 'direcciones.id')
        ->leftJoin('ciudades', 'direcciones.ciudad_id', 'ciudades.id')
        ->leftJoin('estados', 'direcciones.estado_id', 'estados.id')
        ->leftJoin('municipios', 'direcciones.municipio_id', 'municipios.id')
        ->leftJoin('estatuses', 'estatus_id', 'estatuses.id')
        ->leftJoin('referencias', 'referencia_id', 'referencias.id')
        ->leftJoin('empleados', 'sucursales.id', 'empleados.sucursal_id')
        ->leftJoin('conceptos', 'tipo_concepto_id', 'conceptos.id')
        ->selectRaw('sucursales.id,sucursales.nombre as sucursal, conceptos.concepto as tipo ,telefonos.telefono,direcciones.calle,direcciones.numero_exterior,direcciones.numero_interior,direcciones.colonia,direcciones.codigo_postal,ciudades.ciudad,municipios.municipio,estados.estado,referencias.referencia,sucursales.ubicacion,estatuses.estatus,count(empleados.id) as empleados')
        ->groupBy('sucursales.id','sucursales.nombre','telefonos.telefono','direcciones.calle','direcciones.numero_exterior','direcciones.numero_interior','direcciones.colonia','direcciones.codigo_postal','ciudades.ciudad','municipios.municipio','estados.estado','referencias.referencia','sucursales.ubicacion','estatuses.estatus','conceptos.concepto')
        ->orderBy('conceptos.id','asc')
        ->orderBy('estatuses.id','asc')
        ->orderBy('sucursales.nombre','asc');

    }




    protected $fillable = [
        'id',
        'nombre',
        'telefono_id',
        'direccion_id',
        'estatus_id',
        'ubicacion'
    ];

    protected $hidden = [
        'telefono_id',
        'direccion_id',
        'estatus_id',        
        'created_at',
        'updated_at'
    ];
    
}
