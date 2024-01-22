<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.


use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;
use App\Models\Rh\Sucursal;


// Empty
Breadcrumbs::for('empty', function (BreadcrumbTrail $trail) {
    $trail->push('', route('empty'));
});

//** Breads CONFIGURACIONES */
// dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('', route('dashboard'));
});

// ROLES > INDEX
Breadcrumbs::for('confs.roles.index', function (BreadcrumbTrail $trail) {
    $trail->push('Roles', route('confs.roles.index'));
});

// ROLES > SHOW
Breadcrumbs::for('confs.roles.show', function (BreadcrumbTrail $trail, Role $role):void  {
    $trail->parent('confs.roles.index');
    $trail->push('Empleados', route('confs.roles.show',$role));
});

// ROLES > CREATE
Breadcrumbs::for('confs.roles.create', function (BreadcrumbTrail $trail)  {
    $trail->parent('confs.roles.index');
    $trail->push('Crear rol', route('confs.roles.create'));
});

// ROLES > EDIT
Breadcrumbs::for('confs.roles.edit', function (BreadcrumbTrail $trail, Role $role):void  {
    $trail->parent('confs.roles.index');
    $trail->push('Editar rol', route('confs.roles.edit',$role->id));
});

// MENUS
Breadcrumbs::for('confs.menus.index', function (BreadcrumbTrail $trail):void  {
    // $trail->parent('confs.roles.index');
    $trail->push('Menus', route('confs.menus.index'));
});

//** RH -Sucursales */
Breadcrumbs::for('rh.sucursales.index', function (BreadcrumbTrail $trail):void  {
    // $trail->parent('confs.roles.index');
    $trail->push('Sucursales', route('rh.sucursales.index'));
});
Breadcrumbs::for('rh.sucursales.create', function (BreadcrumbTrail $trail):void  {
    $trail->parent('rh.sucursales.index');
    $trail->push('Agregar', route('rh.sucursales.index'));
});

Breadcrumbs::for('rh.sucursales.edit', function (BreadcrumbTrail $trail, $sucursal):void  {
    $trail->parent('rh.sucursales.index');
    $trail->push('Editar rol', route('rh.sucursales.edit',$sucursal));
});

//** RH - Empleados */
Breadcrumbs::for('rh.empleados.index', function (BreadcrumbTrail $trail):void  {
    // $trail->parent('confs.roles.index');
    $trail->push('Empleados', route('rh.empleados.index'));
});
//** RH - Empleados */
Breadcrumbs::for('rh.empleados.create', function (BreadcrumbTrail $trail):void  {
    $trail->parent('rh.empleados.index');
    $trail->push('Agregar', route('rh.empleados.create'));
});
Breadcrumbs::for('rh.empleados.edit', function (BreadcrumbTrail $trail, $empleado):void  {
    $trail->parent('rh.empleados.index');
    $trail->push('Editar', route('rh.empleados.edit',$empleado));
});
Breadcrumbs::for('rh.empleados.show', function (BreadcrumbTrail $trail, $empleado):void  {
    $trail->parent('rh.empleados.index');
    $trail->push('Ver', route('rh.empleados.show',$empleado));
});

//** ERP - ARTICULOS */
Breadcrumbs::for('erp.articulos.index', function (BreadcrumbTrail $trail) {
    // $trail->parent('erp');
    $trail->push('Articulos', route('erp.articulos.index'));
});



//** Telcel - Canales */
Breadcrumbs::for('telcel.canales.index', function (BreadcrumbTrail $trail) {
    // $trail->parent('erp');
    $trail->push('Canales Telcel', route('telcel.canales.index'));
});





// Breadcrumbs::for('confs.roles.show', function (BreadcrumbTrail $trail) {
//     $trail->parent('conf.roles');
//     $trail->push('Lista', route('confs.roles.show'));
// });

// Breadcrumbs::for('confs.roles.show', function (BreadcrumbTrail $trail) {
//     $trail->parent('conf.roles');
//     $trail->push('Ver rol', route('confs.roles'));
// });

// // CONFS
// Breadcrumbs::for('confs', function (BreadcrumbTrail $trail) {
//     $trail->push('Configuraciones', route('confs'), ['icon'=>'bi-gear-wide-connected']);
// });
// // CONFS > ROLES
// Breadcrumbs::for('confs.roles.index', function (BreadcrumbTrail $trail) {
//     $trail->parent('confs'); 
//     $trail->push('Roles', route('confs.roles'),['icon'=>'bi bi-person-gear']);
// });
// // CONFS > ROLES > PERMISOS
// Breadcrumbs::for('confs.roles.permisos', function (BreadcrumbTrail $trail) {
//     $trail->parent('confs.roles'); 
//     $trail->push('Permisos', route('confs.roles'),['icon'=>'bi bi-box-arrow-in-right']);
// });

//** Termina Breads */

// Empleados
Breadcrumbs::for('empleados', function (BreadcrumbTrail $trail) {
    $trail->push('Empleados', route('empleados'),['icon'=>'bi bi-person-workspace']);
});

// Empleados > create
Breadcrumbs::for('empleados.create', function (BreadcrumbTrail $trail) {
    $trail->parent('empleados');
    $trail->push('Crear', route('empleados.create',['icon'=>'bi bi-person-gear']));
});

// Empleados > passwd
Breadcrumbs::for('empleado.change-passwd', function (BreadcrumbTrail $trail) {
    $trail->parent('empleados');
    $trail->push('Contraseña', route('empleado.change-passwd'),['icon'=>'bi bi-person-gear']);
});


// ERP
// Breadcrumbs::for('erp', function (BreadcrumbTrail $trail) {
//     // $trail->parent('empleados');
//     $trail->push('ERP', route('erp'));
// });

// Breadcrumbs::for('erp.articulos', function (BreadcrumbTrail $trail) {
//     $trail->parent('erp');
//     $trail->push('Articulos', route('erp.articulos'));
// });


// ** Anteriores
// Empleados 
// Breadcrumbs::for('rh.empleados', function (BreadcrumbTrail $trail) {
//     $trail->push(__('Employees'), route('rh.empleados'));
// });


// // Empleados 
// Breadcrumbs::for('rh.empleado', function (BreadcrumbTrail $trail) {
//     $trail->push(__('Employee'), route('rh.empleado'));
// });

// // Empleado  > editar
// Breadcrumbs::for('rh.empleado.edit', function (BreadcrumbTrail $trail) {
//     $trail->parent('rh.empleado');
//     $trail->push(__('Edit'), route('rh.empleado.edit'));
// });



// Empleados > Cambiar contraseña
// Breadcrumbs::for('profile.edit', function (BreadcrumbTrail $trail) {
//     $trail->parent('rh.empleado');
//     $trail->push(__('Password'), route('profile.edit'));
// });



// // Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('blog');
//     $trail->push($category->title, route('category', $category));
// });