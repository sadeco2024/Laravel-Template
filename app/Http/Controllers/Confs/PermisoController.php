<?php

namespace App\Http\Controllers\Confs;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones\Modulo;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $modulos = Modulo::all();
        $permissions = Permission::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        $messages = [
            'pname.required' => 'El slug del permiso es requerido.',
            'pname.unique' => 'El slug del permiso ya existe.',
            'pdescripcion.required' => 'La descripción del permiso es requerida.',
            'pcg_modulo_id.required' => 'El módulo del permiso es requerido.',
            'pcg_modulo_id.array' => 'Debe seleccionar un módulo.',
            'pcg_modulo_id.min' => 'Debe seleccionar un módulo.',
            'pnombre.required' => 'El nombre del permiso es requerido.'
           
        ];

        $request->validate([
            'pname' => 'required|unique:permissions,name|max:50' ,
            'pdescripcion' => 'required',
            'pcg_modulo_id' => 'required|min:1',
            'pnombre' => 'required'            
        ],$messages);

        Permission::create([
            'name' => $request->pname,
            'nombre' => $request->pnombre,
            'descripcion' => $request->pdescripcion,
            'cg_modulo_id' => $request->pcg_modulo_id
        ])->syncRoles(['Super Admin']);

        
        $permisos = Permission::select('id','name','nombre','descripcion','cg_modulo_id')->get();
        $permisos->toJson(JSON_PRETTY_PRINT);
        $file = fopen('../resources/data/permisos.json', 'w');
        fwrite($file, $permisos);
        fclose($file);


        $role = Role::find($request->rol_id);

        return redirect()->route('confs.roles.edit',$role)->with('success','Permiso creado correctamente');   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
