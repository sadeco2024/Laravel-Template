<?php

namespace Database\Factories\Generales;

use App\Models\Generales\Ciudad;
use App\Models\Generales\Estado;
use App\Models\Generales\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generales\Rfc>
 */
class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


        return [
            'calle'=>$this->faker->streetName,
            'numero_exterior'=>$this->faker->buildingNumber,
            'numero_interior'=>$this->faker->buildingNumber,
            'colonia'=>$this->faker->streetName,
            'codigo_postal'=>$this->faker->regexify('[0-9]{5}'),
            'ciudad_id'=>Ciudad::all()->random()->id,
            'estado_id'=>Estado::all()->random()->id,
            'municipio_id'=>Municipio::all()->random()->id,
            'ubicacion' => implode(',',$this->faker->localCoordinates()) 
            //quiero que el faker localCoordinates me de un array con dos valores, pero no se como hacerlo


        ];
    }
}
