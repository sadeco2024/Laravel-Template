<?php

namespace App\Models\Generales;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        "calle",
        "numero_exterior",
        "numero_interior",
        "colonia",
        "codigo_postal",
    ];

    protected $hidden = [
        "ciudad_id",
        "estado_id",
        "municipio_id",
        "referencia_id",
        'created_at',
        'updated_at'
    ];
}
