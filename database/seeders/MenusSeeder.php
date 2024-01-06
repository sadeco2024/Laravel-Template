<?php

namespace Database\Seeders;

use App\Models\Configuraciones\Menu;
use App\Models\Configuraciones\Modulo;
use App\Models\Generales\Concepto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        //** Se generan los conceptos necesarios */
        $conceptos = ['menu','dash','vista','interno','accesos'];
        foreach ($conceptos as $concepto) {
            Concepto::firstOrCreate([
                'concepto' => $concepto,
            ]);
        }        

        //** Se cargan los modulos.
        $modulos = [
            [
                'nombre' => 'Configuraciones',
                'icono' => 'bi bi-bounding-box',
            ],            
            [
                'nombre' => 'RH',
                'icono' => 'bi person-bounding-box',
            ],            
            [
                'nombre' => 'ERP',
                'icono' => 'bi bi-bounding-box',
            ]
        ];


        foreach ($modulos as $modulo)
            Modulo::create($modulo);


        Menu::create([
            'nombre' => 'Indicadores',
            'icono' => 'bi bi-house',
            'ruta' => 'dashboard',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'dash'])->id,
            'cg_modulo_id' => 1,
        ]);

        Menu::create([
            'nombre' => 'RH',
            'icono' => 'bi bi-person-workspace',
            'ruta' => 'empleados',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'dash'])->id,
            'cg_modulo_id' => 2,
        ]);

        Menu::create([
            'nombre' => 'RH',
            'icono' => 'bi bi-person-workspace',
            'ruta' => 'empleados.create',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'interno'])->id,
            'cg_modulo_id' => 2,
        ]);        
        Menu::create([
            'nombre' => 'RH',
            'icono' => 'bi bi-person-workspace',
            'ruta' => 'empleados.edit',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'interno'])->id,
            'cg_modulo_id' => 2,
        ]);             

        Menu::create([
            'nombre' => 'ERP',
            'icono' => 'bi bi-building',
            'ruta' => 'erp',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'menu'])->id,
            'cg_modulo_id' => 3,
        ]);

        Menu::create([
            'nombre' => 'Articulos',
            'icono' => 'bi bi-boxes',
            'ruta' => 'erp.articulos',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'vista'])->id,
            'cg_modulo_id' => 3,
            'padre'=>Menu::where('ruta', 'erp')->first()->id
        ]);        
                

    }
}
