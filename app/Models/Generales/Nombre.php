<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nombre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'primer_nombre',
        'segundo_nombre',
        'paterno',
        'materno',
        'curp_id'
    ];    

    protected function nombre(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords($value),
        );
    }        
}
