<?php

namespace App\Models\ERP;

use App\Models\Erp\ClaveArticulo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = 'articulos';

    protected $fillable = [
        'nombre',
        'almacenable',
        'unidad_venta',
        'categoria_linea_id',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_linea_id');
        // return $this->belongsTo(Categoria::class);

    }

    public function claves()
    {
        return $this->hasMany(ClaveArticulo::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
