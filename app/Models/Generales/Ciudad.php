<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = [
        'nombre',
        'abreviatura',
        'municipio_id',
        'estado_id'
    ];    

    protected $hidden = [
        'municipio_id',
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
