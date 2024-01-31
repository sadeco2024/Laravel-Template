<?php

namespace App\Http\Controllers\Confs;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones\Modulo;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;



class RoleController extends Controller
{

    public function __construct()
{
    $this->middleware(['permission:confs.role.menu|confs.role.edit|confs.role.add'], ['only' => ['index']]);
    $this->middleware(['permission:confs.role.add'], ['only' => ['create']]);
    $this->middleware(['permission:confs.role.delete'], ['only' => ['destroy']]);
    
}
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $roles =Role::all() ;
        return view('confs.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $modulos = Modulo::all();
        $permissions = Permission::all();
        return view('confs.roles.create',compact('modulos','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|max:50',
            'descripcion' => 'required',
        ]);

        $role = Role::create($request->only('name','descripcion'));
        $role->permissions()->sync($request->permissions);
        return redirect()->route('confs.roles.edit',$role)->with('success','Rol creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        
        // //Crea un array con los empleados que tienen el role 'Super Admin'
        // $empleados = User::whereHas('roles', function ($query) {
        //     $query->where('name','Super Admin' );
        // })->get();

        
        // // $empleados = User::has('roles')->get();
        
        // return view('confs.roles.show',compact('empleados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if (!auth()->user()->hasAnyPermission(['confs.role.edit'])) {
            abort(403, 'No autorizado');
        }


        $modulos = Modulo::all();
        $permissions = Permission::all();
        $rolPermisos = $role->permissions;        
        return view('confs.roles.edit', compact('role','permissions','modulos','rolPermisos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
            'descripcion' => 'required',
        ]);        

        $role->update($request->only('name','descripcion'));
        $role->permissions()->sync($request->permissions);

        return redirect()->route('confs.roles.index',$role)->with('success','Rol actualizado correctamente');
    }
    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Role $role)
    {

        $role->delete();
        return redirect()->route('confs.roles.index'); //->with('success','Rol eliminado correctamente');
    }
}
