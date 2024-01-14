<?php

namespace App\Models\Rh;

use App\Models\Generales\Nombre;
use App\Models\Generales\Telefono;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;

class Empleado extends Model
{
    use HasFactory;

    // protected $table = 'empleados';

    protected $fillable = [
        'user_id',
        'nombre_id',
        'telefono_id',
        'fecha_nacimiento',
        'fecha_ingreso',
        'corpo_telefono_id',
        'no_empleado',
        'jefe_user_id',
        'puesto_id',
        'sucursal_id',
        'estatus_id'
    ];

    // public function scopeEmpleados($query) {
        
    //     return $query->leftJoin('users', 'empleados.user_id','users.id')
    //     ->leftJoin('nombres', 'empleados.nombre_id', 'nombres.id')
    //     ->leftJoin('sucursales', 'sucursal_id', 'sucursales.id')
    //     ->leftJoin('rh_puestos', 'puesto_id', 'rh_puestos.id')
    //     ->leftJoin('estatuses', 'empleados.estatus_id', 'estatuses.id')
    //     ->select('users.id',
    //                 'users.name',
    //                 'users.email',
    //                 'nombres.nombre as empleado',
    //                 'sucursales.nombre as sucursal',
    //                 'rh_puestos.puesto',
    //                 'estatuses.estatus'); 
    // }

    protected $hidden = [
        'nombre_id',
        'telefono_id',
        'corpo_telefono_id',
        'jefe_user_id',
        'puesto_id',
        'sucursal_id',
        'estatus_id',
        'created_at',
        'updated_at',      
    ];

    protected $with = [
        'user',
        'nombre',
        'telefono'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function nombre()
    {
        return $this->belongsTo(Nombre::class,'nombre_id');
    }
    public function telefono()
    {
        return $this->belongsTo(Telefono::class,'telefono_id');
    }
    public function corpoTelefono()
    {
        return $this->belongsTo(Telefono::class,'corpo_telefono_id');
    }
    public function puesto()
    {
        return $this->belongsTo(Puesto::class,'puesto_id');
    }

    // public function sucursal()
    // {
    //     return $this->belongsTo(Sucursal::class,'sucursal_id');
    // }



}
