<?php

namespace App\Http\Controllers;

use App\Models\Generales\Estado;
use App\Models\Generales\Municipio;
use Illuminate\Http\Request;

class GeneralesController extends Controller
{
    public function getMunicipios( $id)
    {

        
        $municipios = Municipio::with(["estado"])->where('estado_id',$id)->get();
        
        return $municipios;
        return response()->json($municipios);
    }
}
