<?php

namespace App\Models\Erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias_articulos';

    protected $fillable = [
        'categoria',
        'estatus_id',
    ];



    public function lineas()
    {
        return $this->belongsToMany(Linea::class, 'categoria_linea', 'categoria_articulo_id', 'linea_articulo_id');
    }

    protected $hidden = [
        'id',
        'estatus_id',
        'created_at',
        'updated_at',
    ];
}
