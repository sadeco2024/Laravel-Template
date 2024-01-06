<?php

namespace App\Http\Controllers\Erp;

use App\Http\Controllers\Controller;
use App\Models\Configuraciones\Menu;
use Illuminate\Http\Request;

class ErpController extends Controller
{
    public function index()
    {

        $menus = Menu::menus()->get();
        return view('erp.index', compact('menus'));
    }
}
