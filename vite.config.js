import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host:true,
        watch: {
            ignored: [
                '**/glibc-2.28/**', // Ignorar el directorio glibc-2.28
                '**/node_modules/**', // Por seguridad, también ignoramos node_modules
            ],
        },
    },
});
