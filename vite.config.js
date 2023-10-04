import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/auth.scss',
        'resources/css/app.scss',
        'resources/css/frontend.scss',
        'resources/js/auth.js',
        'resources/js/app.js',
        'resources/js/frontend.js',
      ],
      refresh: true,
    }),
  ],
  server: {
    hmr: {host: 'localhost'},
    // host: 'localhost',
    // watch: {
    //     usePolling: true,
    // },
  },
});
