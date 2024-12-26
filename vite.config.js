import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/navbar.css', 'resources/js/home.js'],
            refresh: true,
        }),
    ],
});
