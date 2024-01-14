<?php

namespace Database\Factories\Rh;

use App\Models\Generales\Concepto;
use App\Models\Generales\Correo;
use App\Models\Generales\Direccion;
use App\Models\Generales\Estatus;
use App\Models\Generales\Telefono;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rh\Sucursal>
 */
class SucursalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

    
        return [
            'nombre' => $this->faker->company,
            'telefono_id' => Telefono::inRandomOrder()->first()->id,            
            'direccion_id' => Direccion::inRandomOrder()->first()->id,     
            // 'tipo_concepto_id'=> Concepto::inRandomOrder()->first()->id,
            'tipo_concepto_id'=> Concepto::firstOrCreate(['concepto'=>'Tienda'])->id,
            'correo_id'=> Correo::firstOrCreate(['correo'=>$this->faker->unique()->safeEmail])->id,
            // 'ubicacion' => json_encode($this->faker->localCoordinates()),
            'estatus_id'=> Estatus::firstOrCreate(['estatus'=>'activo'])->id
        ];
    }
}
