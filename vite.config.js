import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
        {
            name: 'normalize-manifest',
            closeBundle() {
                const manifestPath = path.resolve(__dirname, 'public/build/manifest.json');
                if (fs.existsSync(manifestPath)) {
                    let raw = fs.readFileSync(manifestPath, 'utf-8');
                    const normalized = raw.replace(/[A-Za-z]:\/[^"]*?resources\//g, 'resources/');
                    fs.writeFileSync(manifestPath, normalized);
                    console.log('✓ Normalized Vite manifest keys for Laravel');
                }
            }
        }
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
