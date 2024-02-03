<?php

namespace App\Http\Controllers\Rh;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones\Menu;
use App\Models\Generales\Ciudad;
use App\Models\Generales\Correo;
use App\Models\Generales\Curp;
use App\Models\Generales\Direccion;
use App\Models\Generales\Estado;
use App\Models\Generales\Estatus;
use App\Models\Generales\Nombre;
use App\Models\Generales\Referencia;
use App\Models\Generales\Rfc;
use App\Models\Generales\Telefono;
use App\Models\Rh\Empleado;
use App\Models\Rh\Rhextra;
use App\Models\Rh\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $puestos = Rhextra::where('concepto', 'puesto')->withCount('empleadosPorPuesto')->get();
        $empleados = Empleado::empleados()->get();
        $sucursales = Sucursal::sucursales()->withCount('empleados')->get();

        return view('rh.empleados.index', compact('empleados', 'sucursales', 'puestos'));
    }

    // public function tablaEmpleados(Request $request)
    // {

    //     return  Empleado::with(['user', 'nombre', 'telefono', 'telefonoCorporativo', 'sucursal.estatus', 'estatus', 'rfc'])->get();


    //     $draw = $request->input('draw');
    //     $start = $request->input('start');
    //     $length = $request->input('length');
    //     $search = $request->input('search.value');

    //     $query = Empleado::with(['user', 'nombre', 'telefono', 'telefonoCorporativo', 'sucursal.estatus', 'estatus', 'rfc']);

    //     if ($search) {
    //         $query = $query->where('nombre', 'like', '%' . $search . '%')
    //             ->orWhere('apellido', 'like', '%' . $search . '%');
    //     }

    //     $filtered_rows = $query->count();
    //     $empleados = $query->offset($start)
    //         ->limit($length)
    //         ->get();

    //     $total = Empleado::count();


    //     $data = array(
    //         'draw' => intval($draw),
    //         'recordsTotal' => $total,
    //         'recordsFiltered' => $filtered_rows,
    //         'data' => $empleados,
    //     );

    //     return response()->json($data);
    // }


        /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados = Estado::noRandom()->get();
        $sucursales = Sucursal::orderBy('nombre')->get();
        $extras = Rhextra::orderBy('concepto')->orderBy('descripcion')->get();

        foreach ($extras as $rhextra) {
            $rhextras[$rhextra->concepto][] = [
                'id' => $rhextra->id,
                'descripcion' => $rhextra->descripcion
            ];
        }
        return view('rh.empleados.create', compact('estados', 'rhextras', 'sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $messages = [
            'primer_nombre.required' => 'El campo nombre es obligatorio.',
            'paterno.required' => 'El campo apellido paterno es obligatorio.',
            'fecha_nacimiento.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'fecha_ingreso.date' => 'El campo fecha de ingreso debe ser una fecha válida.',
            'sucursal_id.required' => 'El campo sucursal es obligatorio.',
            'estado_id.required' => 'El campo estado es obligatorio.',
            'municipio_id.required' => 'El campo municipio es obligatorio.',
            'curp.regex' => 'El campo CURP debe ser una CURP válida.',
            'rfc.regex' => 'El campo RFC debe ser un RFC válido.',
            'correo.unique' => 'El correo para generar el usuario, ya existe.',
        ];

        $request->validate([
            'primer_nombre' => 'required|min:3|max:50',
            'paterno' => 'required|min:3|max:50',
            'fecha_nacimiento' => 'date',
            'genero' => 'required',
            'telefono' => 'required|max:10|min:10',
            'correo' => 'required|unique:users,email', // No debe tener usuario
            'telefono_corporativo' => 'nullable:max:10|min:10',
            'correo_corporativo' => 'nullable|email',
            'curp' => 'required|regex:/^[A-Z]{4}\d{6}[HM][A-Z]{5}\d{2}$/',
            'rfc' => 'nullable|regex:/^[A-Z]{4}\d{6}[A-Z0-9]{3}$/',
            'calle' => 'required',
            'numero_exterior' => 'required',
            'colonia' => 'required',
            'codigo_postal' => 'required',
            'ciudad' => 'required',
            'municipio_id' => 'required:exists:municipios,id',
            'estado_id' => 'required|exists:estados,id',
            'fecha_ingreso' => 'date',
            'sucursal_id' => 'required|exists:sucursales,id',
        ], $messages);


        

        // Se valida que no exista el curp en la tabla de empleados.
        $curp = Curp::firstOrCreate(['curp' => $request->curp]);

        $empleadoExistente = Empleado::whereHas('nombre', function ($query) use ($curp) {
            $query->where('curp_id', $curp->id);
        })->first();
        if ($empleadoExistente) {
            $errors = ['curp' => 'El empleado con este CURP ya existe.'];
            return redirect()->route('empleados.create')->withErrors($errors)->withInput();
        }


        $user = User::create([
            'name' => $request->primer_nombre . ' ' . $request->paterno,
            'email' => $request->correo,
            'password' => Hash::make('SADECO2024')
        ]);

        // $nombre = Nombre::firstOrCreate($request->all());
        // $nombre = Nombre::createEmpleado($request);
        
        $nombre = Nombre::firstOrCreate([
            'nombre' => trim($request->primer_nombre) . ' ' . trim($request->paterno) . ' ' . trim($request->materno),
            'primer_nombre' => trim($request->primer_nombre),
            'segundo_nombre' => trim($request->segundo_nombre),
            'paterno' => trim($request->paterno),
            'materno' => trim($request->materno),
            'curp_id' => $curp->id,
        ]);

        $ciudad = Ciudad::firstOrCreate($request->only(['municipio_id','estado_id','ciudad']));
        $referencia = $request->referencia ? Referencia::create(['referencia' => $request->referencia])->id : null;

        $direccion = Direccion::firstOrCreate([
            'calle' => $request->calle,
            'numero_exterior' => $request->numero_exterior,
            'numero_interior' => $request->numero_interior,
            'colonia' => $request->colonia,
            'codigo_postal' => $request->codigo_postal,
            'ubicacion' => $request->ubicacion,
            'ciudad_id' => $ciudad->id,
            'municipio_id' => $request->municipio_id,
            'estado_id' => $request->estado_id,
            'referencia_id' => $referencia, //Obtenida
        ]);

        $telefono = Telefono::firstOrCreate(['telefono' => $request->telefono]);
        $correo = Correo::firstOrCreate(['correo' => $request->correo]);
        
        $empleadoData = $request->all();
        $empleadoData['user_id'] = $user->id;
        $empleadoData['nombre_id'] = $nombre->id;
        $empleadoData['direccion_id'] = $direccion->id;
        $empleadoData['telefono_id'] = $telefono->id;
        $empleadoData['correo_id'] = $correo->id;
        $empleadoData['corpo_telefono_id'] = $request->telefono_corporativo ? Telefono::firstOrCreate(['telefono' => $request->telefono_corporativo])->id : null;
        $empleadoData['corpo_correo_id'] = $request->correo_corporativo ? Correo::firstOrCreate(['correo' => $request->correo_corporativo])->id : null;

        $empleadoData['rfc_id'] = $request->rfc ? Rfc::firstOrCreate(['rfc' => $request->rfc])->id : null;
        $empleadoData['estatus_id'] = Estatus::firstOrCreate(['estatus' => 'nuevo'])->id;
        
        $empleado = Empleado::create($empleadoData);
        
        return redirect()->route('rh.empleados.show',$empleado)->with('success', 'Empleado creado exitosamente.');
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {

        $empleados = Empleado::find($empleado->id)->with(['sucursal', 'direccion', 'estatus', 'rfc']);

        return view('rh.empleados.show',compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $empleado = Empleado::with(['rfc','sucursal','nombre','estatus','direccion'])->find($id);
        $estados = Estado::noRandom()->get();
        $sucursales = Sucursal::orderBy('nombre')->get();
        $extras = Rhextra::orderBy('concepto')->orderBy('descripcion')->get();

        // Se crea el array de extras.
        foreach ($extras as $rhextra) {
            $rhextras[$rhextra->concepto][] = [
                'id' => $rhextra->id,
                'descripcion' => $rhextra->descripcion
            ];
        }
        return view('rh.empleados.edit', compact('empleado', 'estados', 'rhextras', 'sucursales'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $empleado = Empleado::findOrFail($id);
        
        $messages = [
            'primer_nombre.required' => 'El campo nombre es obligatorio.',
            'paterno.required' => 'El campo apellido paterno es obligatorio.',
            'fecha_nacimiento.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
            'fecha_ingreso.date' => 'El campo fecha de ingreso debe ser una fecha válida.',
            'sucursal_id.required' => 'El campo sucursal es obligatorio.',
            'estado_id.required' => 'El campo estado es obligatorio.',
            'municipio_id.required' => 'El campo municipio es obligatorio.',
            'curp.regex' => 'El campo CURP debe ser una CURP válida.',
            'rfc.regex' => 'El campo RFC debe ser un RFC válido.',
            'correo.unique' => 'El correo para generar el usuario, ya existe.',
            'estatus.required' => 'El campo estatus es obligatorio.',
        ];

        $request->validate([
            'primer_nombre' => 'required|min:3|max:50',
            'paterno' => 'required|min:3|max:50',
            'fecha_nacimiento' => 'date',
            'genero' => 'required',
            'telefono' => 'required|max:10|min:10',
            'correo'=> 'required|unique:users,id,'.$empleado->user_id,
            'telefono_corporativo' => 'nullable:max:10|min:10',
            'correo_corporativo' => 'nullable|email',
            'curp' => 'required|regex:/^[A-Z]{4}\d{6}[HM][A-Z]{5}\d{2}$/',
            'rfc' => 'nullable|regex:/^[A-Z]{4}\d{6}[A-Z0-9]{3}$/',
            'calle' => 'required',
            'numero_exterior' => 'required',
            'colonia' => 'required',
            'codigo_postal' => 'required',
            'ciudad' => 'required',
            'municipio_id' => 'required:exists:municipios,id',
            'estado_id' => 'required|exists:estados,id',
            'fecha_ingreso' => 'date',
            'sucursal_id' => 'required|exists:sucursales,id',
            'estatus'=> 'required',
        ], $messages);



        $empleado = Empleado::findOrFail($id);
        $user = User::findOrFail($empleado->user_id);

        $user->update([
            'email' => $request->correo,
            'password' => Hash::make('SADECO2024')
        ]);

        $curp = Curp::firstOrCreate(['curp' => $request->curp]);
        $nombre = Nombre::find($empleado->nombre_id);
        $nombre->update([
            'nombre' => trim($request->primer_nombre) . ' ' . trim($request->paterno) . ' ' . trim($request->materno),
            'primer_nombre' => trim($request->primer_nombre),
            'segundo_nombre' => trim($request->segundo_nombre),
            'paterno' => trim($request->paterno),
            'materno' => trim($request->materno),
            'curp_id' => $curp->id,
        ]);

        $direccion = Direccion::find($empleado->direccion_id);
        // Se actualiza la referencia
        if ($request->referencia) {
            if ($direccion->referencia_id) {
                $referencia = Referencia::find($direccion->referencia_id);
                $referencia->referencia = $request->referencia;
                $direccion->referencia_id = $referencia->id;
                $referencia->save();
            } else {
                $referencia = Referencia::firstOrCreate(['referencia' => $request->referencia]);
                $direccion->referencia_id = $referencia->id;
                $referencia->save();
            }
        }
        // Se actuazliza la dirección
        $direccion->update([
            'calle' => $request->calle,
            'numero_exterior' => $request->numero_exterior,
            'numero_interior' => $request->numero_interior,
            'colonia' => $request->colonia,
            'codigo_postal' => $request->codigo_postal,
            'ubicacion' => $request->ubicacion,
            'ciudad_id' => Ciudad::firstOrCreate(
                [
                    'ciudad' => $request->ciudad,
                    'municipio_id' => $request->municipio_id,
                    'estado_id' => $request->estado_id
                ]
            )->id,
            'municipio_id' => $request->municipio_id,
            'estado_id' => $request->estado_id,
        ]);

        $telefono = Telefono::firstOrCreate(['telefono' => $request->telefono]);
        $correo = Correo::firstOrCreate(['correo' => $request->correo]);
        $estatus = Estatus::firstOrCreate(['estatus' => $request->estatus]);

        $empleadoData = $request->all();
        $empleadoData['nombre_id'] = $nombre->id;
        $empleadoData['direccion_id'] = $direccion->id;
        $empleadoData['telefono_id'] = $telefono->id;
        $empleadoData['correo_id'] = $correo->id;
        $empleadoData['corpo_telefono_id'] = ($request->telefono_corporativo ? Telefono::firstOrCreate(['telefono' => $request->telefono_corporativo])->id : null);
        $empleadoData['corpo_correo_id'] = $request->correo_corporativo ? Correo::firstOrCreate(['correo' => $request->correo_corporativo])->id : null;
        $empleadoData['estatus_id'] = $estatus->id;

        $empleadoData['rfc_id'] = $request->rfc ? Rfc::firstOrCreate(['rfc' => $request->rfc])->id : null;

        
        $empleado->update($empleadoData);

        
        return redirect()->route('rh.empleados.index')->with('success', 'Empleado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
