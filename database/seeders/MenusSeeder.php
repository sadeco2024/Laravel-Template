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
                'nombre' => 'Confs',
                'icono' => 'bi bi-gear-wide-connected',
                'slug' => 'confs'
            ],            
            [
                'nombre' => 'RH',
                'icono' => 'bi bi-person-bounding-box',
                'slug' => 'rh'
            ],            
            [
                'nombre' => 'ERP',
                'icono' => 'bi bi-bounding-box',
                'slug' => 'erp'
            ],
            [
                'nombre' => 'Telcel',
                'icono' => 'bi bi-align-top',
                'slug' => 'telcel'
            ]            
        ];


        foreach ($modulos as $modulo)
            Modulo::create($modulo);



        Menu::create([
            'nombre' => 'Indicadores',
            'icono' => 'bi bi-house',
            'slug' => 'dashboard',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'dash'])->id,
            'cg_modulo_id' => 1,
            'orden' => 0
        ]);

        Menu::create([
            'nombre' => 'RH',
            'icono' => 'bi bi-person-workspace',
            'slug' => 'rh',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'menu'])->id,
            'cg_modulo_id' => 2,
        ]);
        Menu::create([
            'nombre' => 'Sucursales',
            'icono' => 'bi bi-shop',
            'slug' => 'sucursales',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 2,
            'orden' => 15,
            'padre_cg_menu_id'=>Menu::where('slug', 'rh')->first()->id
        ]);       
        Menu::create([
            'nombre' => 'Empleados',
            'icono' => 'ri-user-settings-line',
            'slug' => 'empleados',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 2,
            'orden' => 1,
            'padre_cg_menu_id'=>Menu::where('slug', 'rh')->first()->id
        ]);               
    
        // Menu::create([
        //     'nombre' => 'RH',
        //     'icono' => 'bi bi-person-workspace',
        //     'slug' => 'empleados.edit',            
        //     'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'interno'])->id,
        //     'cg_modulo_id' => 2,
        // ]);             

        Menu::create([
            'nombre' => 'ERP',
            'slug' => 'erp',
            'icono' => 'bi bi-building',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'menu'])->id,
            'cg_modulo_id' => 3,
        ]);

        Menu::create([
            'nombre' => 'Productos',
            'icono' => 'bi bi-boxes',
            'slug' => 'articulos',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 3,
            'padre_cg_menu_id'=>Menu::where('slug', 'erp')->first()->id
        ]);       
        Menu::create([
            'nombre' => 'Inventario',
            'icono' => 'bi bi-archive-fill',
            'slug' => 'inventario',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 3,
            'padre_cg_menu_id'=>Menu::where('slug', 'erp')->first()->id
        ]);                

        //** Configuraciones */
        Menu::create([
            'nombre' => 'Confs',
            'icono' => 'bi bi-gear-wide-connected',
            'slug' => 'confs',
            'orden'=>999,           
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'menu'])->id,
            'cg_modulo_id' => 1,
        ]);      
        
        Menu::create([
            'nombre' => 'Roles',
            'icono' => 'bi bi-shield-lock',
            'slug' => 'roles',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 1,
            'padre_cg_menu_id'=>Menu::where('slug', 'confs')->first()->id,
            'auth_permisos' => 'confs.role.menu'
        ]);               

        Menu::create([
            'nombre' => 'Menus',
            'icono' => 'bi bi-menu-button',
            'slug' => 'menus',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 1,
            'padre_cg_menu_id'=>Menu::where('slug', 'confs')->first()->id,
            'auth_roles' => 'supadmin',

        ]);       
        

        Menu::create([
            'nombre' => 'getMunicipios/{estado_id}',
            'icono' => 'ri-government-line',
            'slug' => 'getMunicipios',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'interno'])->id,
            'cg_modulo_id' => 1,
            'padre_cg_menu_id'=>Menu::where('slug', 'confs')->first()->id,
            'enabled' => true,
        ]);            

        // ?TELCEL        
        Menu::create([
            'nombre' => 'Telcel',
            'icono' => 'bi bi-align-top',
            'slug' => 'telcel',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'menu'])->id,
            'cg_modulo_id' => 4
        ]);
        Menu::create([
            'nombre' => 'Canales',
            'icono' => 'bi bi-shield-exclamation',
            'slug' => 'canales',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 4,
            'padre_cg_menu_id'=>Menu::where('slug', 'telcel')->first()->id
        ]);    

        Menu::create([
            'nombre' => 'Activaciones',
            'icono' => 'bi bi-archive-fill',
            'slug' => 'activaciones',            
            'tipo_concepto_id' => Concepto::firstOrCreate(['concepto' => 'crud'])->id,
            'cg_modulo_id' => 4,
            'padre_cg_menu_id'=>Menu::where('slug', 'telcel')->first()->id
        ]);            

    }
}
