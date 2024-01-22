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

        $colonias = [
            "La Roma",
            "Condesa",
            "Polanco",
            "Juárez",
            "Del Valle",
            "Napoles",
            "Lomas de Chapultepec",
            "Santa Fe",
            "Roma Norte",
            "Roma Sur",
            "Centro",
            "Anzures",
            "Doctores",
            "Escandón",
            "San Miguel Chapultepec",
            "Narvarte",
            "Coyoacán",
            "Satélite",
            "La Florida",
            "Del Carmen",
        ];
        
        
        // Array de ciudades
        $ciudades = array(
            "Ciudad de México",
            "Guadalajara",
            "Monterrey",
            "Puebla",
            "Querétaro",
            "Tijuana",
            "Mérida",
            "Cancún",
            "Oaxaca",
            "Veracruz",
            "Acapulco",
            "Toluca",
            "Cuernavaca",
            "Chihuahua",
            "Saltillo",
            "Hermosillo",
            "León",
            "Tuxtla Gutiérrez",
            "San Luis Potosí",
            "Morelia",
        );
        
        // Array de colonias
        $colonias = array(
            "La Roma",
            "Condesa",
            "Polanco",
            "Juárez",
            "Del Valle",
            "Napoles",
            "Lomas de Chapultepec",
            "Santa Fe",
            "Roma Norte",
            "Roma Sur",
            "Centro",
            "Anzures",
            "Doctores",
            "Escandón",
            "San Miguel Chapultepec",
            "Narvarte",
            "Coyoacán",
            "Satélite",
            "La Florida",
            "Del Carmen",
        );
        
        // Array de calles
        $calles = [
            "Reforma","Insurgentes","Juárez",
            "Madero",
            "Álvaro Obregón",
            "Chapultepec",
            "Paseo de la Reforma",
            "Avenida Juárez",
            "Eje Central",
            "Periférico",
            "Constituyentes",
            "Patriotismo",
            "Montejo",
            "Benito Juárez",
            "Lázaro Cárdenas",
            "Zaragoza",
            "16 de Septiembre",
            "Hidalgo",
            "Ocampo",
            "Miguel Hidalgo",
        ];


        $ciudad = Ciudad::factory()->create();     
        return [
            'calle' => $calles[array_rand($calles)],
            'numero_exterior' => $this->faker->buildingNumber,
            'numero_interior' => $this->faker->buildingNumber,
            'colonia' => $colonias[array_rand($colonias)],
            'codigo_postal' => $this->faker->regexify('[0-9]{5}'),
            'ciudad_id' => $ciudad->id,
            'estado_id' => $ciudad->estado_id,
            'municipio_id' => $ciudad->municipio_id,
            'ubicacion' => implode(',', $this->faker->localCoordinates())
        ];
    }
}
