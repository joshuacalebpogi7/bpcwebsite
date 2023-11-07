import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/app.js',
                'resources/js/design.js',
                'resources/js/resetpass.js',
                'resources/js/post.js',
                'resources/js/main.js',
                'resources/js/lightbox-plus-jquery.js',
                'resources/css/app.css',
                'resources/css/landingpage.css',
                'resources/css/events.css',
                'resources/css/login.css',
                'resources/css/resetpass.css',
                'resources/css/style.css',
                'resources/css/styles.css',
                'resources/css/post.css',
                'resources/css/job.css',
                'resources/css/gallery.css',
                'resources/css/lightbox.css',
                'resources/css/appadmin.css',
                'resources/css/bootstrap.min.css',
            ],
            refresh: true,
        }),
    ],
});