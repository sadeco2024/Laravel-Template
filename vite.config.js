import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // 'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/guest.js',
                'resources/js/auth-app.js',
                'resources/js/alerts.js',
            ],
            refresh: true,
        }),
    ],
});