import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/filterForm.js', 'resources/js/createInsectForm.js', 'resources/js/bootstrap.js', 'resources/js/modal.js', ],
            refresh: true,
        }),
    ],
});