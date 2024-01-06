<?php

namespace Database\Factories\Generales;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generales\Rfc>
 */
class CurpFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'curp' => $this->faker->regexify('[A-Z]{4}[0-9]{6}[A-Z]{6}[0-9]{2}')
        ];
    }
}
