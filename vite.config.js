import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // Ini memungkinkan impor gambar dari JS/Blade via asset()
    build: {
        assetsInlineLimit: 0, // opsional: agar gambar tidak di-inline sebagai base64
    }
});