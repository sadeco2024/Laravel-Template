<?php

namespace Database\Factories\Rh;

use App\Models\Generales\Estatus;
use App\Models\Generales\Nombre;
use App\Models\Generales\Telefono;
use App\Models\Rh\Empleado;
use App\Models\Rh\Puesto;
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
        return [
            // 'user_id' => $userIds->pop(),            
            'nombre_id' => Nombre::all()->random()->id,
            'telefono_id' => Telefono::all()->random()->id,
            'fecha_nacimiento' => $this->faker->date(),
            'fecha_ingreso' => $this->faker->date(),
            'corpo_telefono_id' => Telefono::all()->random()->id,
            'puesto_id'=>2,
            'no_empleado' => $this->faker->numberBetween(1000, 9999),
            'jefe_user_id' => User::all()->random()->id,
            'sucursal_id' => Sucursal::all()->random()->id,
            'estatus_id' => Estatus::firstOrCreate(['estatus'=> $this->faker->randomElement(['activo','suspendido','baja'])])->id,
        ];
    }
}
