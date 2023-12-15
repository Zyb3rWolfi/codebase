import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'
import Sitemap from 'vite-plugin-sitemap'


// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    Sitemap({exclude: ['/user'], 
  readable: true,
  hostname: 'https:/codebranch.me',
  robots: [{userAgent: 'Googlebot', disallow: '/user/'},
  {userAgent: '*', allow: '/'}],

  }) ,
  ],
})

  