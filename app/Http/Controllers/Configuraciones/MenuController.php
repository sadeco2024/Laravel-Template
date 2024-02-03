<?php

namespace App\Http\Controllers\Configuraciones;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuRequest;
use App\Models\Configuraciones\Menu;
use App\Models\Configuraciones\Modulo;
use App\Models\Generales\Comentario;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


use Spatie\Permission\Models\Role as ModelsRole;

class MenuController extends Controller
{



    public function index()
    {
        $modulos = Modulo::all();
        $menus = Menu::with(['submenus','concepto','modulo'])
        ->orderby('orden')
        ->get();                    
        $conceptos = Menu::get()->unique('concepto')->values()->pluck('concepto');

        return view('confs.menus.index', compact('modulos', 'menus', 'conceptos'));
    }

    public function create()
    {
        $modulos = Modulo::all();
        $conceptos = Menu::get()->unique('concepto')->values()->pluck('concepto');
        $menus = Menu::where('padre_cg_menu_id', 0)->get();

        return view('confs.menus.create', compact('modulos', 'conceptos','menus'))->render();
    }

    // TODO: Cambiar las reglas a un Request.
    public function store(Request $request)
    {

        //** Se valida como AJAX */
        $validator = Validator::make($request->all(), [
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
    
        if ($validator->fails()) {
            $errors = new \Illuminate\Support\MessageBag($validator->errors()->getMessages()); // Convierte los errores a MessageBag
            return response()->json([
                'errors' => $errors
            ]);
        }
        
        $comentario = Comentario::create([
            'comentario' => $request->comentario,
        ]);

        $request->merge(['enabled' => $request->input('enabled') ? 1 : 0]);
        
        $menu = Menu::create($request->all());
        $menu->comentario_id = $comentario->id;
        $menu->save();


        //** Se guarda el JSON */
        $menus = Menu::select('nombre', 'slug', 'icono', 'padre_cg_menu_id', 'orden', 'enabled', 'tipo_concepto_id', 'cg_modulo_id')->get();
        $menus->toJson(JSON_PRETTY_PRINT);
        $file = fopen('../resources/data/menus.json', 'w');
        fwrite($file, $menus);
        fclose($file);

        session()->flash('success', 'Menú creado correctamente');
        return response()->json([
            'redirect' => route('confs.menus.index')
        ]);
        
    }

    public function edit(string $id) {

        $modulos = Modulo::all();
        $menus = Menu::where('padre_cg_menu_id', 0)->get();        
        $menu = Menu::with(['concepto', 'modulo','comentario'])->find($id);
        $conceptos = Menu::get()->unique('concepto')->values()->pluck('concepto');        

        return view('confs.menus.edit',["menu"=>$menu,"menus"=>$menus, "modulos"=>$modulos, "conceptos"=>$conceptos]);
    }

    public function roles()
    {

        $roles = ModelsRole::all();
        return view('confs.roles', compact('roles'));
    }

    public function update(Request $request, string $id) {
        //** Se valida como ajax. */

        //** Se valida como AJAX */
        
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:cg_menus,nombre,' . $id . '|max:50',
            'slug' => 'required|unique:cg_menus,slug,' . $id . '|max:70',
            'orden' => 'min:1',
            'cg_modulo_id' => 'required:numeric|min:1',
            'padre_cg_menu_id' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->tipo_concepto_id == 'crud' && $value <= 0) {
                        $fail($attribute . ' debe ser mayor que 0 cuando Tipo es un crud.');
                    }
                },
            ]
        ]);
 
        if ($validator->fails()) {
            $errors = new \Illuminate\Support\MessageBag($validator->errors()->getMessages()); // Convierte los errores a MessageBag
            return response()->json([
                'errors' => $errors
            ]);
        }

        $request->merge(['enabled' => $request->input('enabled') ? 1 : 0]);
        
        $menu = Menu::find($id);
        $idComentario = null;
        if ($request->comentario) {
            if ($menu->comentario_id)
                $idComentario = Comentario::updateOrCreate(
                    ['id' => $menu->comentario_id],
                    ['comentario' => $request->comentario]
                )->id;
            else
                $idComentario = Comentario::create([
                    'comentario' => $request->comentario,
                ])->id;
        }
           
        $menu->update($request->all());
        $menu->comentario_id = $idComentario;
        $menu->save();        

        session()->flash('success', 'Menú actualizado correctamente');
        return response()->json([
            'redirect' => route('confs.menus.index')
        ]);
    }

    // public function rolesPermisos($id)
    // {
    //     // return $id;
    //     // dd($id);
    //     $modulos = Modulo::all();
    //     $role = ModelsRole::findById($id);
    //     $permisos = $role->permissions;
    //     return view('confs.rolespermisos', compact('role', 'permisos', 'modulos'));
    // }

    public function destroy($id) {
        // $menu = Menu::find($id);
        // $menu->delete();
        return redirect()->route('confs.menus.index')->with('success', 'Menú eliminado correctamente');
    }
}
