<?php

namespace App\Models\Erp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea extends Model
{
    use HasFactory;
    protected $table = 'lineas_articulos';

    protected $fillable = [
        'linea',
        'estatus_id',        
        'icono',
    ];
    
    public function categorias()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_linea');
    }


    protected $hidden = [
        'id',
        'estatus_id',
        'created_at',
        'updated_at',
    ];
}
