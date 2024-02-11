import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/guest.css',
                'resources/css/auth.css',
                'resources/js/guest.js',
                "resources/js/auth.js",
                'resources/theme/js/show-password.js',
                'resources/js/coming-soon.js',   
                
                'resources/js/funciones.js',
                'resources/js/alerts.js',
                'resources/js/modales.js',
                'resources/js/datatables.js',
                'resources/js/sucursales.js',
                'resources/js/graficas.js',
           ],
            refresh: true,
        }),
    ],

 
});
