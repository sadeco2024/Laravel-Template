<?php

namespace App\Http\Controllers\Generales;

use App\Http\Controllers\Controller;
use App\Models\Telcel\Canal;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class DataTableController extends Controller
{
    //
    public function canalesTelcel()
    {

        $canales = Canal::canalesDatatable(); 
        // dd($canales);
        return response()->json($canales);
    }
}


