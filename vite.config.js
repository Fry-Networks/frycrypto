import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import reactRefresh from '@vitejs/plugin-react-refresh';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/custom.css',
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/explorer.js',
            ],
            refresh: true,
        }),
        reactRefresh(),
    ],
    define: {
        global: 'window',
    },
});
