<?php

namespace App\Models\Configuraciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'cg_modulos';

    protected $fillable = [
        'nombre',
        'icono',
        'ruta',
        'precio'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
