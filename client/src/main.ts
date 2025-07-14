import { createApp } from 'vue'
import { createPinia }  from 'pinia'

import App from '@/App.vue'
import router from '@/router'
import '@/assets/styles/index.css'
// import { createRouter, createWebHistory } from 'vue-router'
import AOS from 'aos'
import 'aos/dist/aos.css'
import VueApexCharts from 'vue3-apexcharts'


import { createVuetify } from 'vuetify'
import 'vuetify/styles'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

// import VeeValidate from 'vee-validate';

const pinia = createPinia()
const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'mdi',
    aliases,
    sets: { mdi },
  },
})
const app = createApp(App)

app.use(vuetify)
app.use(VueApexCharts)
app.use(router)
app.use(pinia)
// app.use(VeeValidate);
app.mount('#app')
AOS.init()