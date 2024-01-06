<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Empty
Breadcrumbs::for('empty', function (BreadcrumbTrail $trail) {
    $trail->push('', route('empty'));
});

// dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->push('', route('dashboard'));
});

// Empleados
Breadcrumbs::for('empleados', function (BreadcrumbTrail $trail) {
    $trail->push('Empleados', route('empleados'));
});

// Empleados > create
Breadcrumbs::for('empleados.create', function (BreadcrumbTrail $trail) {
    $trail->parent('empleados');
    $trail->push('Crear', route('empleados.create'));
});

// Empleados > passwd
Breadcrumbs::for('empleado.change-passwd', function (BreadcrumbTrail $trail) {
    $trail->parent('empleados');
    $trail->push('Contraseña', route('empleado.change-passwd'));
});



Breadcrumbs::for('erp', function (BreadcrumbTrail $trail) {
    // $trail->parent('empleados');
    $trail->push('', route('erp'));
});



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