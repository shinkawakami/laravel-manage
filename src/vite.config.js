import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  server: {
    host: true,              // 0.0.0.0 で Listen
    port: Number(process.env.VITE_PORT) || 5173,
    hmr: { host: 'localhost', protocol: 'ws', port: 5173 },
    watch: { usePolling: true }, // Docker 環境でのファイル変更検知の安定化
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
});
