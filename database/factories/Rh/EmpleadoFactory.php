<?php

namespace Database\Factories\Rh;

use App\Models\Generales\Correo;
use App\Models\Generales\Direccion;
use App\Models\Generales\Estatus;
use App\Models\Generales\Nombre;
use App\Models\Generales\Telefono;
use App\Models\Rh\Empleado;
use App\Models\Rh\Puesto;
use App\Models\Rh\Rhextra;
use App\Models\Rh\Sucursal;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generales\Rfc>
 */
class EmpleadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        //** El "user_id", se genera desde el seed que carga el factory porque deben ser únicos. */
        // $user = User::factory()->create();
        
        return [
            'user_id' => User::factory()->create()->id,
            'nombre_id' => Nombre::factory()->create()->id,
            'fecha_nacimiento' => $this->faker->date(),
            'fecha_ingreso' => $this->faker->date(),
            'genero' => $this->faker->randomElement(['F','M','GF','NB','I','O']),
            'telefono_id' => Telefono::factory()->create()->id,
            'correo_id' => Correo::firstOrCreate(['correo'=> User::latest()->first()->email,])->id,
            'corpo_telefono_id' => Telefono::factory()->create()->id,
            'corpo_correo_id' => Correo::create(['correo'=>$this->faker->unique()->safeEmail])->id,
            'no_empleado' => $this->faker->numberBetween(1000, 9999),            
            'sucursal_id' => Sucursal::all()->random()->id,
            'direccion_id' => Direccion::factory()->create()->id,
            'estatus_id' => Estatus::firstOrCreate(['estatus'=> $this->faker->randomElement(['activo','suspendido','baja'])])->id,
            'puesto_rh_extra_id'=> Rhextra::where('concepto','puesto')->get()->random()->id
            
        ];
    }
}
