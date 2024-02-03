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
            "José", "Valentina", "Antonio", "Camila", "Francisco", "Lucía", "Javier", "Valeria", "Diego", "Emma",
            "Andrés", "Renata", "Ricardo", "Daniela", "Hugo", "Mariana", "Jorge", "Isabel", "Roberto", "Carolina"
        ];

        // Crear array de segundos nombres
        $segundos = [
            "Alejandro", "Gabriela","", "Daniel", "", "Fernanda", "Valentina", "Sebastián", "Paula", "Emilio", "Natalia",
            "Hugo", "Mariana", "Jorge", "Isabel", "Roberto", "Carolina", "Eduardo", "Renata", "Ricardo", "Daniela","",
            "Gustavo", "Adriana", "Arturo", "Catalina", "Federico", "Beatriz", "Guillermo", "Patricia", "Ignacio", "Olivia", "Vladimir", ""
        ];

        // Crear array de apellido paterno
        $paterno = [
            "González", "Rodríguez", "López", "Martínez", "Pérez", "Gómez", "Hernández", "Sánchez", "Fernández", "Torres",
            "Ramírez", "Flores", "Rivera", "Vargas", "Cruz", "Reyes", "Morales", "Ortega", "Castillo", "Romero",
            "Álvarez", "Mendoza", "Chávez", "Rojas", "Medina", "Silva", "Ríos", "Navarro", "Cortés", "Acosta"
        ];

        // Crear array de apellido materno
        $materno = [
            "García", "Hernández", "González", "López", "Martínez", "Pérez", "Rodríguez", "Sánchez", "Torres", "Vargas",
            "Flores", "Cruz", "Reyes", "Morales", "Ortega", "Castillo", "Romero", "Fernández", "Ramírez", "Rivera",
            "Álvarez", "Mendoza", "Chávez", "Rojas", "Medina", "Silva", "Ríos", "Navarro", "Cortés", "Acosta","","Sánchez"
        ];


        $idxNombre = rand(0, count($nombres) - 1); 
        $idxSegundo = rand(0, count($segundos) - 1); 
        $idxPaterno = rand(0, count($paterno) - 1); 
        $idxMaterno = rand(0, count($materno) - 1); 

        

        return [
            // 'nombre' => $nombres[array_rand($nombres)] . ' '. $paterno[array_rand($paterno)] . ' ' . $materno[array_rand($materno)],
            'nombre' => $nombres[$idxNombre] . ' '. $paterno[$idxPaterno] . ' ' . $materno[$idxMaterno],
            'primer_nombre' => $nombres[$idxNombre],
            'segundo_nombre' =>  $segundos[$idxSegundo],
            'paterno' => $paterno[$idxPaterno],
            'materno' => $materno[$idxMaterno],
            'curp_id' => Curp::factory()->create()->id,
            
        ];
    }
}
