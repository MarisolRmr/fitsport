import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 
            'resources/js/app.js',
            'resources/css/nucleo-icons.css',
            'resources/css/nucleo-svg.css',
            'resources/css/argon-dashboard-tailwind.css',
            'resources/js/plugins/chartjs.min.js',
            'resources/js/plugins/perfect-scrollbar.min.js',
            'resources/js/argon-dashboard-tailwind.js',
            'resources/js/argon-dashboard-tailwind.min.js'],
            refresh: true,
        }),
    ],
});
