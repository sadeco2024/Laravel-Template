<?php

namespace App\Models\Erp;

use App\Models\Erp\Articulo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaveArticulo extends Model
{
    use HasFactory;

    protected $table = 'claves_articulos';

    protected $fillable = [
        'clave',
        'rol_clave',
        'articulo_id',
        'estatus_id',
    ];

    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
