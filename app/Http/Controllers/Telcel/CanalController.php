<?php

namespace App\Http\Controllers\Telcel;

use App\Http\Controllers\Controller;
use App\Models\ERP\Articulo;
use Illuminate\Http\Request;

use App\Services\Telcel;

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
        return view('telcel.canales.index');
    }

    // Actualiza la tabla de canales
    public function actualiza()
    {
        
        
        // $doc = $this->scrap->login(); // - TERMINADO
        $doc = $this->scrap->getCanales(); 
        
        return $doc;


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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