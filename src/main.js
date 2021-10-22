import vuetify from './plugins/vuetify'
import Vue from 'vue';
import store from './store/store';
import './plugins/vuetify'
import App from './App.vue';
import router from './router';
Vue.config.productionTip = false

new Vue({
  store,
  vuetify,
  router,
  render: h => h(App)
}).$mount('#app')
