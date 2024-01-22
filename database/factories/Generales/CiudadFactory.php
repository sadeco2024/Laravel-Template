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
            "Ciudad de México", "Guadalajara", "Monterrey", "Puebla", "Tijuana",
            "Mérida", "Cancún", "Oaxaca", "Veracruz", "Acapulco",
            "Toluca", "Cuernavaca", "Chihuahua", "Saltillo", "Hermosillo",
            "León", "Tuxtla Gutiérrez", "San Luis Potosí", "Morelia", "Culiacán",
            "Pachuca", "Aguascalientes", "Campeche", "Querétaro", "Villahermosa",
            "Durango", "Tampico", "Torreón", "Mazatlán", "Colima",
            "La Paz", "Celaya", "Irapuato", "Tepic", "Chilpancingo",
            "Nuevo Laredo", "Reynosa", "Matamoros", "Coatzacoalcos", "Poza Rica",
            "Ciudad del Carmen", "Minatitlán", "Tapachula", "Tuxtla Chico", "Ixtapa",
            "Zacatecas", "Tlaxcala", "Tlalnepantla", "Coacalco", "Nezahualcóyotl",
            "Ecatepec", "Naucalpan", "Tlalpan", "Chalco", "Texcoco",
            "Iztapalapa", "Xochimilco", "Coyoacán", "Azcapotzalco", "Gustavo A. Madero",
            "Venustiano Carranza", "Benito Juárez", "Álvaro Obregón", "Miguel Hidalgo", "Cuauhtémoc",
            "Iztacalco", "Milpa Alta", "Magdalena Contreras", "Tláhuac", "Huixquilucan",
            "Naucalpan", "Toluca", "Atizapán de Zaragoza", "Nicolas Romero", "Ecatepec",
            "Cuautitlán Izcalli", "Tlalnepantla", "Chimalhuacán", "Nezahualcóyotl", "Los Reyes La Paz",
            "Chalco", "Ixtapaluca", "Valle de Chalco", "La Paz", "Tecámac",
            "Acolman", "Teotihuacán", "Texcoco", "Ixtapan de la Sal", "Tenancingo",
            "Zumpango", "Tultitlán", "Ciudad Nicolás Romero", "Teoloyucan", "Huehuetoca",
            "San Juan del Río", "Huimilpan", "Corregidora", "El Marqués", "Pedro Escobedo"
        ];

        $estado = Estado::noRandom()->inRandomOrder()->first();
        $municipio = Municipio::where('estado_id', $estado->id)->inRandomOrder()->first();
        return [
            'ciudad' => $this->faker->unique()->randomElement($ciudades),
            'abreviatura' => null,
            'municipio_id' => $municipio->id,
            'estado_id' => $estado->id
        ];
    }
}
