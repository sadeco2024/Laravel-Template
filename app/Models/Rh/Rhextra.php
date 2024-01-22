<?php

namespace App\Models\Rh;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rhextra extends Model
{
    use HasFactory;

    protected $table = 'rh_extras';

    protected $fillable = [
        'concepto',
        'descripcion',
    ];

    protected $hidden = [
        'id',
        'concepto',
        'created_at',
        'updated_at',
    ];

    public function empleadosPorPuesto()
    {
        return $this->hasMany('App\Models\Rh\Empleado', 'puesto_rh_extra_id');
                    
    }    
    public function empleadosPorDepartamento()
    {
        return $this->hasMany('App\Models\Rh\Empleado', 'departamento_rh_extra_id');
                    
    }
    public function empleadosPorTipoContrato()
    {
        return $this->hasMany('App\Models\Rh\Empleado', 'tipo_contrato_rh_extra_id');
                    
    }
    public function empleadosPorArea()
    {
        return $this->hasMany('App\Models\Rh\Empleado', 'area_rh_extra_id');
                    
    }
    

    protected function descripcion():Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => strtolower($value)
        );
    }
    protected function concepto():Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtolower($value),
            set: fn (string $value) => strtolower($value)
        );
    }    
}      

