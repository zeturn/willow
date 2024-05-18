import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import react from "@vitejs/plugin-react";

export default defineConfig({
    server: {
        host: '127.0.0.1',  // Add this to force IPv4 only
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                "resources/js/app.jsx",
                "resources/js/app_editor.js",
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
        react(),
    ],
});



