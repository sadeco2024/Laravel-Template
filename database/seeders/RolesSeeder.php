<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin', 'descripcion' => 'FULL ACCESS']);
        Role::create(['name' => 'Socio', 'descripcion' => 'Socio o dueño de la Empresa']);
        Role::create(['name' => 'Empleado General', 'descripcion' => 'Empleado general de la Empresa']);


        //** */ Se cargan los permisos.
        $jsonData = File::get('resources/data/permisos.json');
        $permisos = json_decode($jsonData, true);
        
        foreach ($permisos as $permiso) {
            Permission::create([
                'name' => $permiso['name'],
                'descripcion' => $permiso['descripcion'],
                'cg_modulo_id' => $permiso['cg_modulo_id'],
                'nombre'=> $permiso['nombre']
            ])->syncRoles(['Super Admin', 'Socio']);            
        }        

        // Permission::create([
        //     'name' => 'confs',
        //     'descripcion' => 'Menú de configuraciones del sistema.',
        //     'cg_modulo_id' => 1
        // ])->syncRoles(['Super Admin', 'Socio']);

        // Permission::create([
        //     'name' => 'confs.rol.empleados',
        //     'descripcion' => 'Permite ver los empleados asignados al rol.',
        //     'cg_modulo_id' => 1
        // ])->syncRoles(['Super Admin', 'Socio']);

        // Permission::create([
        //     'name' => 'confs.rol.permisos',
        //     'descripcion' => 'Permite ver los permisos asignados al rol.',
        //     'cg_modulo_id' => 1
        // ])->syncRoles(['Super Admin', 'Socio']);

        // Permission::create([
        //     'name' => 'confs.sadmin.permisos.add',
        //     'descripcion' => 'Agregar nuevo permiso al sistema.',
        //     'cg_modulo_id' => 1
        // ])->syncRoles(['Super Admin', 'Socio']);

        // Permission::create([
        //     'name' => 'rh.empleados',
        //     'descripcion' => 'Ver la lista de empleados.',
        //     'cg_modulo_id' => 2
        // ])->syncRoles(['Super Admin', 'Socio']);     
        
        // Permission::create([
        //     'name' => 'erp.articulos',
        //     'descripcion' => 'Ver la lista de artículos.',
        //     'cg_modulo_id' => 3
        // ])->syncRoles(['Super Admin', 'Socio']);          

        
    }
}
