<?php

use App\Http\Controllers\Configuraciones\MenuController;
use App\Http\Controllers\Confs\PermisoController;
use App\Http\Controllers\Confs\RoleController;
use App\Http\Controllers\Erp\ArticuloController;
use App\Http\Controllers\Generales\DataTableController;
use App\Http\Controllers\GeneralesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rh\EmpleadoController;
use App\Http\Controllers\Rh\SucursalController;
use App\Http\Controllers\RhExtraController;
use App\Http\Controllers\Telcel\ActivacionController;
use App\Http\Controllers\Telcel\CanalController;
use App\Http\Controllers\Telcel\DescargaActivacionesController;
use App\Models\Configuraciones\Menu;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('comming-soon');
});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('confs/roles', RoleController::class)->names('confs.roles');
    Route::resource('/confs/roles/permisos', PermisoController::class)->names('confs.roles.permissions');

    //** Rutas CONFIGURACIONES */
    Route::resource('confs/menus', MenuController::class)->names('confs.menus');

    //** Rutas de RH */
    Route::resource('rh/sucursales', SucursalController::class)->names('rh.sucursales');
    Route::resource('rh/empleados', EmpleadoController::class)->names('rh.empleados');
    Route::get('rh/empleados/table', [GeneralesController::class, 'tablaEmpleados'])->name('rh.empleados.table');


    //** Rutas de ERP */
    Route::resource('erp/articulos', ArticuloController::class)->names('erp.articulos');
    Route::resource('erp/inventario', ArticuloController::class)->names('erp.inventario');


    //** Rutas de Telcel::Canales */
    // Route::resource('telcel/canales', CanalController::class)->names('telcel.canales');
    Route::resource('telcel/canales', CanalController::class)->only(['index', 'show', 'store', 'update', 'destroy','edit'])->names('telcel.canales');
    Route::get('telcel/refresh/canales', [CanalController::class,'actualiza'])->name('telcel.canales.refresh');
    Route::get('telcel/setquestion/canales/{canal}', [CanalController::class,'setQuestion'])->name('telcel.canales.setquestion');
    Route::get('telcel/sincrcox/canales/{canal}', [CanalController::class,'getVendedores'])->name('telcel.canales.sincrcox');
    Route::get('telcel/reset/canales/{canal}', [CanalController::class,'resetAcox'])->name('telcel.canales.reset');
    Route::get('telcel/reset/canal/vendedor/{vendedor}', [CanalController::class,'resetRcox'])->name('telcel.canales.reset.rcox');
    
    //** Rutas Telcel::Prepago */
    Route::resource('telcel/activaciones',ActivacionController::class)->only(['index', 'show', 'store', 'update', 'destroy','edit'])->names('telcel.activaciones');
    Route::post('telcel/activaciones/grafica',[ActivacionController::class,'grafica'])->name('telcel.activaciones.grafica');
    Route::post('telcel/activaciones/grafica/diario', [ActivacionController::class, 'graficaDiario'])->name('telcel.activaciones.grafica.diario');
    Route::post('telcel/activaciones/compara',[ActivacionController::class,'compara'])->name('telcel.activaciones.compara');
    Route::post('telcel/activaciones/comparadiario',[ActivacionController::class,'comparaDiario'])->name('telcel.activaciones.compara.diario');
    Route::post('telcel/activaciones/resumen',[ActivacionController::class,'resumen'])->name('telcel.activaciones.compara');
    

    Route::resource('telcel/activaciones/download', DescargaActivacionesController::class)->names('telcel.activaciones.download');

    


    //* Rutas de Generales
    Route::group(['prefix' => 'generales'], function () {
        Route::get('/getMunicipios/{id}', [GeneralesController::class, 'getMunicipios'])->name('getMunicipios');
        Route::get('/getEmpleados', [EmpleadoController::class, 'tablaEmpleados'])->name('getEmpleados');
        Route::post('/setRhExtras', [RhExtraController::class, 'store'])->name('set.rhextras');
        Route::get('/getRhExtras', [RhExtraController::class, 'getRhextras'])->name('get.rhextras');
        Route::get('/getArticulos', [GeneralesController::class, 'getArticulos'])->name('get.articulos');

        
    });

    //* Rutas de TABLAS de los index.
    Route::group(['prefix' => 'tables'], function () {
        Route::get('/telcel/canales', [DataTableController::class, 'canalesTelcel'])->name('tabla.telcel.canales');
        // Route::get('/getEmpleados', [EmpleadoController::class, 'tablaEmpleados'])->name('getEmpleados');
        // Route::post('/setRhExtras', [RhExtraController::class, 'store'])->name('set.rhextras');
        // Route::get('/getRhExtras', [RhExtraController::class, 'getRhextras'])->name('get.rhextras');
        // Route::get('/getArticulos', [GeneralesController::class, 'getArticulos'])->name('get.articulos');

        
    });



    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados');
    Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::get('/empleados/edit', [EmpleadoController::class, 'create'])->name('empleados.edit');
    Route::get('/empleados/change-passwd', [EmpleadoController::class, 'changePassd'])->name('empleado.change-passwd');

    //** Rutas ERP */
    // Route::get('/erp', [ErpController::class, 'index'])->name('erp');
    // Route::get('/erp/articulos', [ErpController::class, 'articulos'])->name('erp.articulos');


    //!!Ruta en blanco.
    Route::get('/empty', function () {
        $menus = Menu::all();
        return view('empty', compact('menus'));
    })->name('empty');

    // Route::get('/empleados',[EmpleadoController::class, 'list'])->name('rh.empleados');

    // Route::get('/empleado',[EmpleadoController::class, 'index'])->name('rh.empleado');
    // Route::get('/empleado/editar/{$id}',[EmpleadoController::class, 'edit'])->name('rh.empleado.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
