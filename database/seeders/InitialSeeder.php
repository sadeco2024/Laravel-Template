<?php

namespace Database\Seeders;

use App\Models\Data\Estado;
use App\Models\Data\Municipio;
use App\Models\Generales\Ciudad;
use App\Models\Generales\Concepto;
use App\Models\Generales\Direccion;
use App\Models\Generales\Estatus;
use App\Models\Generales\Referencia;
use App\Models\Generales\Rfc;
use App\Models\Generales\Telefono;
use App\Models\Rh\Puesto;
use App\Models\Rh\Sucursal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        //** Se cargan los estados.
        $jsonData = File::get('resources/data/estados.json');
        $estados = json_decode($jsonData, true);
        foreach ($estados as $estado) {
            Estado::create([
                'estado' => $estado['ENTIDAD_FEDERATIVA'],
                'clave' => $estado['CATALOG_KEY'],
                'abreviatura' => $estado['ABREVIATURA'],
            ]);
        }

        //** */ Se cargan los municipios.
        $jsonData = File::get('resources/data/municipios.json');
        $municipios = json_decode($jsonData, true);
        foreach ($municipios as $municipio) {
            $estado = Estado::where('clave', $municipio['EFE_KEY'])->first();
            Municipio::create([
                'municipio' => $municipio['MUNICIPIO'],
                'clave' => $municipio['CATALOG_KEY'],
                'estado_id' => $estado->id,
            ]);
        }


        //* RFC - Genérico 
        Rfc::create([
            'rfc' => 'XAXX010101000'
        ]);


        //* Se generan los puestos iniciales.
        // $puestos = ["director general", "empleado general"];
        // foreach ($puestos as $puesto) {
        //     Puesto::create([
        //         'puesto' => $puesto,
        //     ]);
        // }

        //* SE GENERAL EL ALMACEN GENERAL.
        Sucursal::create([
            'nombre' => 'Almacén General',
            'telefono_id' => Telefono::firstOrCreate(['telefono' => '9993665532'])->id,
            'direccion_id' => Direccion::firstOrCreate([
                'calle' => 'Calle #1',
                'numero_exterior' => '1',
                'numero_interior' => 'sne',
                'colonia' => 'Col. Centro',
                'codigo_postal' => '12345',
                'ciudad_id' => Ciudad::firstOrCreate([
                    'ciudad' => 'Mérida',
                    'abreviatura' => 'MER',
                    'municipio_id'=> Municipio::where('municipio', 'MERIDA')->first()->id,
                    'estado_id' => Estado::where('estado', 'YUCATÁN')->first()->id,
                ])->id,
                'estado_id' => Estado::where('estado', 'YUCATÁN')->first()->id,
                'municipio_id' => Municipio::where('municipio', 'MERIDA')->first()->id,
                'referencia_id' => Referencia::firstOrCreate(['referencia' => 'Oficina Central'])->id,            
            ])->id,
            'ubicacion' => json_encode([
                'latitud' => '21.0245',
                'longitud' => '-89.6165',
            ]),
            'estatus_id' => Estatus::firstOrCreate(['estatus' => 'activo'])->id,
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'Almacén'])->id
        ]);
        // Se crea el concepto de Tienda.
        Concepto::create([
            'concepto' => 'Tienda',
        ]);

        //* Se generan los estatus uitilizados en el sistema.
        $estatus = ["activo","inactivo", "suspendido", "baja"];
        //, "pendiente", "rechazado", "aceptado", "cancelado", "finalizado", "en proceso", "en espera", "en revisión", "en trámite", "en análisis", "en validación", "en aprobación", "en autorización", "en ejecución"
        foreach ($estatus as $estatus) {
            Estatus::firstOrCreate([
                'estatus' => $estatus,
            ]);
        }        



    }
}
