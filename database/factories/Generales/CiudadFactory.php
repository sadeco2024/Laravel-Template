<?php

namespace Database\Factories\Generales;

use App\Models\Generales\Estado;
use App\Models\Generales\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Generales\Rfc>
 */
class CiudadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ciudades = [
            "Ciudad de México",
            "Guadalajara",
            "Monterrey",
            "Puebla",
            "Tijuana",
            "León",
            "Zapopan",
            "Querétaro",
            "San Luis Potosí",
            "Aguascalientes",
            "Hermosillo",
            "Saltillo",
            "Mexicali",
            "Culiacán",
            "Chihuahua",
            "Morelia",
            "Veracruz",
            "Villahermosa",
            "Toluca",
            "Durango",
            "Zacatecas",
            "Oaxaca",
            "Mazatlán",
            "La Paz",
            "Nuevo Laredo",
            "Ciudad Juárez",
            "Tampico",
            "Irapuato",
            "Tuxtla Gutiérrez",
            "Ensenada",
            "Acapulco",
            "Cancún",
            "Coatzacoalcos",
            "Campeche",
            "Piedras Negras",
            "Reynosa",
            "Matamoros",
            "Los Mochis",
            "Torreón",
            "Gómez Palacio",
            "Ciudad Victoria",
            "Cuernavaca",
            "Pachuca",
            "Orizaba",
            "Xalapa",
            "Celaya",
            "San Juan del Río",
            "Ciudad Obregón",
            "Navojoa"
        ];

        return [
            'ciudad' => $this->faker->unique()->randomElement($ciudades),
            'abreviatura' => $this->faker->unique()->stateAbbr,
            'municipio_id' => Municipio::all()->random()->id,
            'estado_id' => Estado::all()->random()->id
        ];
    }
}
