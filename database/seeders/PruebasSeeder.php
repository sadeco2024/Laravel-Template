<?php

namespace Database\Seeders;

use App\Models\Generales\Ciudad;
use App\Models\Generales\Curp;
use App\Models\Generales\Direccion;
use App\Models\Generales\Nombre;
use App\Models\Generales\Rfc;
use App\Models\Generales\Telefono;
use App\Models\Rh\Empleado;
use App\Models\Rh\Puesto;
use App\Models\Rh\Sucursal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::factory()->count(60)->create();

        Rfc::factory()->count(15)->create();
        Curp::factory()->count(15)->create();
        Telefono::factory()->count(15)->create();
        Nombre::factory()->count(15)->create();
        Ciudad::factory()->count(15)->create();
        Direccion::factory()->count(15)->create();
        Sucursal::factory()->count(9)->create();


        
        // Se crea el del perfil de administrador
        Empleado::factory()->create(['user_id' => 1,'puesto_id' => Puesto::firstOrCreate(['puesto' => 'director general'])->id]);

        $userIds = User::where('id','<>','1')->pluck('id')->shuffle();

        $puesto = Puesto::firstOrCreate(['puesto' => 'empleado general'])->id;
        for ($i = 0; $i < 10; $i++) {
            Empleado::factory()->create(['user_id' => $userIds->pop(),'puesto_id'=> $puesto]);
        }        
    }
}
