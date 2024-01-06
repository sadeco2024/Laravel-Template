<?php

namespace App\Models\Configuraciones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'cg_menus';

    protected $fillable = [
        'nombre',
        'icono',
        'ruta',
        'cg_modulo_id'
    ];

    public function scopeMenus($query)
    {
        return $query->leftJoin('cg_modulos','cg_modulos.id','=','cg_menus.cg_modulo_id')
        ->leftJoin('conceptos','conceptos.id','=','cg_menus.tipo_concepto_id')
        ->select('cg_menus.id','cg_menus.nombre','cg_menus.icono','cg_menus.ruta','conceptos.concepto','cg_modulos.nombre as modulo');
    }

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    // public function modulo()
    // {
    //     return $this->belongsTo(Modulo::class);
    // }


}
