import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import reactRefresh from '@vitejs/plugin-react-refresh';
import inject from "@rollup/plugin-inject";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/custom.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        reactRefresh(),
        inject({   // => that should be first under plugins array
            $: 'jquery',
            jQuery: 'jquery',
        }),
    ],
    define: {
        global: 'window',
    },
});
