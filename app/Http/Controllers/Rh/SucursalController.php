<?php

namespace App\Http\Controllers\Rh;

use App\Http\Controllers\Controller;
use App\Models\Generales\Ciudad;
use App\Models\Generales\Comentario;
use App\Models\Generales\Concepto;
use App\Models\Generales\Correo;
use App\Models\Generales\Direccion;
use App\Models\Generales\Estado;
use App\Models\Generales\Estatus;
use App\Models\Generales\Municipio;
use App\Models\Generales\Referencia;
use App\Models\Generales\Telefono;
use App\Models\Rh\Empleado;
use App\Models\Rh\Sucursal;
use Illuminate\Database\Query\Expression;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
    {
        
        $sucursales = Sucursal::with(['telefono','direccion','estatus','empleados','tipo','gerenteEmpleadoId'])->get();
        //TODO: Mandarle toda la lista de empleados, para que por el puesto, rellene los selects
        // $empleados = Empleado::all();
        // return $empleados;

        return view('rh.sucursales.index',['sucursales'=>$sucursales]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $estados = Estado::noRandom()->get();
        return view('rh.sucursales.create',compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'municipio_id.required' => 'El municipio de la sucursal es requerido',
            'municipio_id.exists' => 'El Municipio es incorrecto',
            'estado_id.required' => 'El estado de la sucursal es requerido',
            'estado_id.exists' => 'El Estado es incorrecto',
        ];

        $request->validate([
            'nombre'=>'required',
            'telefono'=>'required|max:10|min:10',
            'correo'=>'required|email',
            'calle'=>'required',
            'numero_exterior'=>'required',            
            'colonia'=>'required',
            'codigo_postal'=>'required',
            'ciudad'=>'required',
            'municipio_id'=>'required',
            'estado_id'=>'required|exists:estados,id',
            'municipio_id'=>'required|exists:municipios,id',            
            'fecha_apertura'=>'nullable:date',
            'tipo_concepto'=>'required',
            'estatus'=>'required',
            'gerente_empleado_id'=>'nullable|exists:empleados,id',
            'supervisor_empleado_id'=>'nullable|exists:empleados,id',
            'encargado_empleado_id'=>'nullable|exists:empleados,id',
        ],$messages);


        $sucursal = Sucursal::create([
            'nombre'=>$request->nombre,
            'fecha_apertura'=>$request->fecha_apertura,
            'telefono_id'=> Telefono::firstOrCreate(['telefono'=>$request->telefono])->id,
            'correo_id'=> Correo::firstOrCreate(['correo'=>$request->correo])->id,
            'direccion_id'=> Direccion::firstOrCreate([
                'calle'=>$request->calle,
                'numero_exterior'=>$request->numero_exterior,
                'numero_interior'=>$request->numero_interior,
                'colonia'=>$request->colonia,
                'codigo_postal'=>$request->codigo_postal,
                'ciudad_id'=>Ciudad::firstOrCreate(['ciudad'=>$request->ciudad,'municipio_id'=>$request->municipio_id,'estado_id'=>$request->estado_id])->id,
                'estado_id'=> $request->estado_id,
                'municipio_id'=>$request->municipio_id,
                'referencia_id'=>($request->referencia ? Referencia::firstOrCreate(['referencia'=>$request->referencia])->id: null),
                'ubicacion'=>$request->ubicacion,
            ])->id,
            'tipo_concepto_id'=>Concepto::firstOrCreate(['concepto'=>$request->tipo_concepto])->id,
            'comentario_id'=>($request->comentario ? Comentario::firstOrCreate(['comentario'=>$request->comentario])->id : null),
            // 'ubicacion'=>($request->ubicacion ? $request->ubicacion : new Expression('(JSON_ARRAY())')),
            'estatus_id'=>Estatus::firstOrCreate(['estatus'=>$request->estatus])->id,
            
            'gerente_empleado_id'=>$request->gerente_empleado_id,
            'supervisor_empleado_id'=>$request->supervisor_empleado_id,
            'encargado_empleado_id'=>$request->encargado_empleado_id,
        ]);

        return redirect()->route('rh.sucursales.edit',$sucursal->id)->with('success','Sucursal creada correctamente');
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
    public function edit( $sucursal)
    {


        $sucursal = Sucursal::with(['telefono','direccion','estatus','empleados','tipo','gerenteEmpleadoId'])->where('id',$sucursal)->first();
        $estados = Estado::noRandom()->get();
        // return $sucursal;
        return view('rh.sucursales.edit',['sucursal'=>$sucursal,'estados'=>$estados]);

    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    public function update(Request $request,string  $id)
    {
        
        $messages = [
            'municipio_id.required' => 'El municipio de la sucursal es requerido',
            'municipio_id.exists' => 'El Municipio es incorrecto',
            'estado_id.required' => 'El estado de la sucursal es requerido',
            'estado_id.exists' => 'El Estado es incorrecto',
        ];

        $request->validate([
            'nombre'=>'required',
            'telefono'=>'required|max:10|min:10',
            'correo'=>'required|email',
            'calle'=>'required',
            'numero_exterior'=>'required',            
            'colonia'=>'required',
            'codigo_postal'=>'required',
            'ciudad'=>'required',
            'municipio_id'=>'required',
            'estado_id'=>'required|exists:estados,id',
            'municipio_id'=>'required|exists:municipios,id',            
            'fecha_apertura'=>'nullable:date',
            'tipo_concepto'=>'required',
            'estatus'=>'required',
            'gerente_empleado_id'=>'nullable|exists:empleados,id',
            'supervisor_empleado_id'=>'nullable|exists:empleados,id',
            'encargado_empleado_id'=>'nullable|exists:empleados,id',
        ],$messages);

        
        // dd($request->all());
        $sucursal = Sucursal::find($id);
        $sucursal->nombre = $request->nombre;
        $sucursal->fecha_apertura = $request->fecha_apertura;
        $sucursal->telefono_id = Telefono::firstOrCreate(['telefono' => $request->telefono])->id;
        $sucursal->correo_id = Correo::firstOrCreate(['correo' => $request->correo])->id;

        //?Se actualiza la referencia de la sucursal.
        if ($request->referencia) {
            if ($sucursal->direccion->referencia_id) {
                $referencia = Referencia::find($sucursal->direccion->referencia_id);
                $referencia->referencia = $request->referencia;
                $sucursal->direccion->referencia_id = $referencia->id;
                $referencia->save();
            } else {
                $referencia = Referencia::firstOrCreate(['referencia' => $request->referencia]);
                $sucursal->direccion->referencia_id = $referencia->id;
                $referencia->save();
            }
        }

        // ?Se actualiza la dirección
        $direccion = Direccion::find($sucursal->direccion_id);
        $direccion->calle = $request->calle;
        $direccion->numero_exterior = $request->numero_exterior;
        $direccion->numero_interior = $request->numero_interior;
        $direccion->colonia = $request->colonia;
        $direccion->codigo_postal = $request->codigo_postal;
        $direccion->ciudad_id = Ciudad::firstOrCreate(['ciudad' => $request->ciudad, 'municipio_id' => $request->municipio_id, 'estado_id' => $request->estado_id])->id;
        $direccion->estado_id = $request->estado_id;
        $direccion->municipio_id = $request->municipio_id;
        $direccion->referencia_id = (isset($referencia) ? $referencia->id : null);
        $direccion->ubicacion = $request->ubicacion;
        $direccion->save();

        

        //? Se actualiza o genera el comentario
        if ($request->comentario) {
            if ($sucursal->comentario_id) {
                $comentario = Comentario::find($sucursal->comentario_id);
                $comentario->comentario = $request->comentario;
                $comentario->save();
               
            } else {
                $comentario = Comentario::firstOrCreate(['comentario' => $request->comentario]);
                $sucursal->comentario_id = $comentario->id;
            }
        }        
        
        $sucursal->tipo_concepto_id = Concepto::firstOrCreate(['concepto' => $request->tipo_concepto])->id;
        $sucursal->estatus_id = Estatus::firstOrCreate(['estatus' => $request->estatus])->id;
        $sucursal->save();
        // TODO: Los ids de los empleados, se deben de validar que existan en la tabla de empleados.
        // $sucursal->gerente_empleado_id = $request->gerente_empleado_id;
        // $sucursal->supervisor_empleado_id = $request->supervisor_empleado_id;
        // $sucursal->encargado_empleado_id = $request->encargado_empleado_id;
        

        
        $sucursales = Sucursal::with(['telefono','direccion','estatus','empleados','tipo','gerenteEmpleadoId'])->get();
        // return $sucursales;
        return redirect()->route('rh.sucursales.index',['sucursales'=>$sucursales])->with('success','Sucursal actualizada correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
