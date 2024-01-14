<?php

namespace App\Http\Controllers\Rh;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones\Menu;
use App\Models\Rh\Empleado;
use App\Models\Rh\Puesto;
use App\Models\Rh\Sucursal;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoControllerAnt extends Controller
{

    // const $menus = Menu::menus()->get();

    public function index()
    {

        // $menus = Menu::menus()->get();
        $puestos = Puesto::puestos()->get();
        $empleados = Empleado::empleados()->get();
        $sucursales = Sucursal::sucursales()->get();
        return view('rh.empleados', compact('empleados','sucursales','puestos'));
    }

    public function create() {
        // $menus = Menu::menus()->get();
        return view('rh.empleado-create');
    }


    public function edit(Request $request): View
    {
        $empleado = User::find(auth()->user()->id);
        return view('rh.empleado-editar', compact('empleado'));
    }    

    public function changePassd() {
        // $menus = Menu::menus()->get();
        return view('rh.empleado-passwd');
    }


    public function list()
    {

        $puestos = Puesto::puestos()->get();
        $empleados = Empleado::empleados()->get();
        $sucursales = Sucursal::sucursales()->get();
        // $menus = Menu::menus()->get();
        return view('rh.empleados', compact('empleados','sucursales','puestos'));
    }    





}
