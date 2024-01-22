<?php

namespace App\Http\Controllers;

use App\Models\Rh\Rhextra;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RhExtraController extends Controller
{
    public function getRhextras(Request $request)
    {

        // return response()->json([
        //     Rhextra::where('concepto', $request->input('concepto'))->orderBy('descripcion')->get(),
        // ]);        
        return Rhextra::where('concepto', $request->input('concepto'))->orderBy('descripcion')->get();

    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'concepto' => 'required|string|max:20',
                'descripcion' => [
                    'required',
                    Rule::unique('rh_extras')->where(function ($query) use ($request) {
                        return $query->where('concepto', $request->concepto);
                    }),
                ],
            ], [
                'descripcion.unique' => 'Ya existe un '.$request->concepto.' con ese nombre.'
            ]);

            $rhextra = Rhextra::create([
                'concepto' => $request->concepto,
                'descripcion' => $request->descripcion,
            ]);
            return $rhextra; 
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Ya existe un '.$request->concepto.' con ese nombre.',
                'errors' => $e->errors(),
            ], 302);
        }
    }

}
