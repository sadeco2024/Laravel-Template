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


        // Crear array de 20 nombres latinos
        
        $nombres = [
            "Juan", "María", "Pedro", "Ana", "Luis", "Laura", "Carlos", "Sofía", "Miguel", "Isabella",
            "José", "Valentina", "Antonio", "Camila", "Francisco", "Lucía", "Javier", "Valeria", "Diego", "Emma"
        ];
        // Crear array de segundos nombres
        $segundos = [
            "Alejandro", "Gabriela", "Daniel","", "Fernanda", "Andrés", "Valentina", "Sebastián", "Paula", "Emilio", "Renata",
            "Ricardo", "Daniela", "Hugo","", "Mariana", "Jorge", "Isabel", "Roberto", "Carolina", "Eduardo", "Natalia"
        ];        

        // Crear array de apellido paterno
        $paterno = [
            "González", "Rodríguez", "López", "Martínez", "Pérez", "Gómez", "Hernández", "Sánchez", "Fernández", "Torres",
            "Ramírez", "Flores", "Rivera", "Vargas", "Cruz", "Reyes", "Morales", "Ortega", "Castillo", "Romero"
        ];
        // Crear array de apellido materno
        $materno = [
            "García", "Hernández", "González", "López", "Martínez", "Pérez", "Rodríguez", "Sánchez", "Torres", "Vargas",
            "Flores", "Cruz", "Reyes", "Morales", "Ortega", "Castillo", "Romero", "Fernández", "Ramírez", "Rivera"
        ];

        // $curps = Curp::all()->pluck('id')->toArray();

        return [
            'nombre' => $nombres[array_rand($nombres)] . ' '. $paterno[array_rand($paterno)] . ' ' . $materno[array_rand($materno)],
            'primer_nombre' => $nombres[array_rand($nombres)],
            'segundo_nombre' =>  $segundos[array_rand($segundos)],
            'paterno' => $paterno[array_rand($paterno)],
            'materno' => $materno[array_rand($materno)],
            'curp_id' => Curp::factory()->create()->id,
            
        ];
    }
}
