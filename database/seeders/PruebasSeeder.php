<?php

namespace Database\Seeders;

use App\Models\Erp\Articulo;
use App\Models\Erp\Categoria;
use App\Models\Erp\Linea;
use App\Models\Generales\Ciudad;
use App\Models\Generales\Estatus;
use App\Models\Generales\Nombre;
use App\Models\Generales\Rfc;
use App\Models\Generales\Telefono;
use App\Models\Rh\Empleado;
use App\Models\Rh\Puesto;
use App\Models\Rh\Rhextra;
use App\Models\Rh\Sucursal;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PruebasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Rfc::factory()->count(15)->create();
        // Telefono::factory()->count(20)->create();
        Ciudad::factory()->count(15)->create();
        Sucursal::factory()->count(10)->create();

        // Se crea el del perfil de administrador
        // ? Fijate que está dentro del array, por lo que si se quita, va a tener problemas.
        // Empleado::factory()->create(['user_id' => 1, 'puesto_rh_extra_id' => Rhextra::firstOrCreate(['concepto' => 'puesto', 'descripcion' => 'director general'])->id, 'sucursal_id' => 1]);
        
        Empleado::factory()->count(50)->create();

        Empleado::all()->each(function ($empleado) {
            $empleado->user->assignRole('empleado');
        });

        //** ERP */
        $lineas = array(
            "Bebidas" => ["Refrescos", "Aguas y jugos", "Cervezas", "Vinos", "Tés"],
            "Carnes y Embutidos" => ["Carnes frescas", "Embutidos", "Pollo", "Pescado", "Salchichonería"],
            "Lácteos" => ["Quesos", "Leche", "Yogures", "Mantequilla", "Crema"],
            "Panadería" => ["Pan fresco", "Galletas", "Pasteles", "Pan integral", "Dulces"],
            "Frutas y Verduras" => ["Frutas frescas", "Verduras", "Enlatados", "Congelados", "Conservas"],
            "Cereales y Granos" => ["Arroces", "Cereales para el desayuno", "Legumbres", "Harinas", "Pasta"],
            "Conservas y Enlatados" => ["Sopas y caldos", "Conservas de vegetales", "Pasta de tomate", "Atún enlatado", "Aceitunas"],
            "Snacks" => ["Papitas", "Chocolates", "Nueces", "Galletas saladas", "Aperitivos"],
            "Dulces y Chocolates" => ["Chocolates y caramelos", "Golosinas", "Miel", "Mermeladas", "Dulces típicos"],
            "Condimentos y Especias" => ["Condimentos", "Especias", "Salsas", "Vinagres", "Aceites"],
            "Aceites y Vinagres" => ["Aceites", "Vinagres", "Aderezos", "Mayonesas", "Aceitunas"],
            "Productos de Limpieza" => ["Limpieza del hogar", "Detergentes", "Suavizantes", "Limpiadores multiusos", "Utensilios de limpieza"],
            "Higiene Personal" => ["Cuidado personal", "Jabones", "Shampoos", "Desodorantes", "Papel higiénico"],
            "Cuidado del Hogar" => ["Artículos de papel", "Toallas", "Pañales", "Servilletas", "Productos para el hogar"],
            "Artículos de Papel" => ["Servilletas", "Papel higiénico", "Toallas de papel", "Pañuelos", "Manteles"],
        );



        $articulos = [
            "Galletas Integrales", "Leche Deslactosada", "Jamón Ahumado", "Refresco de Naranja", "Manzanas Frescas",
            "Pasta de Tomate", "Pan Multigrano", "Yogur Natural", "Cereal de Avena", "Jabón Líquido",
            "Papel Higiénico Suave", "Aceite de Oliva Extra Virgen", "Pescado Congelado", "Café Orgánico",
            "Crema de Cacahuate", "Sopa de Pollo en Lata", "Gel de Ducha", "Galletas Saladas", "Queso Fresco",
            "Arroz Integral", "Nueces y Almendras", "Tomate en Conserva", "Huevos Orgánicos", "Cerveza Artesanal",
            "Detergente Ecológico", "Chocolate Amargo", "Miel de Abeja Pura", "Puré de Manzana", "Aguacates Maduros",
            "Salsa Picante", "Cepillo de Dientes Suave", "Cereales para el Desayuno", "Atún en Aceite",
            "Servilletas Reciclables", "Aceitunas Rellenas", "Caramelos sin Azúcar", "Jugo de Uva Natural",
            "Pasta Dental de Hierbas", "Mantequilla Orgánica", "Cerveza Ligera", "Pepinillos en Vinagre",
            "Golosinas Variadas", "Sal de Mar Fina", "Queso Parmesano", "Pimientos enlatados", "Champú Revitalizante",
            "Cereal de Chocolate", "Papitas de Limón", "Sardinas en Lata", "Pan de Centeno", "Té Verde",
            "Melocotones en Almíbar", "Salsa de Soja", "Yogur Griego", "Pan de Ajo Congelado", "Mandarinas",
            "Aceitunas Negras", "Gaseosa de Limón", "Jabón de Tocador", "Café Instantáneo", "Lechuga Iceberg",
            "Mantequilla de Maní", "Mermelada de Fresa", "Galletas de Avena", "Filetes de Salmón", "Gel de Baño",
            "Cerveza Morena", "Jabón en Barra", "Tocino Ahumado", "Palomitas de Maíz", "Champiñones en Lata",
            "Cereal de Arroz", "Avena Instantánea", "Crema para Afeitar", "Puré de Tomate", "Queso Cheddar",
            "Salsa de Tomate", "Café Descafeinado", "Harina de Trigo", "Aceite de Coco", "Fresas Congeladas",
            "Té de Hierbas", "Helado de Vainilla", "Pasta de Dientes", "Salmón Fresco", "Aceitunas Verdes",
            "Crema para las Manos", "Chocolate con Leche", "Sopa de Tomate", "Pan de Pita", "Galletas de Chocolate",
            "Pan de Maíz", "Filetes de Pollo Congelados", "Zanahorias", "Mayonesa", "Jabón en Gel", "Queso Gouda",
            "Tostadas de Maíz", "Arvejas enlatadas", "Cereal de Trigo", "Gelatina de Frambuesa", "Leche de Coco",
            "Pan Integral", "Salmón enlatado", "Jabón para Ropa", "Cereal de Maíz", "Queso Crema", "Té Negro",
            "Galletas de Mantequilla", "Melón Cantalupo", "Arroz Basmati", "Canela en Polvo", "Crema Agria",
            "Duraznos en Almíbar", "Pasta de Dientes Natural", "Té Chai", "Frijoles Negros enlatados", "Cerveza sin Alcohol",
            "Chocolate Blanco", "Pepitas de Calabaza", "Queso Azul", "Miel de Maple", "Cerveza de Jengibre", "Pan Baguette",
            "Fideos de Huevo", "Mantequilla de Almendra", "Sopa de Verduras en Lata", "Leche Condensada", "Jabón de Lavanda",
            "Tofu", "Queso Suizo", "Pasta de Almendras", "Té de Jazmín", "Arándanos Frescos", "Pesto de Albahaca",
            "Galletas de Avena y Pasas", "Salsa Alfredo", "Harina de Almendras", "Jugo de Arándano", "Vino Tinto",
            "Mantequilla de Nuez", "Fresas", "Sopa de Champiñones en Lata", "Aceitunas Kalamata", "Chips de Tortilla",
            "Pimientos Rojos enlatados", "Salsa de Pimiento Rojo", "Tomates Secos", "Jugo de Piña", "Sopa de Lentejas en Lata",
            "Cerveza de Trigo", "Puré de Mango", "Queso Ricotta", "Champú de Aloe Vera", "Aceite de Sésamo", "Gel de Aloe Vera",
            "Leche de Almendras", "Champú de Coco", "Sopa de Guisantes en Lata", "Cerveza Oscura", "Hummus", "Pan de Canela",
            "Sopa de Calabaza en Lata", "Champú para Bebés", "Champú de Manzanilla", "Galletas de Avena y Chocolate",
            "Galletas Saladas con Queso", "Pan de Ajo", "Sopa de Pollo con Fideos en Lata", "Crema de Espinacas", "Pasta de Curry",
            "Leche Evaporada", "Sopa de Maíz en Lata", "Cereal de Quinua", "Jugo de Granada", "Té de Menta", "Sopa de Almejas en Lata",
            "Leche sin Lactosa", "Champú Anticaspa", "Galletas de Jengibre", "Galletas Saladas con Cebolla", "Sopa de Minestrone en Lata",
            "Galletas de Avena y Miel", "Pan de Centeno", "Sopa de Tomate y Albahaca en Lata", "Queso de Cabra", "Champú Hidratante",
            "Cereal de Espelta", "Galletas de Avena y Nueces", "Sopa de Cebolla en Lata", "Aceite de Aguacate", "Sopa de Garbanzos en Lata",
            "Cerveza de Miel", "Queso Feta", "Sopa de Fideos de Huevo en Lata", "Champú Antigrasa", "Pan de Pasas", "Sopa de Pescado en Lata",
            "Cereal de Kamut", "Galletas de Avena y Plátano", "Sopa de Judías Verdes en Lata", "Queso Panela", "Champú Revitalizante",
            "Pan de Pumpernickel", "Sopa de Maíz Dulce en Lata", "Aceite de Macadamia", "Galletas de Avena y Arándanos", "Sopa de Guisantes y Jamón en Lata",
            "Cereal de Amaranto", "Queso Manchego", "Sopa de Pollo y Arroz en Lata", "Champú para Cabello Teñido", "Pan de Pasas y Nueces",
            "Sopa de Espárragos en Lata", "Aceite de Pistacho", "Galletas de Avena y Canela", "Sopa de Frijoles Negros en Lata",
            "Queso Monterrey Jack", "Champú Nutritivo", "Pan de Trigo Sarraceno", "Sopa de Champiñones y Tocino en Lata",
            "Cereal de Alforfón", "Galletas de Avena y Coco", "Queso Provolone", "Sopa de Alcachofa en Lata", "Aceite de Semillas de Calabaza",
            "Sopa de Garbanzos y Espinacas en Lata", "Champú para Cuero Cabelludo Sensible", "Pan de Espelta", "Cereal de Sorgo",
            "Galletas de Avena y Pasas", "Sopa de Tomate y Albahaca en Lata", "Queso Chihuahua", "Sopa de Lentejas y Tocino en Lata",
            "Champú Reparador", "Aceite de Cártamo", "Sopa de Cebolla Francesa en Lata", "Pan de Maíz", "Cereal de Teff",
            "Galletas de Avena y Chispas de Chocolate", "Sopa de Pescado y Mariscos en Lata", "Queso Asadero", "Aceite de Almendras Dulces",
            "Sopa de Tomate y Pimiento en Lata", "Champú Fortificante", "Cereal de Mijo", "Pan de Espelta y Nueces",
            "Galletas de Avena y Frutos Rojos", "Sopa de Pollo con Verduras en Lata", "Queso Gruyere", "Aceite de Semillas de Uva",
            "Sopa de Albóndigas en Lata", "Champú Voluminizador", "Pan de Avena", "Cereal de Trigo Sarraceno",
            "Galletas de Avena y Manzana", "Sopa de Mariscos en Lata", "Queso Havarti", "Aceite de Semilla de Higo Chumbo",
            "Sopa de Calabaza y Zanahoria en Lata", "Champú sin Sulfatos", "Cereal de Cáñamo", "Pan de Espelta y Pasas",
            "Galletas de Avena y Piña", "Sopa de Frijoles y Chorizo en Lata", "Queso Havarti con Hierbas", "Aceite de Semilla de Uva Orgánico",
            "Sopa de Maíz y Calabacín en Lata", "Champú sin Parabenos", "Cereal de Garbanzos", "Pan de Quinua",
            "Galletas de Avena y Almendras", "Sopa de Pollo con Fideos y Verduras en Lata", "Queso Edam", "Aceite de Semillas de Lino",
            "Sopa de Espinacas y Ricotta en Lata", "Champú para Cuero Cabelludo Seco", "Cereal de Soja", "Pan de Espelta y Amapola",
            "Galletas de Avena y Cacao", "Sopa de Cebada en Lata", "Queso Gouda Ahumado", "Aceite de Semilla de Sésamo",
            "Sopa de Guisantes y Puerros en Lata", "Champú Hidratante para Cuero Cabelludo Seco", "Cereal de Yuca",
            "Pan de Trigo Integral", "Galletas de Avena y Nueces de Macadamia", "Sopa de Pollo con Maíz en Lata",
            "Queso Azul", "Aceite de Semilla de Calabaza", "Sopa de Lentejas y Espinacas en Lata", "Champú Reparador Intensivo",
            "Cereal de Yuca y Plátano", "Pan de Centeno Integral", "Galletas de Avena y Arándanos Secos",
            "Sopa de Pollo con Arroz en Lata", "Queso Fontina", "Aceite de Semilla de Granada",
        ];

        $iconos = [
            "bx bx-cookie", "bx bx-hot", "bx bx-food-menu", "bx bx-pizza", "bx bx-burger",
            "bx bx-coffee", "bx bx-cake", "bx bx-cheese", "bx bx-cherry", "bx bx-egg",
            "bx bx-fish", "bx bx-grape", "bx bx-hamburger", "bx bx-ice-cream", "bx bx-lollipop",
            "bx bx-meat", "bx bx-milk", "bx bx-potato", "bx bx-restaurant", "bx bx-sandwich",
            "bx bx-sausage", "bx bx-smile", "bx bx-watermelon", "bx bx-wine", "bx bx-coffee-alt",
            "bx bx-cup-alt", "bx bx-egg-alt", "bx bx-fish-alt", "bx bx-hamburger-alt", "bx bx-ice-cream-alt",
            "bx bx-lollipop-alt", "bx bx-meat-alt", "bx bx-milk-alt", "bx bx-pizza-alt", "bx bx-potato-alt",
            "bx bx-restaurant-alt", "bx bx-sausage-alt", "bx bx-smile-alt", "bx bx-soda", "bx bx-watermelon-alt",
            "bx bx-wine-alt", "bx bx-bowl", "bx bx-eggplant", "bx bx-bread", "bx bx-cheese-alt",
            "bx bx-cherry-alt", "bx bx-cup", "bx bx-donut", "bx bx-food-basket", "bx bx-milkshake",
        ];


        foreach ($lineas as $index => $row) {
            $linea = Linea::firstOrCreate([
                'linea' => $index,
                'estatus_id' => Estatus::firstOrCreate(['estatus' => 'activo'])->id,
                'icono' => $iconos[array_rand($iconos)],
            ]);

            foreach ($row as $categoria) {
                $categoria = Categoria::firstOrCreate(['categoria' => $categoria, 'estatus_id' => Estatus::firstOrCreate(['estatus' => 'activo'])->id]);
                $categoria->lineas()->attach($linea->id);
                // Se crean los artículos con sus lineas
                for ($i = 0; $i < rand(1, 7); $i++) {
                    $articulo = $articulos[array_rand($articulos)];
                    $articulo = Articulo::firstOrCreate(['nombre' => $articulo, 'categoria_linea_id' => $categoria->id, 'estatus_id' => Estatus::firstOrCreate(['estatus' => 'activo'])->id]);
                }
            }
        }
    }
}
