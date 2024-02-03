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
        'slug',
        'cg_modulo_id',
        'tipo_concepto_id',
        'padre_cg_menu_id',
        'orden',
        'enabled'    
    ];

    public function getChildren($data, $line)
    {
        $children = [];
        foreach ($data as $line1) {
            if ($line['id'] == $line1['padre_cg_menu_id']) {
                $children = array_merge($children, [array_merge($line1, ['submenu' => $this->getChildren($data, $line1)])]);
            }
        }
        return $children;
    }

    public function optionsMenu()
    {
        return $this->leftJoin('cg_modulos', 'cg_modulos.id', '=', 'cg_menus.cg_modulo_id')
            ->leftJoin('conceptos', 'conceptos.id', '=', 'cg_menus.tipo_concepto_id')
            ->orderby('cg_menus.padre_cg_menu_id')
            ->orderby('cg_menus.orden')
            ->orderby('cg_menus.nombre')
            ->select('cg_menus.id', 'cg_menus.nombre', 'cg_menus.icono', 'cg_menus.slug', 'conceptos.concepto', 'cg_menus.padre_cg_menu_id', 'cg_modulos.nombre as modulo','cg_menus.auth_roles','cg_menus.auth_permisos')
            ->get()
            ->toArray();
    }

    public function concepto()
    {
        return $this->belongsTo('App\Models\Generales\Concepto', 'tipo_concepto_id');
    }

    
    public function modulo()
    {
        return $this->belongsTo('App\Models\Configuraciones\Modulo', 'cg_modulo_id');
    }

    public function comentario()
    {
        return $this->belongsTo('App\Models\Generales\Comentario', 'comentario_id');
    }

    public function submenus()
    {
        return $this->hasMany('App\Models\Configuraciones\Menu', 'padre_cg_menu_id');
                        // ->join('conceptos', 'cg_menus.tipo_concepto_id', '=', 'conceptos.id');
    }

    public static function menus()
    {

        $menus = Menu::where('padre_cg_menu_id', 0)
            ->with(['submenus','concepto','modulo'])
            ->orderby('orden')
            ->get();
        return $menus;


    }

    // protected $with = ['concepto'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];


}
