<?php

namespace App\Models\Rh;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;

    protected $table = 'rh_puestos';

    protected $fillable = [
        'puesto'
    ];

    protected $casts = [
        'puesto' => 'string',
    ];


    public function scopePuestos($query)
    {
        return $query->join('empleados', 'rh_puestos.id', 'empleados.puesto_id')
        ->selectRaw('rh_puestos.id, rh_puestos.puesto, count(empleados.id) as empleados')
        ->groupBy('rh_puestos.id', 'rh_puestos.puesto')
        ->orderBy('rh_puestos.id');  //TODO: agregar la jearquía del puesto.
        
    }


    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected function puesto(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
            set: fn (string $value) => strtolower($value)
        );
    }    
}
