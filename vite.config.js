import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS files
                'resources/css/customizedColor.css'
                ,'resources/css/Login.css'
                ,'resources/css/navbar.css'
                ,'resources/css/profile.css'

                // JS files
                ,'resources/js/profile.js'

                // Images files
                ,'resources/images/RentEaseLogo.png'
                ,'resources/images/sampleProfile.png'
                ,'resources/images/icon/location.png'
                ,'resources/images/propertysample/property1.png'
                ,'resources/images/propertysample/property2.png'
                ,'resources/images/propertysample/property3.png'
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
