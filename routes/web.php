<?php

use App\Http\Controllers\Configuraciones\MenuController;
use App\Http\Controllers\Erp\ErpController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rh\EmpleadoController;
use App\Models\Configuraciones\Menu;
use App\Models\Rh\Empleado;
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
    // return view('welcome');
});


// Route::get('/dashboard', function () {
//     return view('dashboard',['title'=>'Dashboard']);
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    
    
    //** Rutas de configuraciones */
    Route::get('/dashboard',[MenuController::class, 'index'])->name('dashboard');

    //** Rutas de RH */
    Route::get('/empleados',[EmpleadoController::class, 'index'])->name('empleados');
    Route::get('/empleados/create',[EmpleadoController::class, 'create'])->name('empleados.create');
    Route::get('/empleados/edit',[EmpleadoController::class, 'create'])->name('empleados.edit');
    Route::get('/empleados/change-passwd',[EmpleadoController::class, 'changePassd'])->name('empleado.change-passwd');

    //** Rutas ERP */
    Route::get('/erp',[ErpController::class, 'index'])->name('erp');


    //!!Ruta en blanco.
    Route::get('/empty',function() { 
        $menus = Menu::all();
        return view('empty',compact('menus')); 
    })->name('empty');

    // Route::get('/empleados',[EmpleadoController::class, 'list'])->name('rh.empleados');

    // Route::get('/empleado',[EmpleadoController::class, 'index'])->name('rh.empleado');
    // Route::get('/empleado/editar/{$id}',[EmpleadoController::class, 'edit'])->name('rh.empleado.edit');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
});

require __DIR__.'/auth.php';
