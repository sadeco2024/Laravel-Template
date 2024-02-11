<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Erp\Articulo;
use App\Models\Rh\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Articulo::with('categoria.lineas')->paginate(20);
        // return $data;

        return view('erp.articulos.index', ['title' => 'Articulos'])->with(['success'=>'El modal de artículos está en desarrollo y no se puede usar por el momento.']);
    }

    public function search(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Articulo::with('categoria.lineas')->paginate(20);
            return view('erp.articulos.articulos', compact('data'))->render();
            // $data = Sucursal::where('nombre', 'LIKE', '%' . $request->search . "%")->get();
            return $data;
        }
    }

    public function buscar(Request $request) {
         
        if ($request->ajax()) {
            
            // $data = Sucursal::where('nombre', 'LIKE', '%' . $request->search . "%")->get();
            $data = Sucursal::where('nombre', 'LIKE', '%' . $request->search . "%")->paginate(10);
            // return $data;
            return view('erp.articulos.articulos', compact('data'))->render();


            // return $data;
            $output = '';
            if (count($data) > 0) {
                $output = '<ul class="list-group" style="display:block; position:relative; z-index:1;">';
                foreach ($data as $row) {
                    $output .= '<li class="list-group-item">' . $row->nombre . '</li>';
                }
                $output .= '</ul>';
            } else {
                $output .= '<li class="list-group-item">' . 'No se encontraron resultados' . '</li>';
            }
            return $output;
        }
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
        $request->validate([
            'nombre' => 'required',
            'categoria_linea_id' => 'required',
        ]);
        // return $request->all();
        // $validator = Validator::make($request->all(), [
        //     'nombre' => 'required',
        //     'clave_principal' => 'required',
        //     'costo'=> 'required|float',
        //     'precio'=> 'required|float',

        // ]);        
        // return $validator->errors();

        // if ($request->ajax()) {
        //     // Check if there are validation errors
            
 

        //     // Update the resource
        //     // ...

        //     return response()->json(['success' => 'Resource updated successfully']);
        // }
        return redirect()->route('erp.articulos.index')->with('success', 'Artículo actualizado correctamente');
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
        $articulo = Articulo::find($id);
        return view('erp.articulos.edit', ["articulo"=>$articulo]); //->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'nombre' => 'required',
        //     'categoria_linea_id' => 'required',
        // ]);
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'linea_articulo' => 'required',
        ]);
    
        if ($validator->fails()) {
            $articulo = Articulo::find($id);
            // $errors = $validator->errors(); // Obtén los errores del validador
            // $errors = new \Illuminate\Support\MessageBag($validator->errors()); // Convierte los errores a MessageBag
            $errors = new \Illuminate\Support\MessageBag($validator->errors()->getMessages()); // Convierte los errores a MessageBag

            return response()->json([
                'view' => view('erp.articulos.edit', ["articulo"=>$articulo, 'errors' => $errors])->render(),
                'errors' => $errors
            ]);

            // return view('erp.articulos.edit', ["articulo"=>$articulo, 'errors' => $errors])->render();

            // return response()->view('erp.articulos.edit', ["articulo"=>$articulo])->withErrors($validator)->render();
        }


        return response()->json();

        return redirect()->route('erp.articulos.index')->with('success', 'Artículo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
