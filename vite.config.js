import laravel from 'laravel-vite-plugin';
import { defineConfig } from 'vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // CSS files
                'resources/css/customizedColor.css'
                ,'resources/css/find-roommate-or-tenant.css'
                ,'resources/css/Login.css'
                ,'resources/css/navbar.css'
                ,'resources/css/profile.css'
                ,'resources/css/properties.css'
                ,'resources/css/register.css'
                ,'resources/css/review.css'

                // JS files
                ,'resources/js/edit-form.js'
                ,'resources/js/filter-property.js'
                ,'resources/js/profile.js'
                ,'resources/js/property.js'

                // Images files
                ,'resources/images/icon/location.png'
                ,'resources/images/LoginImage.png'
                ,'resources/images/RentEaseLogo.png'
                ,'resources/images/sampleProfile.png'
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
