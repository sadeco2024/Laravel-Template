import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/guest.js',
                'resources/css/guest.css',
                'resources/js/coming-soon.js',   
                'resources/theme/js/show-password.js',
                'resources/css/auth.css',
                "resources/js/auth.js",
                'resources/js/funciones.js',
                'resources/js/alerts.js',
                'resources/js/modales.js',
                'resources/js/datatables.js',
                'resources/js/sucursales.js'
           ],
            refresh: true,
        }),
    ],

 
});
