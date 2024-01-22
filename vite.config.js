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
                'resources/assets/images/brand-logos/logo-70.png',
                'resources/assets/js/coming-soon.js',
                'resources/assets/images/brand-logos/toggle-logo.png',
                'resources/assets/libs/bootstrap/css/bootstrap.min.css',
                'resources/assets/css/styles.css',
                'resources/assets/libs/choices.js/public/assets/scripts/choices.min.js',
                'resources/assets/js/main.js',
                'resources/assets/images/media/loader.svg',
                'resources/assets/images/faces/8.jpg',
                'resources/assets/libs/@popperjs/core/umd/popper.min.js',
                'resources/assets/libs/bootstrap/js/bootstrap.bundle.min.js',
                'resources/assets/js/defaultmenu.min.js',
                'resources/assets/libs/node-waves/waves.min.js',
                'resources/assets/js/sticky.js',
                'resources/assets/libs/simplebar/simplebar.min.js',
                'resources/assets/js/simplebar.js',
                'resources/assets/libs/@simonwep/pickr/pickr.es5.min.js',
                'resources/assets/js/custom-switcher.min.js',
                'resources/assets/js/custom.js',
                'resources/assets/images/brand-logos/desktop-logo-s.png',
                'resources/assets/images/brand-logos/desktop-dark-s.png',
                'resources/assets/images/brand-logos/toggle-dark.png',

            ],

            
            
            refresh: true,
        }),
    ],
});
