<?php

namespace Database\Factories\Generales;

use App\Models\Generales\Curp;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generales\Rfc>
 */
class NombreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'primer_nombre' => $this->faker->firstName(),
            'segundo_nombre' => $this->faker->firstName(),
            'paterno' => $this->faker->lastName(),
            'materno' => $this->faker->lastName(),
            'curp_id' => Curp::all()->random()->id
        ];
    }
}
