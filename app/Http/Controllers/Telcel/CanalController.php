<?php

namespace App\Http\Controllers\Telcel;

use App\Http\Controllers\Controller;
use App\Models\ERP\Articulo;
use App\Models\Generales\Concepto;
use App\Models\Generales\Estado;
use App\Models\Generales\Estatus;
use App\Models\Generales\Municipio;
use App\Models\Rh\Sucursal;
use App\Models\Telcel\Canal;
use App\Models\Telcel\CanalVendedor;
use Illuminate\Http\Request;

use App\Services\Telcel;
use DateTime;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

// use Acme\Client;

class CanalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $scrap;
    

    public function __construct(Telcel $browser)
    {
        $this->scrap = $browser;
        
    }    

    public function index()
    {

        
        // $canales = Canal::with(['concepto','sucursal','sucursal.empleados'])->simplePaginate(15);
        $canales = Canal::with(['concepto','sucursal','sucursal.empleados'])->get();
        $canalSucursal = Canal::canalTienda(); 
        return view('telcel.canales.index', compact('canales','canalSucursal'));
    }

    // Actualiza la tabla de canales
    public function actualiza()
    {
     
        $data = $this->scrap->getCanales(); 
        
        if ($data['status']===0) {   
            // Se actualizan todos los estatus a 'Inactivo' y se actualizan los que se encuentran en el archivo
            $tipoConceptoId = Concepto::firstOrCreate(['concepto'=>'Distribuidor'])->id;
            $estatusInactivoId = Estatus::firstOrCreate(['estatus'=>'Inactivo'])->id;
            $estatusActivoId = Estatus::firstOrCreate(['estatus'=>'Activo'])->id;
            
            // Actualizar el estatus de los canales a 'Inactivo' con las condiciones dadas
            Canal::where('tipo_concepto_id', $tipoConceptoId)
                ->where('clave', '!=', 'RPHAESC1')
                ->update(['estatus_id' => $estatusInactivoId]);

            foreach ($data['data'] as $canal) {
                $estadoId = optional(Estado::where('estado', $canal['estado'])->first())->id;
                $municipioId = optional(Municipio::where(['municipio'=>$canal['municipio'],'estado_id'=>$estadoId])->first())->id;
                $canalModel = Canal::firstOrCreate(
                    ['clave' => $canal['canal']],
                    [
                        'nombre'=>$canal['denominacionfiscal'],
                        'direccion'=>$canal['calleynum'],
                        'activa'=>strstr($canal['puedeactivar'],'SI')?true:false,
                        'acox'=>$canal['acox'],
                        'tipo_concepto_id'=> $tipoConceptoId,
                        'municipio_id'=> $municipioId,
                        'estado_id'=>$estadoId,
                        'estatus_id'=>$estatusActivoId,
                    ]
                );
                
                if (!$canalModel->wasRecentlyCreated) {
                    $canalModel->update([
                        'direccion'=>$canal['calleynum'],
                        'activa'=>strstr($canal['puedeactivar'],'SI')?true:false,
                        'acox'=>$canal['acox'],
                        'tipo_concepto_id'=> $tipoConceptoId,
                        'municipio_id'=> $municipioId,
                        'estado_id'=>$estadoId,
                        'estatus_id'=>$estatusActivoId,
                    ]);
                }
            }
        }
        return $data;

    }

    public function setQuestion(Canal $canal) 
    {
        $data = $this->scrap->setQuestion($canal); 
        
        if ($data['status']==0) {
            $canal->update(['question'=>1]);
        }
        return $data;
    }

    public function getVendedores(Canal $canal) 
    {
        // return $data['table'] =["tableCanalVendedores"=> CanalVendedor::where(['tlc_canal_id'=>$canal->id])->selectRaw('nombre,logunico,contrasena,"" as btn')->get()];

        $data = $this->scrap->getVendedores($canal); 
        $meses = [
            'ene' => 'Jan',
            'feb' => 'Feb',
            'mar' => 'Mar',
            'abr' => 'Apr',
            'may' => 'May',
            'jun' => 'Jun',
            'jul' => 'Jul',
            'ago' => 'Aug',
            'sep' => 'Sep',
            'oct' => 'Oct',
            'nov' => 'Nov',
            'dic' => 'Dec',
        ];        
        
        if ($data['status']===0) {
            foreach($data["data"] as $row) {
                $row['fechaalta'] = strtr(strtolower($row['fechaalta']), $meses);                
                $date = Date::createFromFormat('d-M-Y', $row['fechaalta']);
                $vendedor = CanalVendedor::updateOrCreate([
                        'nombre'=>$row['nombre'],
                        'logunico'=>$row['loginnico'],
                        'login'=>$row['login'],
                        'tlc_canal_id'=> $canal->id,
                        'calta'=>$row['contraseaalta'],
                        'fecha_alta' =>$date->format('Y-m-d')
                    ]
                );
            }
        }
        // $data['table'] =["tableCanalVendedores"=> CanalVendedor::where(['tlc_canal_id'=>$canal->id])->select('nombre','logunico','contrasena')->append('boton')->get()];
        $data['table'] =["tableCanalVendedores"=> CanalVendedor::where(['tlc_canal_id'=>$canal->id])->selectRaw('nombre,logunico,contrasena,"" as btn')->get()];
        return $data;
    }


    public function resetAcox(Canal $canal) {
        
        $data = $this->scrap->resetAcox($canal); 
        // return $data;
        if ($data['status']===0) {
            $canal->update(['contrasena'=>$data['data']['nuevopass']]);
        }
        $data["form"]=['contrasena'=>$canal->contrasena];
        return $data;
    }

    public function resetRcox(CanalVendedor $vendedor) {
        $canal = Canal::find($vendedor->tlc_canal_id);
        // return $canal;
        
        $data = $this->scrap->resetRcox($canal,$vendedor); 
        if ($data['status']===0) {
            try {
                $vendedor->update(['contrasena'=>$data['data']['nuevopass']]);
            } catch (\Exception $e) {
                throw $vendedor;
            }
            // $vendedor->update(['contrasena'=>$data["data"]["nuevopass"]]);
        }
        $data['table'] =["tableCanalVendedores"=> CanalVendedor::where(['tlc_canal_id'=>$canal->id])->selectRaw('nombre,logunico,contrasena,"" as btn')->get()];
        $data["dtable-row"] = Canal::with(['concepto','sucursal','sucursal.empleados'])->find($vendedor->tlc_canal_id)->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        // $canal = Canal::find($id);
        $canal = Canal::with(['concepto','sucursal','rcox'])->find($id);
        $sucursales = Sucursal::all();
        //  return $canal;
        return view('telcel.canales.edit', compact('canal','sucursales'))->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
                //** Se valida como ajax. */

        //** Se valida como AJAX */
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:tlc_canales,nombre,' . $id . '|max:50',
            'clave' => 'required|unique:tlc_canales,clave,' . $id . '|max:30',
            'acox' => 'required|unique:tlc_canales,acox,' . $id . '|max:30',
            'contrasena' => 'required|string|min:8',
            'sucursal_id' => 'required|numeric|min:1',
            'concepto'=>'required|string'
        ]);
    
        if ($validator->fails()) {
            $errors = new \Illuminate\Support\MessageBag($validator->errors()->getMessages()); // Convierte los errores a MessageBag
            return response()->json([
                'errors' => $errors
            ]);
        }

        // $request->merge(['enabled' => $request->input('enabled') ? 1 : 0]);

        $canal = Canal::find($id);
        $conceptoId =Concepto::firstOrCreate(['concepto'=>$request->concepto])->id;

        $canal->update($request->all() + ['tipo_concepto_id'=>$conceptoId]);

           
        // session()->flash('success', 'Menú actualizado correctamente');
        return response()->json([
            'redirect' => route('telcel.canales.index'),
            'alert'=>'Canal actualizado correctamente'
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


// class Client extends AbstractBrowser
// {
//     protected function doRequest($request): Response
//     {
//         // ... convert request into a response

//         return new Response($content, $status, $headers);
//     }
// }