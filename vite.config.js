import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/css/home.css',
                'resources/css/activities.css',
                'resources/js/home.js',
                'resources/js/activities.js',
                'resources/js/activitiesShow.js',
                'resources/js/bookings.js',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
