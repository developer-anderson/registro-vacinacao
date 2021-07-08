import Vue from 'vue'
import App from './App.vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import { BForm } from 'bootstrap-vue'
import { FormPlugin } from 'bootstrap-vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
Vue.config.productionTip = false
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(FormPlugin)
Vue.use(VueAxios, axios)
Vue.component('b-form', BForm)
new Vue({
  render: h => h(App),
}).$mount('#app')
