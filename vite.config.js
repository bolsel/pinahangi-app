import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/apps.scss',
        'resources/js/app.js',
        'resources/css/frontend.scss',
        'resources/css/guest.scss',
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
