<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;
    protected $table = 'municipios';

    protected $fillable = [
        'nombre',
        'clave',
        'abreviatura',
        'estado_id'
    ];    

    protected $hidden = [
        'ciudad_id',
        'estado_id',        
        'created_at',
        'updated_at'
    ];

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
        );
    }     

}
