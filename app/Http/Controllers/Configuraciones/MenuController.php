<?php

namespace App\Http\Controllers\Configuraciones;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones\Menu;
use App\Models\Configuraciones\Modulo;
use App\Models\Generales\Concepto;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;
// use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class MenuController extends Controller
{



    public function index()
    {
        $modulos = Modulo::all();
        $menus = Menu::with(['concepto', 'modulo'])->get();
        // return $menus;
        $conceptos = Menu::get()->unique('concepto')->values()->pluck('concepto');
        //  return $menus;

        return view('confs.menus.index', compact('modulos', 'menus', 'conceptos'));
    }

    public function create()
    {
        $modulos = Modulo::all();
        $conceptos = Menu::get()->unique('concepto')->values()->pluck('concepto');

        return view('confs.menus.create', compact('modulos', 'conceptos'))->render();
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|unique:cg_menus,nombre|max:50',
            'slug' => 'required:unique:cg_menus,slug|max:70',
            'orden' => 'min:1',
            'cg_modulo_id' => 'required:array|min:1',
            'padre_cg_menu_id' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->tipo_concepto_id == 'crud' && $value <= 0) {
                        $fail($attribute . ' debe ser mayor que 0 cuando tipo_concepto_id es crud.');
                    }
                },
            ]
        ]);

        // dd($request->all());

        Menu::create([
            'nombre' => $request->nombre,
            'slug' => $request->slug,
            'icono' => $request->icono,
            'padre_cg_menu_id' => $request->padre_cg_menu_id,
            'orden' => $request->orden,
            'enabled' => ($request->enabled ? 1 : 0),
            'tipo_concepto_id' => $request->tipo_concepto_id,
            'cg_modulo_id' => $request->cg_modulo_id
        ]);


        $menus = Menu::select('nombre', 'slug', 'icono', 'padre_cg_menu_id', 'orden', 'enabled', 'tipo_concepto_id', 'cg_modulo_id')->get();
        $menus->toJson(JSON_PRETTY_PRINT);
        $file = fopen('../resources/data/menus.json', 'w');
        fwrite($file, $menus);
        fclose($file);


        return redirect()->route('confs.menus.index')->with('success', 'Menú creado correctamente');
    }


    public function roles()
    {

        $roles = ModelsRole::all();
        return view('confs.roles', compact('roles'));
    }

    public function rolesPermisos($id)
    {
        // return $id;
        // dd($id);
        $modulos = Modulo::all();
        $role = ModelsRole::findById($id);
        $permisos = $role->permissions;
        return view('confs.rolespermisos', compact('role', 'permisos', 'modulos'));
    }
}
