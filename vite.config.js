import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        // laravel({
        //     input: ['resources/css/app.css', 'resources/js/app.js'],
        //     refresh: true,
        // }),
        laravel([
            'resources/css/app.css',
            'resources/css/loginRegister.css',
            'resources/css/addMusic.css',
            'resources/js/app.js',
        ])
    ],
});
