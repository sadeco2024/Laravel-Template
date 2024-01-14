<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones\Menu;
use Illuminate\Http\Request;

class ErpController extends Controller
{
    public function index()
    {
        return view('erp.index');
    }

    public function articulos()
    {
        return view('erp.articulos');
    }
    
}
