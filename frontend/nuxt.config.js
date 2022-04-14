export default {
  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'frontend',
    htmlAttrs: {
      lang: 'ja'
    },
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [
    'ant-design-vue/dist/antd.css'
  ],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [
    '@/plugins/antd-ui',
    '@/plugins/axios',
    '@/plugins/day.js',
    { src: '@/plugins/mixin-common-method.js', ssr:false },
    { src: '~/plugins/persistedstate.js', ssr: false},
    { src: '@/plugins/vue-mavon-editor', ssr: false },
  ],
  ssr: false,

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    ['nuxt-i18n', {
      locales: [
        {
          code: 'ja',
          file: 'ja.js'
        }
      ],
      lazy: true,
      langDir: 'lang/',
      defaultLocale: 'ja'
    }],
    [
      "@nuxtjs/axios",
    ],
    [
      'nuxt-client-init-module',
    ],
  ],
  axios: {
    baseURL: process.env.BASE_URL,
    credentials: true,
  },


  router: {
    middleware: 'auth'
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
  },

  server: {
    port: 3000,
    host: '0.0.0.0'
  },

  publicRuntimeConfig: {
    BASE_URL: process.env.BASE_URL,
    END_POINT: process.env.END_POINT,
  }
}
