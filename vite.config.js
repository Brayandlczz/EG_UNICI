import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/sidebar.js',
                'resources/js/ac_docentes.js',
                'resources/css/sidebar.css',
            ],
            refresh: true,
        }),
    ],
});
