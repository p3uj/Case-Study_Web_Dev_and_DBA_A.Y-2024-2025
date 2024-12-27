import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/navbar.css',
                'resources/css/customizedColor.css',
                'resources/js/app.js',
                'resources/images/RentEaseLogo.png',
                'resources/images/sampleProfile.png',
            ],
            refresh: true,
        }),
    ],
    build: {
        // Main output directory
        outDir: 'public/build',

        // Organize assets under the 'assets' directory
        assetsDir: 'assets',

        rollupOptions: {
            output: {
                // Organize JavaScript files in the 'js' folder inside assets
                entryFileNames: 'assets/js/[name]-[hash].js',
                chunkFileNames: 'assets/js/[name]-[hash].js',

                // Handle asset files, including images and CSS
                assetFileNames: (assetInfo) => {
                    if (/\.(png|jpg|jpeg|gif|svg)$/.test(assetInfo.name)) {
                        // If it's an image file, place it in the 'assets/images' folder
                        return 'assets/images/[name]-[hash][extname]';
                    }
                    if (/\.css$/.test(assetInfo.name)) {
                        // If it's a CSS file, place it in the 'assets/css' folder
                        return 'assets/css/[name]-[hash][extname]';
                    }
                    // Default for other assets (e.g., fonts, etc.)
                    return 'assets/[name]-[hash][extname]';
                },
            },
        },
    },
});
