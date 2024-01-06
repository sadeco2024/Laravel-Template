<?php

namespace App\Models\Rh;

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

    public function scopeEmpleados($query) {
        
        return $query->leftJoin('users', 'empleados.user_id','users.id')
        ->leftJoin('nombres', 'empleados.nombre_id', 'nombres.id')
        ->leftJoin('sucursales', 'sucursal_id', 'sucursales.id')
        ->leftJoin('rh_puestos', 'puesto_id', 'rh_puestos.id')
        ->leftJoin('estatuses', 'empleados.estatus_id', 'estatuses.id')
        ->select('users.id',
                    'users.name',
                    'users.email',
                    'nombres.nombre as empleado',
                    'sucursales.nombre as sucursal',
                    'rh_puestos.puesto',
                    'estatuses.estatus'); 
    }

    protected $hidden = [
        'user_id',
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

}
