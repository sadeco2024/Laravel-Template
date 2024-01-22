<?php

namespace App\Models\Rh;

use App\Models\Generales\Correo;
use App\Models\Generales\Direccion;
use App\Models\Generales\Estatus;
use App\Models\Generales\Nombre;
use App\Models\Generales\Rfc;
use App\Models\Generales\Telefono;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class Empleado extends Model
{
    use HasFactory;

    // protected $table = 'empleados';

    // protected $fillable = [
    //     'user_id',
    //     'nombre_id',
    //     'fecha_nacimiento',
    //     'fecha_ingreso',
    //     'genero',
    //     'telefono_id',
    //     'correo_id',
    //     'corpo_telefono_id',
    //     'corpo_correo_id',
    //     'rfc_id',
    //     'sucursal_id',
    //     'no_empleado',
    //     'direccion_id',
    //     'estatus_id',
    //     'enabled',
    //     'area_rh_extra_id',
    //     'puesto_rh_extra_id',
    //     'departamento_rh_extra_id',
    //     'tipo_contrato_rh_extra_id',
    //     'sueldo',
    //     'cuenta_banco',
    //     'observaciones',
    // ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'user_id',
        'nombre_id',
        'telefono_id',
        'correo_id',
        'corpo_telefono_id',
        'corpo_correo_id',
        'rfc_id',
        'sucursal_id',
        'estatus_id',
        'enabled',
        'created_at',
        'updated_at',
        'area_rh_extra_id',
        'puesto_rh_extra_id',
        'departamento_rh_extra_id',
        'tipo_contrato_rh_extra_id',
        'direccion_id'
    ];

    protected $with = [
        'user',
        'nombre',
        'telefono',
        'correo',
        'telefonoCorporativo',
        'correoCorporativo',
        'puesto',
        'departamento',
        'area',
        'tipoContrato',

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function nombre()
    {
        return $this->belongsTo(Nombre::class, 'nombre_id');
    }
    public function telefono()
    {
        return $this->belongsTo(Telefono::class, 'telefono_id');
    }
    public function correo()
    {
        return $this->belongsTo(Correo::class, 'correo_id');
    }
    public function telefonoCorporativo()
    {
        return $this->belongsTo(Telefono::class, 'corpo_telefono_id');
    }    
    public function correoCorporativo()
    {
        return $this->belongsTo(Correo::class, 'corpo_correo_id');
    }    
    public function rfc()
    {
        return $this->belongsTo(Rfc::class, 'rfc_id');
    }
    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'sucursal_id');
    }    
    public function estatus()
    {
        return $this->belongsTo(Estatus::class, 'estatus_id');
    }
    public function area()
    {
        return $this->belongsTo(Rhextra::class, 'area_rh_extra_id');
    }
    public function puesto()
    {
        return $this->belongsTo(Rhextra::class, 'puesto_rh_extra_id');
    }
    public function departamento()
    {
        return $this->belongsTo(Rhextra::class, 'departamento_rh_extra_id');
    }
    public function tipoContrato()
    {
        return $this->belongsTo(Rhextra::class, 'tipo_contrato_rh_extra_id');
    }
    public function direccion()
    {
        return $this->belongsTo(Direccion::class, 'direccion_id');
    }  
}
