<?php

namespace App\Http\Controllers\Rh;

use App\Http\Controllers\Controller;
use App\Models\Rh\Empleado;
use App\Models\Rh\Puesto;
use App\Models\Rh\Sucursal;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $menus = Menu::menus()->get();
        // $puestos = Puesto::puestos()->get();
        $empleados = Empleado::paginate(10);
        $sucursales = Sucursal::all();
        // return $empleados;

        return Inertia::render('rh.empleados.index', [
            'empleados' => $empleados,
            'sucursales' => $sucursales,
        ]);


        return view('rh.empleados.index', compact('empleados','sucursales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rh.empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $empleados = Empleado::paginate(10);

        return Inertia::update('empleados_table', [
            'empleados' => $empleados,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
