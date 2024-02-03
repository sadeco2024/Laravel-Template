<?php

namespace App\Models\Rh;

use App\Models\Telcel\Canal;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeUnitReverseLookup\Wizard;

class Sucursal extends Model
{
    use HasFactory;

    protected $table = 'sucursales';

    protected $guarded = ['id'];

    protected $fillable = [
        'nombre',
        'fecha_apertura',
        'telefono_id',
        'direccion_id',
        'tipo_concepto_id',
        'correo_id',
        'comentario_id',
        'estatus_id',
    ];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value)
        );
    }        



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
        ->selectRaw('sucursales.id,sucursales.nombre, conceptos.concepto as tipo ,telefonos.telefono,direcciones.calle,direcciones.numero_exterior,direcciones.numero_interior,direcciones.colonia,direcciones.codigo_postal,ciudades.ciudad,municipios.municipio,estados.estado,referencias.referencia,direcciones.ubicacion,estatuses.estatus')
        ->groupBy('sucursales.id','sucursales.nombre','telefonos.telefono','direcciones.calle','direcciones.numero_exterior','direcciones.numero_interior','direcciones.colonia','direcciones.codigo_postal','ciudades.ciudad','municipios.municipio','estados.estado','referencias.referencia','direcciones.ubicacion','estatuses.estatus','conceptos.concepto')
        ->orderBy('conceptos.id','asc')
        ->orderBy('estatuses.id','asc')
        ->orderBy('sucursales.nombre','asc');
    }

    public function telefono()
    {
        return $this->belongsTo('App\Models\Generales\Telefono', 'telefono_id');
    }

    public function direccion()
    {
        return $this->belongsTo('App\Models\Generales\Direccion', 'direccion_id');
    }
    public function estatus()
    {
        return $this->belongsTo('App\Models\Generales\Estatus', 'estatus_id');
    }
    public function empleados()
    {
        return $this->hasMany('App\Models\Rh\Empleado', 'sucursal_id');
    }
    public function getCuentaEmpleadosAttribute()
    {
        return $this->empleados()->count();
    }
    public function gerenteEmpleadoId()
    {
        return $this->belongsTo('App\Models\Rh\Empleado', 'gerente_empleado_id');        
    }
    public function supervisorEmpleadoId()
    {
        return $this->belongsTo('App\Models\Rh\Empleado', 'supervisor_empleado_id');        
    }
    public function encargadoEmpleadoId()
    {
        return $this->belongsTo('App\Models\Rh\Empleado', 'encargado_empleado_id');        
    }
    public function correo()
    {
        return $this->belongsTo('App\Models\Generales\Correo', 'correo_id');
    }
    

    public function tipo()
    {
        return $this->belongsTo('App\Models\Generales\Concepto', 'tipo_concepto_id');
    }

    public function comentario()
    {
        return $this->belongsTo('App\Models\Generales\Comentario', 'comentario_id');
    }

    // protected $with = ['telefono','direccion','estatus','empleados','tipo','gerenteEmpleadoId','correo','comentario'];
    
    public function tlcCanales()
    {
        return $this->hasMany(Canal::class, 'sucursal_id');
    }    

    protected $hidden = [
        'tipo_concepto_id',
        'telefono_id',
        'direccion_id',
        'correo_id',
        'comentario_id',
        'enabled',
        'estatus_id',        
        'created_at',
        'updated_at'
    ];
    
}
