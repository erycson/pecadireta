import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import preact from '@preact/preset-vite';

export default defineConfig({
    plugins: [
        preact({devtoolsInProd: true}),
        laravel({
            input: [
                'resources/css/painel/global.scss',
                'resources/js/painel/global.js',
                'resources/js/painel/ceps/editar.jsx',
                'resources/js/painel/modelos/editar.jsx',
                'resources/js/painel/usuarios/editar.jsx',
                'resources/js/painel/fornecedores/editar.jsx',
            ],
            buildDirectory: 'build',
            refresh: true,
        }),
    ],
});
