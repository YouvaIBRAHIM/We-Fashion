import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/guestApp.js',
                'resources/css/styles.css',
                'resources/css/clientStyles.css',
            ],
            refresh: true,
        }),
    ],
});
