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
        Role::create(['name'=>'supadmin','nombre' => 'Super Admin', 'descripcion' => 'FULL ACCESS']);
        Role::create(['name'=>'socio','nombre' => 'Socio', 'descripcion' => 'Socio o dueño de la Empresa']);
        Role::create(['name'=>'empleado','nombre' => 'Empleado General', 'descripcion' => 'Empleado general de la Empresa']);


        //** */ Se cargan los permisos.
        $jsonData = File::get('resources/data/permisos.json');
        $permisos = json_decode($jsonData, true);
        
        foreach ($permisos as $permiso) {
            Permission::create([
                'name' => $permiso['name'],
                'descripcion' => $permiso['descripcion'],
                'cg_modulo_id' => $permiso['cg_modulo_id'],
                'nombre'=> $permiso['nombre']
            ])->syncRoles(['supadmin', 'socio']);            
        } 
       
    }
}
