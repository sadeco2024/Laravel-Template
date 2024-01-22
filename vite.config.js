import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/app.js",
                "resources/js/guest.js",
                "resources/js/auth-app.js",
                "resources/js/alerts.js",
                "resources/assets/js/coming-soon.js",
                "resources/assets/libs/bootstrap/css/bootstrap.min.css",
                "resources/assets/css/styles.css",
                "resources/assets/libs/choices.js/public/assets/scripts/choices.min.js",
                "resources/assets/js/main.js",
                "resources/assets/libs/@popperjs/core/umd/popper.min.js",
                "resources/assets/libs/bootstrap/js/bootstrap.bundle.min.js",
                "resources/assets/js/defaultmenu.min.js",
                "resources/assets/libs/node-waves/waves.min.js",
                "resources/assets/js/sticky.js",
                "resources/assets/libs/simplebar/simplebar.min.js",
                "resources/assets/js/simplebar.js",
                "resources/assets/libs/@simonwep/pickr/pickr.es5.min.js",
                "resources/assets/js/custom-switcher.min.js",
                "resources/assets/js/custom.js",
                "resources/assets/js/show-password.js",
                "resources/assets/libs/sweetalert2/sweetalert2.min.css",
                "resources/assets/libs/sweetalert2/sweetalert2.min.js",
                "resources/js/alerts.js",
                "resources/assets/libs/gridjs/gridjs.umd.js",
                "resources/js/tablasGrids.js",
                "resources/assets/css/icons.css",
                "resources/assets/libs/node-waves/waves.min.css",
                "resources/assets/libs/simplebar/simplebar.min.css",
                "resources/assets/libs/flatpickr/flatpickr.min.css",
                "resources/assets/libs/@simonwep/pickr/themes/nano.min.css",
                "resources/assets/libs/choices.js/public/assets/styles/choices.min.css",
                "resources/css/app.css",
            ],

            refresh: true,
        }),
    ],
});
