<?php

namespace App\Http\Controllers;

use App\Models\Erp\Articulo;
use App\Models\Generales\Estado;
use App\Models\Generales\Municipio;
use App\Models\Rh\Sucursal;
use Illuminate\Http\Request;

class GeneralesController extends Controller
{
    public function getMunicipios( $id)
    {
        $municipios = Municipio::with(["estado"])->where('estado_id',$id)->orderBy('municipio')->get();
        
        return $municipios;
        return response()->json($municipios);
    }

    public function getArticulos(Request $request) {
        if ($request->ajax()) {
            $data = Articulo::with('categoria.lineas')
            ->where('nombre', 'LIKE', '%' . $request->search . "%")
            ->paginate(20);
            return view('erp.articulos.articulo', compact('data'))->render();
        }        
    }
}
